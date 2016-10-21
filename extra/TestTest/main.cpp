#include <iostream>

//int add(int x, int y); // needed so main.cpp knows that add() is a function declared elsewhere
//int main() {
//   using namespace std;
//    cout << "The sum of 3 and 4 is: " << add(3, 4) << endl;
//    cout << "The sum "<<endl;
//    return 0;
//}

//#include "file3.h"
//#include "prog1.h"
//#include <stdio.h>
//
//int main(void)
//{
//    use_it();
//    global_variable += 19;
//    use_it();
//    printf("Increment: %d\n", increment());
//    return 0;
//}


//#include <iostream>
//#include <vector>
//#include <fstream>
//#include <unordered_map>
//#include "Variables.h"
//
//int main(void)
//{
//    cout<<ipFiles<<endl;
//    cout<<globalQue<<endl;
//    cout<<ipfilePath<<endl;
//    cout<<opfilePath<<endl;
//    cout<<forcefilePath<<endl;
//    cout<<varStoreDelimiter<<endl;
//    cout<<varDelimiter<<endl;
//    cout<<varPathDelimiter<<endl;
//    cout<<varCalDelimiter<<endl;
//    cout<<varErrorDelimiter<<endl;
//
//
//    return 0;



#include <stdlib.h>
#include <sstream>


int main()
{
    std::string word = "5.6";
    double lol = atof(word.c_str())*100; /*c_str is needed to convert string to const char*
                                     previously (the function requires it)*/
    std::cout<<lol<<std::endl;
    std::ostringstream strs;
    strs << lol;
    std::string str = strs.str();
    std::cout<<str<<std::endl;
    return 0;
}