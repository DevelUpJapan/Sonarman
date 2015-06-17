Sonarman
====

##Overview


Sonarman can be continuously capture network packet.
Sonarman is useful tool in following cases.

-  Resolving network problem that difficult to reproduce
-  Make efficient of troubleshooting
-  Complement the log function
-  Enable to save evidence

## Description
Sonarman was developed for the purpose of dealing with packet as network evidence to simple.
Sonarman works with syslog by swatch.
This software can save packet depending on syslog messages.
You can save evidence surely when a problem happened.
I hope Sonarman will reduce the trouble of system administrators.

## Requirement

Sonarman depends on following software.

- sudo
- ntp
- swatch
- rsyslog
- lighttpd
- php5-cgi
- nkf
- tshark

Setup these software appropriately.
Refer to "EnvironmentSetupGuide.txt"

I checked Sonarman in Debian wheezy.
I provide Sonarman environment also as OVF.

## Usage
Access to http://Host/
Default password is admin/pass

Refer to "User'sGuide" from following link.

## Install
Refer to SetupGuide.md


## Contribution

1. Fork it
2. Create your feature branch (git checkout -b my-new-feature)
3. Commit your changes (git commit -am 'Add some feature')
4. Push to the branch (git push origin my-new-feature)
5. Create new Pull Request


## Licence
[MIT]

This software includes the work that is distributed in the Apache License 2.0
- Twitter Bootstrap
