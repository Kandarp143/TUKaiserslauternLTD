#!/bin/bash

sed -i 's/\( 1 1 1\) \(.\.\)/ 2 1 1 \2/' data.relaxSubstrate*
# fixes the 'template-ID' of the molecule 'Solid.molecule' to make the date.XX readable for the 'in.relaxFluid'



FILE1=./data.relaxSubstrate*
FILE2=./in.relaxFluid

# extracting lines 6 to 8
FILE1=$(awk 'FNR>=6&&FNR<=8' $FILE1)

# extracting variables
XLO=$(echo "$FILE1" | grep xlo | awk '{print $1}')
XHI=$(echo "$FILE1" | grep xlo | awk '{print $2}')
YLO=$(echo "$FILE1" | grep ylo | awk '{print $1}')
YHI=$(echo "$FILE1" | grep ylo | awk '{print $2}')
ZLO=$(echo "$FILE1" | grep zlo | awk '{print $1}')
ZHI=$(echo "$FILE1" | grep zlo | awk '{print $2}')


#replacing the lines for the box size in in.relaxFluid
sed -i '/xxlo equal/c\variable        xxlo equal '$XLO'' $FILE2
sed -i '/xxhi equal/c\variable        xxhi equal '$XHI'' $FILE2
sed -i '/yylo equal/c\variable        yylo equal '$YLO'' $FILE2
sed -i '/yyhi equal/c\variable        yyhi equal '$YHI'' $FILE2
sed -i '/zzlo equal/c\variable        zzlo equal '$ZLO'' $FILE2
sed -i '/zzhi equal/c\variable        zzhi equal '$ZHI'' $FILE2


