# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy composer from Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy all Laravel files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key if not yet set
RUN php artisan key:generate || true

# Expose port 80 for web traffic
EXPOSE 80

# Start Laravel using Apache
CMD ["apache2-foreground"]
