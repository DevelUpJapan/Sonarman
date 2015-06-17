#!/bin/bash

source /home/sonarman/shells/dat/capinterface
source /home/sonarman/shells/dat/cappath
source /home/sonarman/shells/dat/tsharkoption1
source /home/sonarman/shells/dat/tsharkoption2

#include
source /home/sonarman/shells/dat/capfile

#Tshark stop

if [ $interface2 = "eth2" ]; then
    procstring2="pkill -f "'"'"tshark -i "$interface2'"'
    eval ${procstring2}
fi

procstring="pkill -f "'"'"tshark -i "$interface'"'
eval ${procstring}

#Tshark start

if [ $interface2 = "eth2" ]; then
    tsharkcommand2="tshark -i "${interface2}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface2}"_capture.cap "${option2}" >/dev/null 2>&1 &"
    eval ${tsharkcommand2}
fi

tsharkcommand="tshark -i "${interface}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface}"_capture.cap "${option1}" >/dev/null 2>&1 &"
eval ${tsharkcommand}

chmod -R 777 $cappath/cap
chmod -R 777 $cappath/capbackup

exit 0
