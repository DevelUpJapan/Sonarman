##IP configuration

```
#vi /etc/network/interfaces
```

```
auto eth0
iface eth0 inet dhcp

auto eth1
iface eth1 inet static
address 0.0.0.0

auto eth2
iface eth2 inet static
address 0.0.0.0
```
```
#reboot
```

#User Creation
```
#mkdir /home/sonarman
#useradd -d /home/sonarman sonarman
#passwd sonarman
```

#Install sudo
```
#apt-get install sudo

#visudo

www-data ALL=(ALL)NOPASSWD:ALL
sonarman ALL=(ALL)NOPASSWD:ALL
```
save as ctrl+x -> y -> press enter

#Install NTP server
```
#apt-get install ntp
#sudo vi /etc/ntp.conf

#server 0.debian.pool.ntp.org iburst
#server 1.debian.pool.ntp.org iburst
#server 2.debian.pool.ntp.org iburst
#server 3.debian.pool.ntp.org iburst

server ntp.nict.jp
server ntp.nict.jp
server ntp.nict.jp
```
```
#/etc/init.d/ntp restart
```

#Setup Syslog linkage
```
#apt-get install swatch
#apt-get install rsyslog
#vi /etc/rsyslog.conf
```
comment out following
```
$ModLoad imudp.so
$UDPServerRun 514
```
```
#/etc/init.d/rsyslog restart
```

#Install HTTP Server
```
#apt-get install lighttpd
#apt-get install php5-cgi

#vi /etc/lighttpd/lighttpd.conf
```

Add "mod_fastcgi" to server.modules as following.

```
server.modules = (
                   :
                  "mod_fastcgi",
#                 "mod_rewrite",
                 )
```
Edit lighttpd.conf as following.

```
#server.dir-listing = "enable"
server.dir-listing = "disable"
server.follow-symlink = "enable"

fastcgi.server = ( ".php" => ((
"bin-path" => "/usr/bin/php5-cgi",
"socket" => "/tmp/php.socket"
)))
```

```
#chown -R www-data:www-data /var/log/lighttpd/
#/etc/init.d/lighttpd restart
```

#PHP configuration
```
#vi /etc/php5/cgi/php.ini
```
```
date.timezone =Asia/Tokyo
```

#Replace CR+LF -> LF for shellscript
```
#apt-get install nkf
```



#Install tshark
```
#apt-get install tshark
#setcap 'CAP_NET_RAW+eip CAP_NET_ADMIN+eip' /usr/bin/dumpcap
#mkdir /capture
#chmod 777 /capture
```
#Deploy
```
$mkdir /home/sonarman/initial
```
1. Transfer source to Server
2. Decompress source and place to /home/sonarman/initial/

Install source as following  
/home/sonarman/initial/shells  
/home/sonarman/initial/sonarman

```
#chmod 777 /home/sonarman/initial/shells/deploy.sh
#/home/sonarman/initial/shells/deploy.sh
```
#CRON configuration
```
#crontab -e
```
Add following
```
@reboot /home/sonarman/shells/tshark_checker.sh &
@reboot  /home/sonarman/shells/swatch_start.sh &
*/1 * * * * /home/sonarman/shells/cap_delete.sh
```
Configuration is over.
