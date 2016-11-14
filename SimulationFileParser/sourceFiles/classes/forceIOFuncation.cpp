//
// Created by king on 11/1/2016.
//

#include "../headers/globalFun.h"
#include "../headers/globalVar.h"
#include <fstream>

using namespace std;

vector<string> getPairCoffBlock(string file) {
    vector<string> ans;
    vector<string> f = getFileContent(file);
    bool flag = false;
    bool isEndfound = false;
    for (string s:f) {
        if (isEndfound == true) {
            flag = false;
        }
        if (s == varForceBlockStart) {
            flag = true;
        }
        if (s == varForceBlockEnd) {
            isEndfound = true;
        }
        if (flag == true) {
            ans.push_back(s);
        }
    }
    return ans;
}

void replacePairCoffBlock(string file, vector<string> block) {
    vector<string> ans;
    vector<string> f = getFileContent(file);
    bool flag = false;
    bool isendpart = false;
    bool isEndfound = false;
    int count = 1;
    for (string s:f) {
        //partation logic
        if (isEndfound == true) {
            flag = false;
            isendpart = true;
        }
        if (s == varForceBlockStart) {
            flag = true;
        }
        if (s == varForceBlockEnd) {
            isEndfound = true;
        }

        //generating ans vector
        if (flag == true && count == 1) {
//            cout << "Middle Part" << endl;
            count++;
            ans.insert(ans.end(), block.begin(), block.end());
        } else if (flag == false && isendpart == true) {
//            cout << "Last Part" << endl;
            ans.push_back(s);
        } else if (flag == false && isendpart == false) {
//            cout << "First Part" << endl;
            ans.push_back(s);
        } else {

        }

        //Replace file
        ofstream opStream;
        //create new file
        opStream.open(file);
        // write data to that file.
        for (string &line : ans) {
            opStream << line << endl;
        }
//        cout << "File Updated : in.relaxFluid" << endl;
        opStream.close();
    }
//    for (string ss:ans) {
//        cout << ss << endl;
//    }


}

void replaceMassBlock(string file, vector<string> block){
    vector<string> ans;
    vector<string> f = getFileContent(file);
    bool flag = false;
    bool isendpart = false;
    bool isEndfound = false;
    int count = 1;
    for (string s:f) {
        //partation logic
        if (isEndfound == true) {
            flag = false;
            isendpart = true;
        }
        if (s == "$M-START$") {
            flag = true;
        }
        if (s == "$M-END$") {
            isEndfound = true;
        }

        //generating ans vector
        if (flag == true && count == 1) {
//            cout << "Middle Part" << endl;
            count++;
            ans.insert(ans.end(), block.begin(), block.end());
        } else if (flag == false && isendpart == true) {
//            cout << "Last Part" << endl;
            ans.push_back(s);
        } else if (flag == false && isendpart == false) {
//            cout << "First Part" << endl;
            ans.push_back(s);
        } else {

        }

        //Replace file
        ofstream opStream;
        //create new file
        opStream.open(file);
        // write data to that file.
        for (string &line : ans) {
            opStream << line << endl;
        }
//        cout << "File Updated : in.relaxFluid" << endl;
        opStream.close();
    }
//    for (string ss:ans) {
//        cout << ss << endl;
//    }


}

vector<string> replaceMergeBlock(vector<string> orgBlock, vector<string> mrgBlock, string StartP, string EndP) {
    vector<string> ans;
    bool flag = false;
    bool isendpart = false;
    bool isEndfound = false;
    int count = 1;
    for (string s:orgBlock) {
        //partation logic
        if (isEndfound == true) {
            flag = false;
            isendpart = true;
        }
        if (s == StartP) {
            flag = true;
        }
        if (s == EndP) {
            isEndfound = true;
        }

        //generating ans vector
        if (flag == true && count == 1) {
//            cout << "Middle Part" << endl;
            count++;
            ans.insert(ans.end(), mrgBlock.begin(), mrgBlock.end());
        } else if (flag == false && isendpart == true) {
//            cout << "Last Part" << endl;
            ans.push_back(s);
        } else if (flag == false && isendpart == false) {
//            cout << "First Part" << endl;
            ans.push_back(s);
        } else {

        }

    }

    return ans;
}