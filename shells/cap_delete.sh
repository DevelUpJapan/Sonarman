#!/bin/bash

#include
source /home/sonarman/shells/dat/capfile
source /home/sonarman/shells/dat/cappath

filelimit=$qty
cd $cappath/cap

current=`ls -l | wc -l`
deletefiles=`expr $current - $qty`

if [ $current -gt $qty ]; then
    ls -t | tail -${deletefiles} | xargs rm
fi

exit 0
