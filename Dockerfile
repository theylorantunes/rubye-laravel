FROM php:8.2-apache

# Instala dependências do banco Aiven, Node.js e extensões vitais do Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring xml bcmath

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Aponta o Apache para a pasta /public do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2enmod rewrite

# Copia os arquivos da loja para o servidor
COPY . /var/www/html

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala pacotes do PHP (ignorando scripts que causam erro no build)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Instala pacotes do Node e compila o Tailwind
RUN npm install && npm run build

# Dá permissão de pasta
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache