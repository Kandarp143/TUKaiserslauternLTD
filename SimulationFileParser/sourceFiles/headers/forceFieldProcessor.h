//
// Created by king on 10/21/2016.
//
#include <iostream>
#include<vector>

#ifndef SIMULATIONFILEPARSER_FORCEFIELDPROCESSOR_H
#define SIMULATIONFILEPARSER_FORCEFIELDPROCESSOR_H

using namespace std;

class forceFieldProcessor {
private:
    string molecule;
public:
    const string &getNosCites() const;

    void setNosCites(const string &nosCites);

    const string &getNosBonds() const;

    void setNosBonds(const string &nosBonds);

    const vector<string> &getPairCoffBlock() const;

    void setPairCoffBlock(const vector<string> &pairCoffBlock);

private:
    string nosCites;
    string nosBonds;
public:
    const string &getMolecule() const;

    void setMolecule(const string &molecule);

private:
    vector<string> pairCoffBlock;
    vector<string> mass;
public:
    const vector<string> &getMass() const;

    void setMass(const vector<string> &mass);
};


#endif //SIMULATIONFILEPARSER_FORCEFIELDPROCESSOR_H
