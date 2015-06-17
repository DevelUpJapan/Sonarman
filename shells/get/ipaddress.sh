#!/bin/bash
LANG=C cat /etc/network/interfaces | grep 'address'| awk '{print $2;}' | cut -d: -f2
