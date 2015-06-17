#!/bin/bash

#include
source /home/sonarman/shells/dat/capfile
source /home/sonarman/shells/dat/cappath

loopcnt=0
filelimit=$qty
cd $cappath

filelist=`ls -t -r`

for delfname in $filelist; do

	if [ $loopcnt -ge $filelimit -a -f $delfname ]; then
		rm -f $delfname || exit 10 
	#echo "$delfname was deleted!"
	fi

	loopcnt=`expr $loopcnt + 1`
done

exit 0
