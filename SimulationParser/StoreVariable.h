#include <iostream>

#ifndef LTDFILEPARSER_FILEPROCESSOR_H
#define LTDFILEPARSER_FILEPROCESSOR_H

using namespace std;

class StoreVariable {

private:
    string varName;
    string varValue;
public:
    const string &getVarName() const;

    void setVarName(const string &varName);

    const string &getVarValue() const;

    void setVarValue(const string &varValue);

};


#endif //SIMULATIONPARSER_STOREVARIABLE_H
