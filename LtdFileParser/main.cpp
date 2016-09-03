#include <iostream>
#include <dirent.h>
#include <vector>
#include <fstream>

using namespace std;


int main() {

/* --------------------------------------------  0.declaration of variables -------------------------------------------*/
    string filePath = "/Users/Kandarp/ClionProjects/LtdFileParser/input/";
    int selectedFileIndex;
    vector<string> fileList;


/* --------------------------------------------  1.list out input files from given dir -------------------------------*/
    DIR *dir;
    struct dirent *ent;
    if ((dir = opendir(filePath.c_str())) != NULL) {
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
    cout << "\n Enter file number : ";
    cin >> selectedFileIndex;
    cout << "\n Processing file : " << fileList[selectedFileIndex - 1] << endl;
/* --------------------------------------------  3.open file and convert to lines ------------------------------------*/
    ifstream inputFile;
    inputFile.open(filePath + fileList[selectedFileIndex - 1]);

    if (inputFile.is_open()) {
        while (inputFile) // To get you all the lines.
        {
//            string tempLine;
//            getline(inputFile, tempLine); // Saves the line in STRING.
//            cout << tempLine; // Prints our STRING.
        }
        cout << "reading file" << endl;
    } else {
        cerr << "Unable to open file" << endl;
    }
    inputFile.close();

/* --------------------------------------------  4.process file and check for variables  -----------------------------*/


/* --------------------------------------------  5.ask user to enter variables ---------------------------------------*/


/* --------------------------------------------  6.prepare output file -----------------------------------------------*/


/* --------------------------------------------  7.create output -----------------------------------------------------*/
    return 0;
}