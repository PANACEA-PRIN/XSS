FROM kathara/quagga:latest
EXPOSE 10443
EXPOSE 10080
EXPOSE 57012
RUN apt-get update && apt-get install -y tcpreplay
RUN  mkdir -p /opt/polarproxy && apt-get update && apt-get install -y curl && curl -s https://www.netresec.com/?download=PolarProxy | tar -xzf - -C /opt/polarproxy
RUN mkdir -p /var/log/PolarProxy
WORKDIR /opt/polarproxy
RUN mkdir -p /etc/ssl
COPY lab.crt /etc/ssl/certs/lab.crt
COPY lab.key /etc/ssl/private/lab.key


