# Utiliser l'image de base PHP avec Apache
FROM php:8.0-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

# Copier les fichiers du projet dans le répertoire de l'Apache
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html



# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/
# Installer les dépendances du projet
RUN composer install

# Donner les droits nécessaires au répertoire de l'Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache



# Configurer Apache pour utiliser le répertoire public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\nOptions Indexes FollowSymLinks\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Activer le module de réécriture d'URL d'Apache
RUN a2enmod rewrite

# Exposer le port 80
EXPOSE 80

# Lancer Apache en mode foreground
CMD ["apache2-foreground"]


