//
// Created by king on 10/20/2016.
//
#include <iostream>
#include <vector>
#include <unordered_map>
#include "fileProcessor.h";


#ifndef SIMULATIONFILEPARSER_GLOBALS_H
#define SIMULATIONFILEPARSER_GLOBALS_H
/* --------------------------------------------- declaration global variable -----------------------------------------*/
//sequence of files to be execute
extern std::vector<std::string> ipFiles;
//global asking question
extern std::vector<std::string> globalQue;
//static path of i/p o/p files
extern std::string ipfilePath;
extern std::string opfilePath;
extern std::string forcefilePath;
//list of Delimiter
extern std::string varStoreDelimiter;
extern std::string varDelimiter;
extern std::string varPathDelimiter;
extern std::string varCalDelimiter;
extern std::string varErrorDelimiter;
//process variables
extern std::vector<fileProcessor> fileProc;
extern std::unordered_map<std::string, std::string> storeVars;
extern std::unordered_map<std::string, std::string> globalVars;
extern std::vector<std::string> forcedFiles;
extern std::vector<std::vector<std::string>> ipFilesContent;
extern std::vector<std::vector<std::string>> opFilesContent;

#endif //SIMULATIONFILEPARSER_GLOBALS_H
