FROM php:8.2-apache

# Install all needed packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    openssl \
    libpng-dev \
    libicu-dev \
    default-mysql-client \
    build-essential \
    automake \
    autoconf \
    libtool \
    gnupg \
    gifsicle \
    libmagickwand-dev --no-install-recommends

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN docker-php-ext-install \
    zip \
    mysqli \
    gd \
    exif \
    intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Node.js and Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs
RUN npm install -g yarn

# Copy the existing application directory permissions
COPY ./wpelementor /var/www/html

# Set working directory
WORKDIR /var/www/html

# Copy entrypoint scripts and make them executable
COPY ./entrypoint/* /usr/local/bin/
RUN chmod +x /usr/local/bin/*

# Set the entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
