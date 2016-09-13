//
// Created by Kandarp on 13/09/16.
//

#include "StoreVariable.h"

const string &StoreVariable::getVarName() const {
    return varName;
}

void StoreVariable::setVarName(const string &varName) {
    StoreVariable::varName = varName;
}

const string &StoreVariable::getVarValue() const {
    return varValue;
}

void StoreVariable::setVarValue(const string &varValue) {
    StoreVariable::varValue = varValue;
}
