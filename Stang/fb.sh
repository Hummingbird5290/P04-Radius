#!/bin/sh
export PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/X11R6/bin" 

#/sbin/iptables -L facebook -v -n --line-numbers
/sbin/iptables  -t mangle -F CHECK_SERVICE_PORTS

facebookhost=`nslookup  apps.facebook.com  | grep -v \#53| grep -i address | awk {'print $2'}`

/sbin/iptables -t mangle -A CHECK_SERVICE_PORTS -p tcp -s 192.168.150.0/24 -d $facebookhost  -j  DROP
/sbin/iptables -t mangle -A CHECK_SERVICE_PORTS -p tcp -s 10.0.0.0/16 -d $facebookhost  -j  DROP

/sbin/iptables -t mangle -A CHECK_SERVICE_PORTS -j RETURN
