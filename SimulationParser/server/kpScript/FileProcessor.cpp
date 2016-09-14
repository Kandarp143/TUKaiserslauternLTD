//
// Created by Kandarp on 13/09/16.
//

#include "FileProcessor.h"

int FileProcessor::getFileIndex() const {
    return fileIndex;
}

void FileProcessor::setFileIndex(int fileIndex) {
    FileProcessor::fileIndex = fileIndex;
}

const string &FileProcessor::getFileName() const {
    return fileName;
}

void FileProcessor::setFileName(const string &fileName) {
    FileProcessor::fileName = fileName;
}

int FileProcessor::getLineNo() const {
    return lineNo;
}

void FileProcessor::setLineNo(int lineNo) {
    FileProcessor::lineNo = lineNo;
}

const string &FileProcessor::getLineText() const {
    return lineText;
}

void FileProcessor::setLineText(const string &lineText) {
    FileProcessor::lineText = lineText;
}

const string &FileProcessor::getVarName() const {
    return varName;
}

void FileProcessor::setVarName(const string &varName) {
    FileProcessor::varName = varName;
}

const string &FileProcessor::getVarType() const {
    return varType;
}

void FileProcessor::setVarType(const string &varType) {
    FileProcessor::varType = varType;
}

const string &FileProcessor::getVarValue() const {
    return varValue;
}

void FileProcessor::setVarValue(const string &varValue) {
    FileProcessor::varValue = varValue;
}

int FileProcessor::getVarStartPos() const {
    return varStartPos;
}

void FileProcessor::setVarStartPos(int varStartPos) {
    FileProcessor::varStartPos = varStartPos;
}

int FileProcessor::getVarEndPos() const {
    return varEndPos;
}

void FileProcessor::setVarEndPos(int varEndPos) {
    FileProcessor::varEndPos = varEndPos;
}

const string &FileProcessor::getVarString() const {
    return varString;
}

void FileProcessor::setVarString(const string &varString) {
    FileProcessor::varString = varString;
}
