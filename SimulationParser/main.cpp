#include <iostream>
#include <dirent.h>
#include <vector>
#include <fstream>
#include "FileProcessor.h"
#include <unordered_map>
#include <unistd.h>

char *getcwd(char *buf, size_t size);

using namespace std;

//function
void findVariable(int fileNo, string fileName, int lineNo, string line, string delimiter);

string trim(string &str);

void ReplaceStringInPlace(string &subject, const string &search, const string &replace);


void copyFile(string filePath);

//get current dir
string ExePath();

//variable
vector<FileProcessor> fileProc;
unordered_map<string, string> storeVars;

string forcefilePath = "/Users/Kandarp/ClionProjects/SimulationParser/forcefield/";
string ipfilePath = "/Users/Kandarp/ClionProjects/SimulationParser/input/";
string opfilePath;

int main() {
/* --------------------------------------------  0.declaration of variables -------------------------------------------*/



//    opfilePath = "/Users/Kandarp/ClionProjects/SimulationParser/output/";
    opfilePath = ExePath();
    string ipFiles[] = {"in.relaxSubstrate", "in.relaxFluid", "in.Indent", "in.Scratch", "in.Remove"};
    string varStoreDelimiter = "$S$";
    string varDelimiter = "$V$";
    string varPathDelimiter = "$P$";
    string varCalDelimiter = "$C$";
    vector<vector<string>> ipFilesContent;
    vector<vector<string>> opFilesContent;


/* --------------------------------------------  3.open file and convert to lines ------------------------------------*/
    ifstream ipStream;
    for (string &ipFileName :ipFiles) {
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
        ipFilesContent.push_back(fileContent);
        ipStream.close();
    }
/* --------------------------------------------  3.open file and detect variables ------------------------------------*/
    int fileNo = 0;
    int lineNo = 0;
    string fileName;
    for (vector<string> &fileContent:ipFilesContent) {
        lineNo = 0;
        fileName = ipFiles[fileNo++];
//        cout << "Reading File .................................................... " << fileName << endl;
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

/* --------------------------------------------  3.print ------------------------------------*/
    for (FileProcessor &obj:fileProc) {
        cout << obj.getFileIndex() << "............................." << obj.getFileName() << endl;
        cout << "Variables :" << obj.getVarName() << endl;
    }
/* --------------------------------------------  5.ask user to enter variables ---------------------------------------*/
    cout << "--------------- Enter value of following Parameters ------------------" << endl;
    string temp;
    for (FileProcessor &obj: fileProc) {
        //for normal var - if var value exsist
        if (storeVars.count(obj.getVarName()) && obj.getVarType() != varPathDelimiter) {
            //cout << "KEY EXSIST : " << storeVars.at(obj.getVarName()) << endl;
            temp = storeVars.at(obj.getVarName());
        } else {
            //if not
            if (obj.getVarType() != varPathDelimiter) {
                cout << obj.getVarType() << " --- " << obj.getVarName() << " : ";
                cin >> temp;
                if (obj.getVarType() == varStoreDelimiter) {
//                cout << "storing value" << endl;
                    storeVars.insert(make_pair(obj.getVarName(), temp));
//                cout << "Value Stored :" << storeVars.size() << endl;
                }
            }
        }
        //for path variable
        if (obj.getVarType() == varPathDelimiter) {
            temp = obj.getVarName();
            ReplaceStringInPlace(temp, "../", "./");
            copyFile(temp);
        }

//        cout << "seting value :" << obj.getFileName() << ":" << obj.getVarName() << temp << endl;
        obj.setVarValue(temp);
    }
/* --------------------------------------------  6.prepare output file -----------------------------------------------*/
    cout << "--------------- Prepareing output from user input ------------------" << endl;

    int tempFileIndex = 1;
    int tempLine = 1;
    for (vector<string> &fileContent:ipFilesContent) {
        //for  each file
        tempLine = 1;
        vector<string> opFile;
        for (string &line:fileContent) {
            //for each line
            for (FileProcessor &obj:fileProc) {
                if (obj.getFileIndex() == tempFileIndex) {
                    if (tempLine == obj.getLineNo()) {
                        ReplaceStringInPlace(line, obj.getVarString(), obj.getVarValue());
                    }
                }
            }
            opFile.push_back(line);
            tempLine++;

        }
        tempFileIndex++;
        opFilesContent.push_back(opFile);
    }
    /* --------------------------------------------  7.create output -----------------------------------------------------*/

    cout << "------------------------Generating output file-------------------------------" << endl;
//    // open a file in write mode.

    int tempFileno = 0;
    for (vector<string> &fileContent:opFilesContent) {
        //for  each file
        ofstream opStream;
        opStream.open(ipFiles[tempFileno]);
        //opStream.open(opfilePath + ipFiles[tempFileno]);
        // write inputted data into the file.
        for (string &line : fileContent) {
            opStream << line << endl;
        }
        cout << "Output generated :" << ipFiles[tempFileno] << endl;
        tempFileno++;
        opStream.close();
    }


}


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

void copyFile(string raw) {
    ReplaceStringInPlace(raw, "./", "");
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