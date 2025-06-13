FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    redis-server \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port 8000
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
