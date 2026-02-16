#!/bin/bash
set -e

# Change file permissions for public directory
chown www-data:www-data ${APACHE_DOCUMENT_ROOT}
chmod -R 777 ${APACHE_DOCUMENT_ROOT}

# Update the Apache configuration to use the new document root (for SSL and non-SSL)
sed -ri -e "s#^([[:space:]]*)DocumentRoot .*#\1DocumentRoot ${APACHE_DOCUMENT_ROOT}#" /etc/apache2/sites-available/000-default.conf
sed -ri -e "s#^([[:space:]]*)DocumentRoot .*#\1DocumentRoot ${APACHE_DOCUMENT_ROOT}#" /etc/apache2/sites-available/default-ssl.conf

# Create SSL directory and certificate files
CERT_DIR="/etc/apache2/ssl"
CERT_FILE="${CERT_DIR}/server.crt"
KEY_FILE="${CERT_DIR}/server.key"

# Create folder if not exists
mkdir -p "$CERT_DIR"

# Generate self-signed certificate if not exists
if [[ ! -f "$CERT_FILE" || ! -f "$KEY_FILE" ]]; then
  echo "Generating self-signed certificate..."
  openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout "$KEY_FILE" \
    -out "$CERT_FILE" \
    -subj "/C=XX/ST=Dev/L=Dev/O=Dev/OU=Dev/CN=localhost"
fi

# Enable SSL and HTTPS site
a2enmod ssl
a2ensite default-ssl

# Replace certificate files paths in default-ssl.conf
sed -ri -e "s#^([[:space:]]*)SSLCertificateFile .*#\1SSLCertificateFile ${CERT_FILE}#" /etc/apache2/sites-available/default-ssl.conf
sed -ri -e "s#^([[:space:]]*)SSLCertificateKeyFile .*#\1SSLCertificateKeyFile ${KEY_FILE}#" /etc/apache2/sites-available/default-ssl.conf

# Add ServerName to Apache config
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Create and configure PHP uploads settings
touch /usr/local/etc/php/conf.d/uploads.ini
echo "upload_max_filesize = 64M" >> /usr/local/etc/php/conf.d/uploads.ini
echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini

# Set PHP memory limit to 1024M
echo 'memory_limit = 1024M' > /usr/local/etc/php/conf.d/memory-limit.ini
