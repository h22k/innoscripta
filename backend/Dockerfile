# Use the latest PHP version
FROM php:latest

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application
COPY . .

# Run necessary commands
RUN composer install

# Start the PHP server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
