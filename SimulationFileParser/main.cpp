#include <iostream>
#include <fstream>
//#include <dirent.h>
#include <vector>
//#include <unistd.h>
#include "sourceFiles/headers/globalVar.h"
#include "sourceFiles/headers/globalFun.h"


using namespace std;

int main() {
//    string s = "[1] Cylinder or Sphere (c/s)";
//    getFirstorLastWord(s,true);
//    return(0);
/* --------------------------------------------- reading force fields  -----------------------------------------------*/
    forceFields = parseForceFields(forcefilePath + forcefileName);

/* --------------------------------------------- read and store i/p files in variable --------------------------------*/
    ifstream ipStream;
    for (string &ipFileName :ipFiles) {
        ipFilesContent.push_back(getFileContent(ipfilePath + ipFileName));
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
            //find calculative variable
            findVariable(fileNo, fileName, lineNo, line, varCalDelimiter);
            //find force fields variable
            findVariable(fileNo, fileName, lineNo, line, varForceFieldDelimiter);
        }
    }

/* --------------------------------------------- ask user to input value of variable  --------------------------------*/
    cout << "--------------- Enter global user Specification ------------------" << endl;
    askGlobalUserInput();
    cout << "--------------- Enter value of following Parameters ------------------" << endl;
    askUserInput();

/* --------------------------------------------- prepare o/p - replace var string with values  -----------------------*/
    cout << "--------------- Prepareing output from user input ------------------" << endl;
    int tempFileIndex = 1;
    int tempLine = 1;
    //Dynamic Variable Replacement in File
    for (vector<string> &fileContent:ipFilesContent) {
        tempLine = 1;
        vector<string> opFile;
        //for each line
        for (string &line:fileContent) {
            //for each obj of processed list
            for (fileProcessor &obj:fileProc) {
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
        opStream.open(opfilePath + ipFiles[tempFileno]);
        // write data to that file.
        for (string &line : fileContent) {
            opStream << line << endl;
        }
        cout << "Output generated :" << ipFiles[tempFileno] << endl;
        tempFileno++;
        opStream.close();
    }

///* --------------------------------------------- edit output files with global variable ------------------------------*/
    updateRelaxFluid(globalVars.at("[1]"));
//
///* --------------------------------------------- edit output files with force fields ---------------------------------*/
////    resetVariable();
////    cout << "------------------------Updateing forcefield-------------------------------" << endl;
////
////
////    cout << forceField.getMolecule() << endl;
////
////
////    for (string &ipFileName :ipFiles) {
////        opFilesContent.push_back(getFileContent(opfilePath + ipFileName));
////    }
////
////    //temp holders
////    fileNo = 0;
////    lineNo = 0;
////    fileName = "";
////    //for each file
////    for (vector<string> &fileContent:opFilesContent) {
////        lineNo = 0;
////        fileName = ipFiles[fileNo++];
////        //for each line
////        for (string &line:fileContent) {
////            lineNo++;
////            //find force variable
////            findVariable(fileNo, fileName, lineNo, line, varForceFieldDelimiter);
////        }
////    }
////
////
////    for (fileProcessor &obj: fileProc) {
////        cout << obj.getVarName() << obj.getVarType() << endl;
////    }


}