cmake_minimum_required(VERSION 3.6)
project(SimulationParser)

set(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} -std=c++11")

set(SOURCE_FILES main.cpp FileProcessor.cpp FileProcessor.h Functions.cpp Globals.cpp)
add_executable(SimulationParser ${SOURCE_FILES})