#include <iostream>

#ifndef LTDFILEPARSER_FILEPROCESSOR_H
#define LTDFILEPARSER_FILEPROCESSOR_H

using namespace std;

class FileProcessor {
private:
    int fileIndex;
    string fileName;
    int lineNo;
    string lineText;
    string varName;
    string varType;
    string varValue;
    int varStartPos;
    int varEndPos;
public:
    int getFileIndex() const;

    void setFileIndex(int fileIndex);

    const string &getFileName() const;

    void setFileName(const string &fileName);

    int getLineNo() const;

    void setLineNo(int lineNo);

    const string &getLineText() const;

    void setLineText(const string &lineText);

    const string &getVarName() const;

    void setVarName(const string &varName);

    const string &getVarType() const;

    void setVarType(const string &varType);

    const string &getVarValue() const;

    void setVarValue(const string &varValue);

    int getVarStartPos() const;

    void setVarStartPos(int varStartPos);

    int getVarEndPos() const;

    void setVarEndPos(int varEndPos);

};

#endif //SIMULATIONPARSER_FILEPROCESSOR_H
