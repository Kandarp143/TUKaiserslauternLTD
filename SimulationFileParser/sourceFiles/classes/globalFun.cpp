//
// Created by king on 10/20/2016.
//

#include "../headers/globalFun.h"
#include "../headers/fileProcessor.h"
#include "../headers/globalVar.h"
#include <fstream>
#include <stdlib.h>     /* convert string to double */
#include <sstream>      /* convert double to string */

using namespace std;

/* --------------------------------------------- function's implementations -----------------------------------------*/



vector<string> getFileContent(std::string fullPath) {
    vector<string> fileContent;
    ifstream ipStream;
    ipStream.open(fullPath);
    string tempLine;
    if (ipStream.is_open()) {
        //for each line
        while (getline(ipStream, tempLine)) {
            fileContent.push_back(tempLine);
        }
    } else {
        cerr << "Unable to open input template file at location : " << fullPath << endl;

    }
    ipStream.close();
    return fileContent;
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
//            cout << "Var Type : " << delimiter << "             Variable is : "
//                 << line.substr(startPos, pos - startPos + 3) << endl;
            fileProcessor obj = fileProcessor();
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
//    char cwd[1024];
//    if (getcwd(cwd, sizeof(cwd)) != NULL) {
//        fprintf(stdout, "Current working dir: %s\n", cwd);
//        return cwd;
//    } else {
//        perror("getcwd() error");
//        return 0;
//    }
}

void copyFile(string fileName) {
    ifstream ipStream;
    ipStream.open(forcefilePath + fileName);
    if (ipStream.is_open()) {
        ifstream src(forcefilePath + fileName, std::ios::binary);
        ofstream dest(opfilePath + fileName, std::ios::binary);
        dest << src.rdbuf();
    }
    ipStream.close();

}


void updateVarValue(string varName, string newVal) {
    bool breaker = true;
    for (fileProcessor &obj: fileProc) {
        if (obj.getVarName() == varName && breaker == true) {
            //  cout << "Updating value from :  " << obj.getVarValue() << endl;
            obj.setVarValue(newVal);
            //  cout << " To :" << obj.getVarValue() << endl;
            breaker = false;
        }
    }
    //for store var
    if (storeVars.count(varName)) {
        //if vartype is store var
        // cout << "value before : "<<storeVars.at(varName) << endl;
        // cout << "store value updated " << endl;
        storeVars[varName] = newVal;
        //  cout << "value is : "<<storeVars.at(varName) << endl;
    }
}

void updateRelaxFluid(string choice) {
    ifstream ipStream;
    //for each file
    vector<string> fileContent;
    vector<string> output;
    ipStream.open(opfilePath + "in.relaxFluid");
    string tempLine;
    if (ipStream.is_open()) {
        //for each line
        while (getline(ipStream, tempLine)) {
            fileContent.push_back(tempLine);
        }
    } else {
        cerr << "Unable to open input template file at location : " << ipfilePath + "in.relaxFluid" << endl;
    }
    cout << "Reading Relax File\n\n\n\n" << endl;
    string tempVar;
    int ptrFirstFrom = 0;
    int ptrTwoFrom = 0;
    if (choice == "c") {
        tempVar = "# Sphere";
    } else {
        tempVar = "# Cylinder";
    }
    int line = 1;
    for (string s:fileContent) {
        if (s.find(tempVar) != string::npos) {
            ptrFirstFrom = ptrTwoFrom;
            ptrTwoFrom = line;
        }
        line++;

    }
    line = 1;
    for (string s:fileContent) {
        if (choice == "c") {
            if (line >= ptrFirstFrom && line <= ptrFirstFrom + 3) {
//                cout<<"updating"<<endl;
                s = "#" + s;
            }
            if (line >= ptrTwoFrom && line <= ptrTwoFrom + 6) {
//                cout<<"updating"<<endl;
                s = "#" + s;
            }
        } else {
            if (line >= ptrFirstFrom && line <= ptrFirstFrom + 4) {
//                cout<<"updating"<<endl;
                s = "#" + s;
            }
            if (line >= ptrTwoFrom && line <= ptrTwoFrom + 3) {
//                cout<<"updating"<<endl;
                s = "#" + s;
            }
        }

        line++;
        output.push_back(s);
    }
    ipStream.close();


    //Replace file
    ofstream opStream;
    //create new file
    opStream.open(opfilePath + "in.relaxFluid");
    // write data to that file.
    for (string &line : output) {
        opStream << line << endl;
    }
//        cout << "File Updated : in.relaxFluid" << endl;
    opStream.close();

}


double toDouble(std::string value) {
    return atof(value.c_str());
}

string toString(double value) {
    std::ostringstream strs;
    strs << value;
    return strs.str();
}


vector<forceFieldProcessor> parseForceFields(string qualifiedPath) {
    vector<forceFieldProcessor> final;
    ifstream ipStream;
    ipStream.open(qualifiedPath);
    string tempLine;
    vector<string> s;
    vector<string> m;
    forceFieldProcessor *f;
    bool flag = false;
    if (ipStream.is_open()) {
        //for each line
        while (getline(ipStream, tempLine)) {
            if (tempLine == "")continue;
            if (tempLine.find("MOLECULE") != std::string::npos) {
                if (flag) {
                    f->setPairCoffBlock(s);
                    f->setMass(m);
                    final.push_back(*f);
                    s.clear();
                    m.clear();
                }
                flag = true;
                f = new forceFieldProcessor();
                ReplaceStringInPlace(tempLine, "MOLECULE", "");
                f->setMolecule(trim(tempLine));
            } else {
                //capture bonds and cites
                if (tempLine.find("number_of_cites:") != std::string::npos) {
                    ReplaceStringInPlace(tempLine, "number_of_cites:", "");
                    f->setNosCites(trim(tempLine));
                } else if (tempLine.find("number_of_bonds:") != std::string::npos) {
                    ReplaceStringInPlace(tempLine, "number_of_bonds:", "");
                    f->setNosBonds(trim(tempLine));
                } else {
                    s.push_back(tempLine);
                }
                //saperate mass filter
                if (tempLine.find("mass") != std::string::npos) {
                    trim(tempLine);
                    tempLine = tempLine.substr(tempLine.find_last_of(" "), tempLine.length());
                    m.push_back(trim(tempLine));
                }

            }
        }
    } else {
        cerr << "Unable to open input template file at location : " << endl;
    }
    //push each file into list of files
    ipStream.close();
    return final;
}

string getFirstorLastWord(string s, bool isFirst) {
    istringstream iss(s);
    string word;
    string first;
    string last;
    string ans;
    int count = 0;
    while (iss >> word) {
        if (count == 0) {
            first = word;
        }
        last = word;
        count++;
    }
    if (isFirst)
        ans = first;
    else
        ans = last;
//    cout << "String :" << s << " word :" << word << " First :" << first << " Last :" << last << " Ans:" << ans << endl;
    return ans;
}


string getLastWord(string s) {
    string ans;
    trim(s);
    ans = s.substr(s.find_last_of(" "), s.length());
    cout << "This is last" << s << endl;
    return ans;

}

void resetVariable() {
    ipFilesContent.clear();
    opFilesContent.clear();
}