#include <iostream>
#include <dirent.h>
#include <vector>
#include <fstream>
#include "FileProcessor.h"

using namespace std;

/* --------------------------------------------  0.declaration of function -------------------------------------------*/
const string currentDateTime();

void ReplaceStringInPlace(string &subject, const string &search,
                          const string &replace);

int main() {

/* --------------------------------------------  0.declaration of variables -------------------------------------------*/
    string ipfilePath = "/Users/Kandarp/ClionProjects/LtdFileParser/input/";
    string opfilePath = "/Users/Kandarp/ClionProjects/LtdFileParser/output/";
    int selectedFileIndex;
    vector<string> fileList;
    vector<string> ipFile;
    vector<string> opFile;
    vector<FileProcessor> fileProc;
    string ipFileName;
    string opFileName;
    string delimiter = "$$";


/* --------------------------------------------  1.list out input files from given dir -------------------------------*/
    DIR *dir;
    struct dirent *ent;
    if ((dir = opendir(ipfilePath.c_str())) != NULL) {
        /* print all the files and directories within directory */
        while ((ent = readdir(dir)) != NULL) {
            if (ent->d_name[0] != '.') {
                fileList.push_back(ent->d_name);
            }
        }
        closedir(dir);
    } else {
        /* could not open directory */
        perror("");
        return EXIT_FAILURE;
    }

    cout << "--------------- Select file for editing ------------------" << endl;
    for (int i = 0; i < fileList.size(); i++) {
        cout << i + 1 << " " << fileList[i] << endl;
    }

/* --------------------------------------------  2.ask user for file selection ---------------------------------------*/
    cout << "\nEnter file number : ";
    cin >> selectedFileIndex;
    ipFileName = fileList[selectedFileIndex - 1];
    cout << "\nProcessing file : " << ipFileName << endl;
/* --------------------------------------------  3.open file and convert to lines ------------------------------------*/
    ifstream ipStream;
    ipStream.open(ipfilePath + ipFileName);
    string tempLine;
    /* While there is still a line. */
    if (ipStream.is_open()) {
        while (getline(ipStream, tempLine)) {
            ipFile.push_back(tempLine);
        }
    } else {
        cerr << "Unable to open File" << endl;
    }
    ipStream.close();

/* --------------------------------------------  4.process file and check for variables  -----------------------------*/
    int lineNo = 0;
    for (string &line:ipFile) {
        lineNo++;
        int pos = line.find(delimiter, 0);
        int loopCount = 1;
        int startPos = 0;
        while (pos != string::npos) {
            if (loopCount % 2 != 0) {
                //odd
                startPos = pos;
//                cout << "Start Pos :" << pos << endl;
            } else {
                //even
//                 cout << "End Pos :" << pos << endl;
//                cout << "Variable is : " << line.substr(startPos, pos - startPos + 2) << endl << endl;
                FileProcessor obj = FileProcessor();
                obj.setLineNo(lineNo);
                obj.setLineText(line);
                obj.setVarStartPos(startPos);
                obj.setVarEndPos(pos - startPos + 2);
                obj.setVarName(line.substr(startPos, pos - startPos + 2));
                fileProc.push_back(obj);
            }
            pos = line.find(delimiter, pos + 1);
            loopCount++;
        }
    }

/* --------------------------------------------  5.ask user to enter variables ---------------------------------------*/
    cout << "--------------- Enter value of following Parameters ------------------" << endl;
    string temp;
    for (FileProcessor &obj: fileProc) {
        cout << obj.getVarName().substr(2, obj.getVarName().length() - 4) << " : " << endl;
        getline(cin, temp);
        obj.setVarValue(temp);
    }

    cout << "FINAL OUTPUT" << endl;
    for (FileProcessor &obj: fileProc) {
        cout << obj.getVarName() << " : " << obj.getVarValue() << endl;
    }
/* --------------------------------------------  6.prepare output file -----------------------------------------------*/
    opFile = ipFile;
    int tempCount = 1;
    for (string &line:opFile) {
        for (FileProcessor &obj:fileProc) {
            if (tempCount == obj.getLineNo()) {
                cout << "ORG : " << line << endl;
                ReplaceStringInPlace(line, obj.getVarName(), obj.getVarValue());
                cout << "REP : " << line << endl;
            }
        }
        tempCount++;
    }
/* --------------------------------------------  7.create output -----------------------------------------------------*/
    // open a file in write mode.
    ofstream opStream;
    opFileName = currentDateTime() + "-" + ipFileName;
    opStream.open(opfilePath + opFileName);
    cout << "Generating output file" << endl;
    // write inputted data into the file.
    for (string &line : ipFile) {
        opStream << line << endl;
    }
    cout << "Output generated :" << opFileName << endl;
}


// Get current date/time, format is YYYY-MM-DD.HH:mm:ss
const string currentDateTime() {
    time_t now = time(0);
    struct tm tstruct;
    char buf[80];
    tstruct = *localtime(&now);
    // for more information about date/time format
    strftime(buf, sizeof(buf), "%d-%m-%Y.%X", &tstruct);
    return buf;
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
