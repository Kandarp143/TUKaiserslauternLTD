cmake_minimum_required(VERSION 3.6)
project(TestTest)

set(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} -std=c++11")

set(SOURCE_FILES main.cpp add.cpp)
add_executable(TestTest ${SOURCE_FILES})