#include <iostream>
//#include <dirent.h>
#include <vector>
#include <fstream>
#include <unordered_map>
//#include <unistd.h>
#include "sourceFiles/headers/globalVar.h"
#include "sourceFiles/headers/globalFun.h"


using namespace std;

int main() {
    /* --------------------------------------------- reading force fields  -------------------------------------------*/
    forceFields =  parseForceFields(forcefilePath+forcefileName);
//    for (forceFieldProcessor f: forceFields) {
//        cout << "------------------" << f.getMolecule() << endl;
//        for (string t : f.getPairCoffBlock()) {
//            cout << t << endl;
//        }
//    }

    /* --------------------------------------------- read and store i/p files in variable ----------------------------*/
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
            cerr << "Unable to open input template file at location : " << ipfilePath + ipFileName << endl;
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
            //find calculative variable
            findVariable(fileNo, fileName, lineNo, line, varCalDelimiter);
        }
    }

/* --------------------------------------------- ask user to input value of variable  --------------------------------*/
    cout << "--------------- Enter global user Specification ------------------" << endl;
    string temp; //hold temp value
    string cptr; //current pointer
    string bptr; //back pointer
    for (const string &text : globalQue) {
        //save last string
        bptr = cptr;
        //ask for current string
        cptr = text;
        cout << cptr << " : ";
        cin >> temp;
        //if user want to change last value
        if (temp == varErrorDelimiter) {
            cout << bptr << " : ";
            cin >> temp;
            globalVars[bptr] = temp;
            cout << cptr << " : ";
            cin >> temp;
            globalVars.insert(make_pair(text, temp));
        } else {
            globalVars.insert(make_pair(text, temp));
        }

    }
    //for last var re enter value if , it is error
    cout << "Want to change last value (@ / n) ?" << " : ";
    cin >> temp;
    if (temp == varErrorDelimiter) {
        cout << cptr << " : ";
        cin >> temp;
        globalVars[cptr] = temp;
    }
//    std::cout << "mymap contains:";
//    for (auto it = globalVars.begin(); it != globalVars.end(); ++it)
//        std::cout << " " << it->first << " : " << it->second;
//    std::cout << std::endl;
    cout << "--------------- Enter value of following Parameters ------------------" << endl;

    for (fileProcessor &obj: fileProc) {
        //for normal var - if var exist in storevar array
        if (storeVars.count(obj.getVarName()) && obj.getVarType() != varPathDelimiter) {
            temp = storeVars.at(obj.getVarName());
            obj.setVarValue(temp);
        } else {
            //if var not in store var and not path var
            if (obj.getVarType() != varPathDelimiter) {
                //for backtracking
                bptr = cptr;
                cptr = obj.getVarName();
                //ask and store user input
                cout << cptr << " : ";
                cin >> temp;
                if (temp == varErrorDelimiter) {
                    ErrorLoop:
                    cout << bptr << " : ";
                    cin >> temp;
                    //cout << "Value Updated" << endl;
                    updateVarValue(bptr, temp);
                    cout << cptr << " : ";
                    cin >> temp;
                    if (temp == varErrorDelimiter) {
                        goto ErrorLoop;
                    } else {
                        obj.setVarValue(temp);
//                        cout << "current value  added" << endl;
                    }
                } else {
                    obj.setVarValue(temp);
//                    cout << "current value  added" << endl;
                }
                //for store val
                if (obj.getVarType() == varStoreDelimiter) {
                    //if vartype is store var
//                    cout << "store value added" << endl;
                    storeVars.insert(make_pair(obj.getVarName(), temp));
                }
            }
        }
        //process cal variable
        if (obj.getVarType() == varCalDelimiter) {
            if (obj.getVarName() == "calfix") {
                temp = storeVars["timestep"];
                double d = toDouble(temp) * 100;
                obj.setVarValue(toString(d));
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
            //copy file to current dir
            copyFile(fileName);
            //insert into existance list
            forcedFiles.push_back(fileName);
            //set value
            obj.setVarValue(temp);
        }

    }
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

/* --------------------------------------------- edit output files with global variable ------------------------------*/
    updateRelaxFluid(globalVars.at("Cylinder or Sphere (c/s) "));
}