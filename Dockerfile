FROM php:8.2-apache

# Install system packages
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only composer files first (for cache)
COPY composer.json composer.lock ./

# Allow unlimited memory for composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Install dependencies (optimized)
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

# Copy project files
COPY . .

# Run scripts after
RUN composer dump-autoload --optimize

# Fix permissions
RUN chown -R www-data:www-data var

# Set public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

EXPOSE 80
