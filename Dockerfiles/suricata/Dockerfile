# Usa l'immagine ufficiale di Ubuntu
FROM ubuntu:20.04

# Installazione di Suricata
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:oisf/suricata-stable && \
    apt-get update && \
    apt-get install -y suricata && \
    apt-get install -y iproute2 iputils-ping traceroute curl iptables netcat tcpdump net-tools

# Copia del file di configurazione
COPY suricata.yaml /etc/suricata/suricata.yaml
RUN mkdir -p /etc/suricata/rules
COPY /rules/xss.rules /etc/suricata/rules/xss.rules



