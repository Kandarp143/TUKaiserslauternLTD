//
// Created by king on 10/20/2016.
//

#include "../headers/fileProcessor.h"
//
// Created by Kandarp on 13/09/16.
//



int fileProcessor::getFileIndex() const {
    return fileIndex;
}

void fileProcessor::setFileIndex(int fileIndex) {
    fileProcessor::fileIndex = fileIndex;
}

const string &fileProcessor::getFileName() const {
    return fileName;
}

void fileProcessor::setFileName(const string &fileName) {
    fileProcessor::fileName = fileName;
}

int fileProcessor::getLineNo() const {
    return lineNo;
}

void fileProcessor::setLineNo(int lineNo) {
    fileProcessor::lineNo = lineNo;
}

const string &fileProcessor::getLineText() const {
    return lineText;
}

void fileProcessor::setLineText(const string &lineText) {
    fileProcessor::lineText = lineText;
}

const string &fileProcessor::getVarName() const {
    return varName;
}

void fileProcessor::setVarName(const string &varName) {
    fileProcessor::varName = varName;
}

const string &fileProcessor::getVarType() const {
    return varType;
}

void fileProcessor::setVarType(const string &varType) {
    fileProcessor::varType = varType;
}

const string &fileProcessor::getVarValue() const {
    return varValue;
}

void fileProcessor::setVarValue(const string &varValue) {
    fileProcessor::varValue = varValue;
}

int fileProcessor::getVarStartPos() const {
    return varStartPos;
}

void fileProcessor::setVarStartPos(int varStartPos) {
    fileProcessor::varStartPos = varStartPos;
}

int fileProcessor::getVarEndPos() const {
    return varEndPos;
}

void fileProcessor::setVarEndPos(int varEndPos) {
    fileProcessor::varEndPos = varEndPos;
}

const string &fileProcessor::getVarString() const {
    return varString;
}

void fileProcessor::setVarString(const string &varString) {
    fileProcessor::varString = varString;
}
