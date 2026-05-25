FROM php:8.2-apache

# Instala dependencias do banco Aiven e Node.js (para o Tailwind)
RUN apt-get update && apt-get install -y libzip-dev zip unzip curl \
    && docker-php-ext-install pdo_mysql zip
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Aponta o Apache para a pasta /public do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# Copia os arquivos do seu TCC para o servidor
COPY . /var/www/html

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Roda os comandos de instalação
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Dá permissão para o Laravel salvar logs e imagens
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache