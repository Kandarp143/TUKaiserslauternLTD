#!/bin/bash


# Removing lines from data file containing bond coeff
sed -i '18,21d' data.relaxFluid*


FILE1=./data.relaxFluid*
FILE2=./in.Indent
FILE3=./data.relaxSubstrate*
FILE4=./log.relaxFluid
FILE5=./in.Scratch
FILE6=./in.Remove

# extracting Wall position at end of simulation
ZEND=$(grep WallpositionEnd $FILE4 | grep -v print )
ZEND=$(echo "$ZEND" | awk '{print $2}')

# setting Wall position in coming Sim. files
sed -i '/zzend equal/c\variable        zzend equal '$ZEND'' $FILE2
sed -i '/zzend equal/c\variable        zzend equal '$ZEND'' $FILE5
sed -i '/zzend equal/c\variable        zzend equal '$ZEND'' $FILE6


# extracting lines 6 to 8
FILE1=$(awk 'FNR>=6&&FNR<=8' $FILE1)
FILE3=$(awk 'FNR>=6&&FNR<=8' $FILE3)

# extracting variables
XLO=$(echo "$FILE1" | grep xlo | awk '{print $1}')
XHI=$(echo "$FILE1" | grep xlo | awk '{print $2}')
YLO=$(echo "$FILE1" | grep ylo | awk '{print $1}')
YHI=$(echo "$FILE1" | grep ylo | awk '{print $2}')
ZLO=$(echo "$FILE1" | grep zlo | awk '{print $1}')
ZHI=$(echo "$FILE3" | grep zlo | awk '{print $2}')


#replacing the lines for the box size in in.Indent
sed -i '/xxlo equal/c\variable        xxlo equal '$XLO'' $FILE2
sed -i '/xxhi equal/c\variable        xxhi equal '$XHI'' $FILE2
sed -i '/yylo equal/c\variable        yylo equal '$YLO'' $FILE2
sed -i '/yyhi equal/c\variable        yyhi equal '$YHI'' $FILE2
sed -i '/zzlo equal/c\variable        zzlo equal '$ZLO'' $FILE2
sed -i '/zzhi equal/c\variable        zzhi equal '$ZHI'' $FILE2


