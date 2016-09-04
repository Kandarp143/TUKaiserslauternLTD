#include <iostream>
#include <string>
#include <regex>


using namespace std;

string parse_string(const string &str);


int main() {
    string str, sub; // str is string to search, sub is the substring to search for

    str = "Enter : $$ Enter Your Name $$ & University : $$ Enter Your University $$ Enter Address : $$ Address please $$ &&& Enter Phone No: $$ Please add local phone no$$";
    sub = "$$";

    int pos = str.find(sub, 0);
    while (pos != string::npos) {
        cout << pos << endl;
        pos = str.find(sub, pos + 1);
    }

    int a = 89;
    int b = 107;
    cout << str.at(a) << endl;
    cout << str.at(b) << endl;
    cout << str.substr(a, b - a + 2) << endl;


    return 0;
}

