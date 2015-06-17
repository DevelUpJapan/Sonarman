#!/bin/bash
LANG=C cat /etc/network/interfaces | grep 'iface eth0 inet'| awk '{print $4;}' | cut -d: -f2
