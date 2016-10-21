//
// Created by Kandarp on 04/09/16.
//

#include "FileProcessor.h"


int FileProcessor::getLineNo() const {
    return lineNo;
}

void FileProcessor::setLineNo(int lineNo) {
    FileProcessor::lineNo = lineNo;
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

const string &FileProcessor::getVarValue() const {
    return varValue;
}

void FileProcessor::setVarValue(const string &varValue) {
    FileProcessor::varValue = varValue;
}

FileProcessor::FileProcessor() {}

