//
// Created by king on 10/31/2016.
//

#include "../headers/globalFun.h"
#include "../headers/fileProcessor.h"
#include "../headers/globalVar.h"

using namespace std;

void askGlobalUserInput() {
    string temp; //hold temp value
    string cptr; //current pointer
    string bptr; //back pointer


    for (const string &text : globalQue) {
        //save last string
        bptr = cptr;
        //ask for current string
        cptr = text;
        cout << cptr << " : ";
        getline(cin, temp);
        //if user want to change last value
        if (temp == varErrorDelimiter) {
            cout << bptr << " : ";
            getline(cin, temp);
            globalVars[bptr] = temp;
            cout << cptr << " : ";
            getline(cin, temp);
            globalVars.insert(make_pair(getFirstorLastWord(text, true), temp));
        } else {
            globalVars.insert(make_pair(getFirstorLastWord(text, true), temp));
        }

    }
    //for last var re enter value if , it is error
    cout << "Want to change last value (@ / n) ?" << " : ";
    getline(cin, temp);
    if (temp == varErrorDelimiter) {
        cout << cptr << " : ";
        getline(cin, temp);
        globalVars[cptr] = temp;
    }
//    std::cout << "mymap contains:";
//    for (auto it = globalVars.begin(); it != globalVars.end(); ++it)
//        std::cout << " " << it->first << " : " << it->second;
//    std::cout << std::endl;
}


void askUserInput() {
    string temp; //hold temp value
    string cptr; //current pointer
    string bptr; //back pointer
    for (fileProcessor &obj: fileProc) {
        //for normal var - if var exist in storevar array
        if (storeVars.count(obj.getVarName())) {
            temp = storeVars.at(obj.getVarName());
            obj.setVarValue(temp);
        } else {
            //if var not in store var and not path var
            if (obj.getVarType() == varStoreDelimiter || obj.getVarType() == varDelimiter) {
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
                    }
                } else {
                    obj.setVarValue(temp);
                }
                //for store val
                if (obj.getVarType() == varStoreDelimiter) {
                    //if vartype is store var
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
        //process force fields varaibles
        for (forceFieldProcessor f: forceFields) {
            if (f.getMolecule() == globalVars.at("[2]")) {
//                cout << "Took force fields of molecule :" << f.getMolecule() << endl;
                forceField = f;
            }
        }
        forceField.setSigma(getFirstorLastWord(globalVars.at("[3]"), false));
//        cout << " sigma  :" << forceField.getSigma() << endl;
        if (obj.getVarType() == varForceFieldDelimiter) {
            if (obj.getVarName() == "atom") {
                obj.setVarValue(forceField.getNosCites());
            }
            if (obj.getVarName() == "bond") {
                obj.setVarValue(forceField.getNosBonds());
            }
            if (obj.getVarName() == "sigma") {
                obj.setVarValue(forceField.getSigma());
            }
            if (obj.getVarName() == "1*3 4") {
                obj.setVarValue(globalVars.at("[3]"));
            }
            if (obj.getVarName() == "1*3 5") {
                obj.setVarValue(globalVars.at("[4]"));
            }
        }
    }
}