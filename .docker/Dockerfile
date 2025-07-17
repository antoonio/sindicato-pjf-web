# Use the php:8.2-apache base image
FROM php:8.2-apache

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    unzip \
    git \
    libpcre3-dev \
    gcc \
    make \
    autoconf \
    pkg-config \
    curl \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Apache configuration
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/
COPY .docker/apache/apache2.conf /etc/apache2/

# PHP configuration
COPY .docker/php/php.ini /usr/local/etc/php/

# Marca el directorio como seguro para Git
RUN git config --global --add safe.directory /var/www/html

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader

# Create necessary directories and set permissions
RUN mkdir -p var/cache/dev var/cache/prod var/log \
    && chmod -R 777 var

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash - && mv ~/.symfony*/bin/symfony /usr/local/bin/symfony

# Install Node.js 18.x and npm
RUN apt-get update && apt-get install -y curl ca-certificates gnupg \
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_18.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && node -v && npm -v \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configura carpeta para claves JWT si aplica
RUN mkdir -p config/jwt \
    && chmod -R 755 config/jwt \
    && if [ -f config/jwt/private.pem ]; then chmod 640 config/jwt/private.pem; fi \
    && if [ -f config/jwt/public.pem ]; then chmod 644 config/jwt/public.pem; fi

# Set ownership to Apache user
RUN chown -R www-data:www-data /var/www/html