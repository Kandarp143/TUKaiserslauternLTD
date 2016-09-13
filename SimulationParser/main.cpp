#include <iostream>
#include <dirent.h>
#include <vector>
#include <fstream>
#include "FileProcessor.h"
#include "StoreVariable.h"

using namespace std;

//function
void findVariable(int fileNo, string fileName, int lineNo, string line, string delimiter);

//variable
vector<FileProcessor> fileProc;
vector<StoreVariable> storeVars;
vector<vector<FileProcessor>> fileProc3;

int main() {
/* --------------------------------------------  0.declaration of variables -------------------------------------------*/
    string ipfilePath = "/Users/Kandarp/ClionProjects/SimulationParser/input/";
    string ipFiles[] = {"in.relaxSubstrate", "in.relaxFluid", "in.Indent", "in.Scratch", "in.Remove"};
    string varStoreDelimiter = "$S$";
    string varDelimiter = "$V$";
    string varPathDelimiter = "$P$";
    string varCalDelimiter = "$C$";
    vector<vector<string>> ipFilesContent;


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
            obj.setVarName(line.substr(startPos, pos - startPos + 3));
            fileProc.push_back(obj);
        }
        pos = line.find(delimiter, pos + 1);
        loopCount++;
    }


}