# Use the official PHP with Apache image
FROM php:apache

# Maintainer of the image
LABEL maintainer="capriotti.1984129@studenti.uniroma1.it"

# Install PHP extensions
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install session

# Update packages and install dependencies for ModSecurity, SSL
RUN apt-get update && \
    apt-get install -y \
    libapache2-mod-security2 \
    git \
    openssl \
    iproute2 \
    ufw \
    wget \
    tcpdump \
    net-tools \
    certbot \
    cron && \
    apt-get clean 
# Enable the security2 and ssl modules in Apache
RUN a2enmod security2
#RUN a2dismod security2
RUN a2enmod ssl 
RUN a2enmod dump_io
RUN a2enmod rewrite

COPY lab.crt /etc/ssl/certs/lab.crt
COPY lab.key /etc/ssl/private/lab.key
# Copy the main Apache configuration file and SSL configuration file
COPY httpd.conf /etc/apache2/sites-available/httpd.conf
RUN echo "ServerName websitelab" >> /etc/apache2/apache2.conf
RUN a2ensite httpd.conf



# Configure SSL
RUN sed -i '/SSLCertificateFile.*snakeoil\.pem/c\SSLCertificateFile /etc/ssl/certs/lab.crt' /etc/apache2/sites-available/default-ssl.conf
RUN sed -i '/SSLCertificateKeyFile.*snakeoil\.key/c\SSLCertificateKeyFile /etc/ssl/private/lab.key' /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default-ssl


# Clone the OWASP ModSecurity CRS repository and configure CRS
RUN cd /etc && \
    git clone https://github.com/coreruleset/coreruleset.git && \
    mv coreruleset /etc/modsecurity-crs && \
    cp /etc/modsecurity-crs/crs-setup.conf.example /etc/modsecurity-crs/crs-setup.conf && \
    cp /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf && \
    sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' /etc/modsecurity/modsecurity.conf 



# Create the directory for storing the images
RUN mkdir -p /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/uploads && \
    chmod -R 755 /var/www/html/uploads

# Copy your website files to the container's web root directory
COPY ./webXss /var/www/html





