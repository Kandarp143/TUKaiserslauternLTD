#include <iostream>

#ifndef LTDFILEPARSER_FILEPROCESSOR_H
#define LTDFILEPARSER_FILEPROCESSOR_H

using namespace std;

class FileProcessor {
public:
    FileProcessor(int lineNo);

    int getLineNo() const;

    void setLineNo(int lineNo);

    const string &getLineText() const;

    void setLineText(const string &lineText);

    const string &getVarName() const;

    void setVarName(const string &varName);

    const string &getVarValue() const;

    void setVarValue(const string &varValue);

    int getVarStartPos() const;

    void setVarStartPos(int varStartPos);

    int getVarEndPos() const;

    void setVarEndPos(int varEndPos);

private:
    int lineNo;
    string lineText;
    string varName;
    string varValue;
    int varStartPos;
    int varEndPos;

};


#endif //LTDFILEPARSER_FILEPROCESSOR_H
