#!/bin/bash
LANG=C cat /etc/network/interfaces | grep 'netmask'| awk '{print $2;}' | cut -d: -f2
