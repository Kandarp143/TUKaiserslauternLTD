//
// Created by king on 10/17/2016.
//
#include <iostream>
//#include <dirent.h>
#include <vector>
#include <fstream>
#include "FileProcessor.h"
#include <unordered_map>
//#include <unistd.h>


using namespace std;

extern string opfilePath ;
extern string ipfilePath ;

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
        }else{
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