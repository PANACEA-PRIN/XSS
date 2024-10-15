# Usa un'immagine di MySQL
FROM ubuntu/mysql

# Imposta le variabili d'ambiente per il database predefinito
ENV MYSQL_DATABASE db_web
ENV MYSQL_USER user
ENV MYSQL_ALLOW_EMPTY_PASSWORD = true
ENV MYSQL_PASSWORD ""
ENV MYSQL_ROOT_PASSWORD ""

# Copia uno script SQL per l'inizializzazione del database
COPY init.sql /docker-entrypoint-initdb.d/


# Installa iproute e net-tools utilizzando yum
RUN apt update && apt install -y iproute2 net-tools

# Esponi la porta 3306 per il traffico MySQL
EXPOSE 3306
