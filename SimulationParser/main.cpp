#include <iostream>
#include <dirent.h>
#include <vector>
#include <fstream>
#include "FileProcessor.h"
#include <unordered_map>
#include <unistd.h>

using namespace std;

/* --------------------------------------------- declaration of functions --------------------------------------------*/
//find variable in line based on delimiter
void findVariable(int fileNo, string fileName, int lineNo, string line, string delimiter);

//trim string
string trim(string &str);

//replace string
void ReplaceStringInPlace(string &subject, const string &search, const string &replace);

//copy one file to current dir
void copyFile(string fileName);

//get current dir
string ExePath();

/* --------------------------------------------- declaration global variable -----------------------------------------*/
//sequence of files to be execute
string ipFiles[] = {"in.relaxSubstrate", "in.relaxFluid", "in.Indent", "in.Scratch", "in.Remove"};

//static path of i/p o/p files
string ipfilePath = "/Users/Kandarp/ClionProjects/SimulationParser/input/";
string opfilePath = ExePath();
string forcefilePath = "/Users/Kandarp/ClionProjects/SimulationParser/forcefield/";

//list of Delimiter
string varStoreDelimiter = "$S$";
string varDelimiter = "$V$";
string varPathDelimiter = "$P$";
string varCalDelimiter = "$C$";

//process variables
vector<FileProcessor> fileProc;
unordered_map<string, string> storeVars;
vector<string> forcedFiles;
vector<vector<string>> ipFilesContent;
vector<vector<string>> opFilesContent;


int main() {
/* --------------------------------------------- read and store i/p files in variable --------------------------------*/
    ifstream ipStream;
    for (string &ipFileName :ipFiles) {
        //for each file
        vector<string> fileContent;
        ipStream.open(ipfilePath + ipFileName);
        string tempLine;
        if (ipStream.is_open()) {
            //for each line
            while (getline(ipStream, tempLine)) {
                fileContent.push_back(tempLine);
            }
        } else {
            cerr << "Unable to open File" << endl;
        }
        //push each file into list of files
        ipFilesContent.push_back(fileContent);
        ipStream.close();
    }
/* --------------------------------------------- find variables in all i/p files  ------------------------------------*/
    //temp holders
    int fileNo = 0;
    int lineNo = 0;
    string fileName;
    //for each file
    for (vector<string> &fileContent:ipFilesContent) {
        lineNo = 0;
        fileName = ipFiles[fileNo++];
        //for each line
        for (string &line:fileContent) {
            lineNo++;
            //find store variable
            findVariable(fileNo, fileName, lineNo, line, varStoreDelimiter);
            //find onetime variable
            findVariable(fileNo, fileName, lineNo, line, varDelimiter);
            //find path variable
            findVariable(fileNo, fileName, lineNo, line, varPathDelimiter);
        }
    }

/* --------------------------------------------- ask user to input value of variable  --------------------------------*/
    cout << "--------------- Enter value of following Parameters ------------------" << endl;
    string temp;
    for (FileProcessor &obj: fileProc) {
        //for normal var - if var exist in storevar array
        if (storeVars.count(obj.getVarName()) && obj.getVarType() != varPathDelimiter) {
            temp = storeVars.at(obj.getVarName());
        } else {
            //if var is not path var
            if (obj.getVarType() != varPathDelimiter) {
                //ask and store user input
                cout << obj.getVarName() << " : ";
                cin >> temp;
                if (obj.getVarType() == varStoreDelimiter) {
                    //if vartype is store var
                    storeVars.insert(make_pair(obj.getVarName(), temp));
                }
            }
        }
        //process path var
        if (obj.getVarType() == varPathDelimiter) {
            temp = obj.getVarName();
            //change path
            ReplaceStringInPlace(temp, "../", "./");
            //geting actual file name
            string fileName = temp;
            ReplaceStringInPlace(fileName, "./", "");
            trim(fileName);
            //if file is not exist already
            if (!(find(forcedFiles.begin(), forcedFiles.end(), fileName) != forcedFiles.end())) {
                //copy file to current dir
                copyFile(fileName);
                //insert into existance list
                forcedFiles.push_back(fileName);
            }

        }
        //finally set value
        obj.setVarValue(temp);
    }
/* --------------------------------------------- prepare o/p - replace var string with values  -----------------------*/
    cout << "--------------- Prepareing output from user input ------------------" << endl;
    int tempFileIndex = 1;
    int tempLine = 1;
    //for  each file
    for (vector<string> &fileContent:ipFilesContent) {
        tempLine = 1;
        vector<string> opFile;
        //for each line
        for (string &line:fileContent) {
            //for each obj of processed list
            for (FileProcessor &obj:fileProc) {
                //if i/p file and processed file is same
                if (obj.getFileIndex() == tempFileIndex) {
                    //if both line is same
                    if (tempLine == obj.getLineNo()) {
                        //replace varString with value
                        ReplaceStringInPlace(line, obj.getVarString(), obj.getVarValue());
                    }
                }
            }
            //put processed line into op file
            opFile.push_back(line);
            tempLine++;

        }
        tempFileIndex++;
        //finally put o/p file into list of ops
        opFilesContent.push_back(opFile);
    }
/* --------------------------------------------- generate output files with processed content  -----------------------*/

    cout << "------------------------Generating output file-------------------------------" << endl;
    int tempFileno = 0;
    //for each file
    for (vector<string> &fileContent:opFilesContent) {
        ofstream opStream;
        //create new file
        opStream.open(ipFiles[tempFileno]);
        // write date to that file.
        for (string &line : fileContent) {
            opStream << line << endl;
        }
        cout << "Output generated :" << ipFiles[tempFileno] << endl;
        tempFileno++;
        opStream.close();
    }


}


/* --------------------------------------------- function's implementations -----------------------------------------*/

void findVariable(int fileNo, string fileName, int lineNo, string line, string delimiter) {
    int pos = line.find(delimiter, 0);
    int loopCount = 1;
    int startPos = 0;
    while (pos != string::npos) {
        if (loopCount % 2 != 0) {
            //odd
            startPos = pos;
            //cout << "Start Pos :" << pos << endl;
        } else {
            //even
            //cout << "End Pos :" << pos << endl;
//            cout << "Variable is : " << line.substr(startPos, pos - startPos + 3) << endl;
            FileProcessor obj = FileProcessor();
            obj.setFileIndex(fileNo);
            obj.setFileName(fileName);
            obj.setLineNo(lineNo);
            obj.setLineText(line);
            obj.setVarType(delimiter);
            obj.setVarStartPos(startPos);
            obj.setVarEndPos(pos - startPos + 3);
            string tempVarTextHolder = line.substr(startPos, pos - startPos + 3);
            obj.setVarString(trim(tempVarTextHolder));
            string tempVarNameHolder = tempVarTextHolder.substr(3, tempVarTextHolder.length() - 6);
            obj.setVarName(trim(tempVarNameHolder));
            fileProc.push_back(obj);
        }
        pos = line.find(delimiter, pos + 1);
        loopCount++;
    }


}

string trim(string &str) {
    size_t first = str.find_first_not_of(' ');
    size_t last = str.find_last_not_of(' ');
    return str.substr(first, (last - first + 1));
}

// Replace string method
void ReplaceStringInPlace(string &subject, const string &search,
                          const string &replace) {
    size_t pos = 0;
    while ((pos = subject.find(search, pos)) != string::npos) {
        subject.replace(pos, search.length(), replace);
        pos += replace.length();
    }
}

//get current dir
string ExePath() {
    char cwd[1024];
    if (getcwd(cwd, sizeof(cwd)) != NULL) {
        fprintf(stdout, "Current working dir: %s\n", cwd);
        return cwd;
    } else {
        perror("getcwd() error");
        return 0;
    }
}

void copyFile(string fileName) {

    vector<string> fileContent;
    ifstream ipStream;
    ipStream.open(forcefilePath + raw);
    string tempLine;
    /* While there is still a line. */
    if (ipStream.is_open()) {
        while (getline(ipStream, tempLine)) {
            fileContent.push_back(tempLine);
        }
    } else {
        cerr << "Unable to open File" << endl;
    }
    ipStream.close();

    // open a file in write mode.
    ofstream opStream;
    opStream.open(raw);
    // write inputted data into the file.
    for (string &line : fileContent) {
        opStream << line << endl;
    }
    cout << "File Copied :" << raw << endl;

}