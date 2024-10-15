#! bin/bash


cp /shared/snort3/snort3-community.rules /home/snorty/snort3/etc/rules/snort3-community.rules
cp /shared/snort3/nfq_inline.lua /home/snorty/snort3/etc/snort/
cp /shared/snort3/afpacket_inline.lua /home/snorty/snort3/etc/snort/


#/home/snorty/snort3/bin/snort -c /home/snorty/snort3/etc/snort/snort.lua -i eth0:eth1 --tweaks afpacket_inline -Q -D

/home/snorty/snort3/bin/snort -c /home/snorty/snort3/etc/snort/snort.lua --tweaks nfq_inline -l /shared/logs/ -Q -i 1 -D

iptables -t nat -I PREROUTING -j NFQUEUE --queue-num 1
iptables -I INPUT -j NFQUEUE --queue-num 1
#iptables -I OUTPUT -j NFQUEUE --queue-num 1
iptables -I FORWARD -j NFQUEUE --queue-num 1

#/shared/snort3/splunk/bin/splunk start --answer-yes --accept-license
