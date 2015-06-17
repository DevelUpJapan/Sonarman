#!/bin/bash
LANG=C cat /etc/network/interfaces | grep 'gateway'| awk '{print $2;}' | cut -d: -f2
