//
// Created by king on 10/21/2016.
//

#include "../headers/forceFieldProcessor.h"

const string &forceFieldProcessor::getMolecule() const {
    return molecule;
}

void forceFieldProcessor::setMolecule(const string &molecule) {
    forceFieldProcessor::molecule = molecule;
}

const string &forceFieldProcessor::getNosCites() const {
    return nosCites;
}

void forceFieldProcessor::setNosCites(const string &nosCites) {

    forceFieldProcessor::nosCites = nosCites;


}

const string &forceFieldProcessor::getNosBonds() const {
    return nosBonds;
}

void forceFieldProcessor::setNosBonds(const string &nosBonds) {
    forceFieldProcessor::nosBonds = nosBonds;


}

const vector<string> &forceFieldProcessor::getPairCoffBlock() const {
    return pairCoffBlock;
}

void forceFieldProcessor::setPairCoffBlock(const vector<string> &pairCoffBlock) {
    forceFieldProcessor::pairCoffBlock = pairCoffBlock;
}

const vector<string> &forceFieldProcessor::getMass() const {
    return mass;
}

void forceFieldProcessor::setMass(const vector<string> &mass) {
    forceFieldProcessor::mass = mass;
}

const string &forceFieldProcessor::getSigma() const {
    return sigma;
}

void forceFieldProcessor::setSigma(const string &sigma) {
    forceFieldProcessor::sigma = sigma;
}
