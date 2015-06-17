#!/bin/bash
LANG=C cat /home/sonarman/shells/dat/capinterface | awk '{print $2;}' | cut -d'=' -f2
