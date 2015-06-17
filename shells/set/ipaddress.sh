#!/bin/bash
LANG=C
cat << EOS >/etc/network/interfaces
# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
auto eth0
iface eth0 inet static
address $1
netmask $2
gateway $3

auto eth1
iface eth1 inet static
address 0.0.0.0

auto eth2
iface eth2 inet static
address 0.0.0.0

EOS

/etc/init.d/networking restart