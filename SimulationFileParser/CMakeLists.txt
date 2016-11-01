cmake_minimum_required(VERSION 3.6)
project(SimulationFileParser)

set(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} -std=c++11")

set(SOURCE_FILES main.cpp sourceFiles/classes/globalVar.cpp sourceFiles/headers/globalVar.h sourceFiles/classes/globalFun.cpp sourceFiles/headers/globalFun.h sourceFiles/classes/fileProcessor.cpp sourceFiles/headers/fileProcessor.h sourceFiles/classes/forceFieldProcessor.cpp sourceFiles/headers/forceFieldProcessor.h sourceFiles/classes/userIOFuncation.cpp sourceFiles/classes/forceIOFuncation.cpp)
add_executable(SimulationFileParser ${SOURCE_FILES})