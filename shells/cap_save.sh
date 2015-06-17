#!/bin/bash
source /home/sonarman/shells/dat/capinterface
source /home/sonarman/shells/dat/cappath
source /home/sonarman/shells/dat/tsharkoption1
source /home/sonarman/shells/dat/tsharkoption2

message=$1

#include
source /home/sonarman/shells/dat/capfile

#Tshark stop

if [ $interface2 = "eth2" ]; then
    procstring2="pkill -f "'"'"tshark -i "$interface2'"'
    eval ${procstring2}
fi

procstring="pkill -f "'"'"tshark -i "$interface'"'
eval ${procstring}

###################################
#create new directory
#replace space to underbar
###################################

time=`date '+%Y%m%d%H%M%S'`
#echo $time

#create deirectory for backup

dirname=`echo $message | sed -e "s/ /_/g"`
pathname=$cappath/capbackup/$time$dirname
mkdir $pathname

#go to capture output directory
cd $cappath/cap/

#sort by time and copy to the directory
if [ $interface2 = "eth2" ]; then
    ls -t | head -4 | xargs -I % -t cp % $pathname
else
    ls -t | head -2 | xargs -I % -t cp % $pathname
fi

#compress the directory
cd $cappath/capbackup/
compressname=$time$dirname
tar zcvf $pathname".tar.gz" "./"$compressname


# delete the directory
if [ -s $pathname".tar.gz" ]; then
  rm -r $pathname
fi

#Tshark restart

if [ $interface2 = "eth2" ]; then
    tsharkcommand2="tshark -i "${interface2}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface2}"_capture.cap "${option2}" >/dev/null 2>&1 &"
    eval ${tsharkcommand2}
fi

tsharkcommand="tshark -i "${interface}" -b filesize:"${size}" -b files:"${qty}" -w "${cappath}""/cap/""${interface}"_capture.cap "${option1}" >/dev/null 2>&1 &"
eval ${tsharkcommand}

chmod -R 777 $cappath/cap
chmod -R 777 $cappath/capbackup

exit 0

