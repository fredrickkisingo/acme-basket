# Use an official PHP image with Composer
FROM php:7.4-cli

# Install system dependencies for Composer, PHPUnit etc.
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files into container
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Run tests by default
CMD ["composer", "test"]
