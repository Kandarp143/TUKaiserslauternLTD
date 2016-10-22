//
// Created by king on 10/20/2016.
//
#include <iostream>
#include "../headers/forceFieldProcessor.h"

#ifndef SIMULATIONFILEPARSER_GLOBALFUN_H
#define SIMULATIONFILEPARSER_GLOBALFUN_H


/* --------------------------------------------- declaration of functions --------------------------------------------*/
//find variable in line based on delimiter
extern void findVariable(int fileNo, std::string fileName, int lineNo, std::string line, std::string delimiter);

//trim std::string
extern std::string trim(std::string &str);

//replace std::string
extern void ReplaceStringInPlace(std::string &subject, const std::string &search, const std::string &replace);

//copy one file to current dir
extern void copyFile(std::string fileName);

//get current dir
extern std::string ExePath();

//to update value user error
extern void updateVarValue(std::string varName, std::string newVal);

//to update Cylinder or Sphere
extern void updateRelaxFluid(std::string choice);

//to convert string to double
extern double toDouble(std::string value);

//to convert double to string
extern std::string toString(double value);

//to parse and capture data from molecule file
extern vector<forceFieldProcessor> parseForceFields(string qualifiedPath);



#endif //SIMULATIONFILEPARSER_GLOBALFUN_H
