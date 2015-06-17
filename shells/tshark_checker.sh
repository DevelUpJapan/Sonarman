#!/bin/bash

#include
source /home/sonarman/shells/dat/capfile
source /home/sonarman/shells/dat/capinterface
source /home/sonarman/shells/dat/cappath
source /home/sonarman/shells/dat/tsharkoption1
source /home/sonarman/shells/dat/tsharkoption2

while true
do

ps0="ps -ef | grep "
ps1='"'" tshark -i "$interface'"'
ps2="| grep -v grep | wc -l"

#pscheckstring=${ps0}${ps1}${ps2}
pscheckstring="ps -ef | grep '"'tshark -i'"' | grep -v grep | wc -l"

   isAlive=`eval ${pscheckstring}`
	  if [ $isAlive -ge 1 ]; then
	      #echo "Alive"
              :
	   else
              #echo "Dead"
              if [ $interface2 = "eth2" ]; then
                tsharkcommand2="tshark -i "${interface2}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface2}"_capture.cap "${option2}" >/dev/null 2>&1 &"
                eval ${tsharkcommand2}
              fi
                tsharkcommand="tshark -i "${interface}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface}"_capture.cap "${option1}" >/dev/null 2>&1 &"
                eval ${tsharkcommand}
	  fi

chmod -R 777 $cappath/cap
chmod -R 777 $cappath/capbackup

   sleep 300
done






