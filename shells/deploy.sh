#!/bin/bash

#script deploy
shelldir=/home/sonarman/shells

rm -rf $shelldir 2>/dev/null
mkdir -p $shelldir 2>/dev/null

chmod -R 777 /home/sonarman/initial/shells/

#replace CR+LF -> LF
find /home/sonarman/initial/shells/ -name \*.sh -type f | xargs -n 10 nkf -Lu --overwrite

mv /home/sonarman/initial/shells/cap_save.sh $shelldir
mv /home/sonarman/initial/shells/cap_delete.sh $shelldir
mv /home/sonarman/initial/shells/swatch_start.sh $shelldir
mv /home/sonarman/initial/shells/tshark_checker.sh $shelldir
mv /home/sonarman/initial/shells/reboot.sh $shelldir
mv /home/sonarman/initial/shells/cap_change.sh $shelldir
mv /home/sonarman/initial/shells/swatchrc $shelldir
mv /home/sonarman/initial/shells/dat/ $shelldir
mv /home/sonarman/initial/shells/set/ $shelldir
mv /home/sonarman/initial/shells/get/ $shelldir

#HTML deploy

webdir=/var/www/sonarman

rm -r $webdir 2>/dev/null

mv -f /home/sonarman/initial/sonarman/index.html /var/www/
mv -f /home/sonarman/initial/sonarman /var/www/

#Create symbolic link for capture

    if [ -e /capture/cap ]; then
        # exist nothing to do
        :
    else
        # not exist
        mkdir /capture/cap
        chmod -R 777 /capture/cap
    fi

    if [ -e /capture/capbackup ]; then
        # exist nothing to do
        :
    else
        # not exist
        mkdir /capture/capbackup
        chmod -R 777 /capture/capbackup
    fi

ln -s /capture/cap/ /var/www/sonarman/cap
ln -s /capture/capbackup/ /var/www/sonarman/capbackup