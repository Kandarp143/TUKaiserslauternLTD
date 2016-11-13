//
// Created by king on 10/20/2016.
//


#include <iostream>
#include <vector>
#include "../headers/globalVar.h"

using namespace std;
/* --------------------------------------------- declaration global variable -----------------------------------------*/

//sequence of files to be execute
std::vector<std::string> ipFiles = {"in.relaxSubstrate", "in.relaxFluid", "in.Indent", "in.Scratch", "in.Remove"};
//std::vector<std::string> ipFiles = {"in.relaxSubstrate"};

//global asking question
std::vector<std::string> globalQue = {"[1] Cylinder or Sphere (c/s)", "[2] Select Molecule (Enter No)",
                                      "[3] 1*3 4 Interaction [val1 val2]", "[4] 1*3 5 Interatcion [val1 val2]"};

//static path of i/p o/p files
//for linux  (INPUT FILE PATH)
string ipfilePath = "/home/kandarp/ClionProjects/SimulationFileParser/input/";
//for windows
//string ipfilePath = "C:/Users/king/ClionProjects/SimulationFileParser/input/";
//for server
//string ipfilePath = "/scratch/kpatel/SimulationFileParser/input/";


//for linux  (OUTPUT PATH)
string opfilePath = "/home/kandarp/ClionProjects/SimulationFileParser/output/";
//for windows
//string opfilePath = "C:/Users/king/ClionProjects/SimulationFileParser/output/";
//for server
//string opfilePath = "/scratch/kpatel/SimulationFileParser/output/";
//string opfilePath = ExePath();


//for linux (FROCE FIELD)

string forcefilePath = "/home/kandarp/ClionProjects/SimulationFileParser/forcefield/";
//for windows
//string forcefilePath = "C:/Users/king/ClionProjects/SimulationFileParser/forcefield/";
//for server
//string forcefilePath = "/scratch/kpatel/SimulationFileParser/forcefield/";
//string forcefilePath  = "/scratch/kpatel/fluide/";
string forcefileName = "FORCE_FIELDS";
//list of Delimiter
string varStoreDelimiter = "$S$";
string varDelimiter = "$V$";
string varPathDelimiter = "$P$";
string varCalDelimiter = "$C$";
string varErrorDelimiter = "@";
string varForceFieldDelimiter = "$F$";
string varForceBlockStart = "$FB-START$";
string varForceBlockEnd = "$FB-END$";
//process variables
vector<fileProcessor> fileProc;
unordered_map<string, string> storeVars;
unordered_map<string, string> globalVars;
vector<string> forcedFiles;
vector<vector<string>> ipFilesContent;
vector<vector<string>> opFilesContent;
vector<forceFieldProcessor> forceFields;
forceFieldProcessor forceField;
vector<string> pairCoffBlock;
vector<string> molecules;
