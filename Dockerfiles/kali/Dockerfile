
FROM kalilinux/kali-rolling

ENV DEBIAN_FRONTEND=noninteractive
# Installazione dei pacchetti base e aggiornamento
RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y kali-linux-headless
RUN apt-get install -y iputils-ping net-tools nano tightvncserver
RUN apt-get update && apt -y install powershell
RUN apt-get update && apt-get install -y python3 python3-pip python3-venv

# Installazione di Firefox
RUN apt-get install -y firefox-esr
RUN apt -y install seclists

ENV TERM=xterm
# Clone del progetto Beef
RUN git clone https://github.com/beefproject/beef.git 
COPY config.yaml /beef/config.yaml
RUN cd /beef && yes | ./install
# Usa PowerShell per lo scripting
SHELL ["pwsh", "-Command"]

# Installazione di Atomic Red Team
RUN IEX (IWR 'https://raw.githubusercontent.com/redcanaryco/invoke-atomicredteam/master/install-atomicredteam.ps1' -UseBasicParsing); \
    Install-AtomicRedTeam -getAtomics

# Crea il profilo PowerShell
RUN New-Item $PROFILE -Force

# Copia dei file di configurazione dell'attaccante
COPY attacker /home/attacker
RUN python3 -m venv /opt/venv
ENV PATH="/opt/venv/bin:$PATH"

# Install git, supervisor, VNC, & X11 packages
RUN set -ex; \
    apt-get update; \
    apt-get install -y \
      bash \
      fluxbox \
      git \
      net-tools \
      novnc \
      supervisor \
      x11vnc \
      xterm \
      xvfb \
      curl \
      zaproxy \
      xsser \
      dirsearch

# Installazione di Apache
RUN apt-get install -y apache2

# Abilita moduli Apache e setta configurazione
RUN a2enmod rewrite \
    && a2enmod ssl \
    && a2enmod headers \
    && service apache2 restart
COPY lab.crt /etc/ssl/certs/lab.crt
COPY lab.key /etc/ssl/private/lab.key
# Configura il file di configurazione di Apache
COPY httpd.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Clone di XSStrike 
RUN git clone https://github.com/s0md3v/XSStrike.git /opt/XSStrike

RUN cp -r /home/attacker /var/www/html/
# Installazione delle dipendenze di XSStrike
RUN /opt/venv/bin/pip install -r /opt/XSStrike/requirements.txt
RUN /opt/venv/bin/pip install arjun

RUN apt update && \
    apt install -y zip curl wget git && \
    apt install -y golang  && \
    wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub |  apt-key add - && \
    sh -c 'echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' && \
    apt update && \ 
    go install github.com/projectdiscovery/katana/cmd/katana@latest

# Setup demo environment variables
ENV HOME=/root \
    DEBIAN_FRONTEND=noninteractive \
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    LC_ALL=C.UTF-8 \
    DISPLAY=:0.0 \
    DISPLAY_WIDTH=1024 \
    DISPLAY_HEIGHT=768 \
    RUN_XTERM=yes \
    RUN_FLUXBOX=yes
COPY . /app

RUN /opt/venv/bin/pip install --upgrade pip



# Scarica Burp Suite
RUN curl -L "https://portswigger.net/burp/releases/download?product=community&version=2023.8.1&type=jar" -o /opt/burpsuite.jar

# Imposta Java come variabile d'ambiente
ENV JAVA_HOME=/usr/lib/jvm/java-17-openjdk-amd64ENV PATH="$JAVA_HOME/bin:${PATH}"



SHELL ["/bin/zsh"]

CMD ["/app/entrypoint.sh"]

EXPOSE 8080
