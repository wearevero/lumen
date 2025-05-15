FROM php:8.2-apache

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy source
COPY . /var/www

# Set working dir and permissions
WORKDIR /var/www
RUN chown -R www-data:www-data /var/www

# Set up Apache virtual host
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
