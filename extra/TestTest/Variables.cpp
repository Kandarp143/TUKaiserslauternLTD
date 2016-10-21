//
// Created by king on 10/20/2016.
//
#include <iostream>
#include "Variables.h"

using namespace std;
string ipFiles[] = {"in.relaxSubstrate", "in.relaxFluid", "in.Indent", "in.Scratch", "in.Remove"};
string globalQue[] = {"Cylinder or Sphere (c/s) "};
string ipfilePath = "C:/Users/king/ClionProjects/SimulationParser/input/";
string opfilePath = "C:/Users/king/ClionProjects/SimulationParser/output/";
string forcefilePath = "C:/Users/king/ClionProjects/SimulationParser/forcefield/";
string varStoreDelimiter = "$S$";
string varDelimiter = "$V$";
string varPathDelimiter = "$P$";
string varCalDelimiter = "$C$";
string varErrorDelimiter = "@";
