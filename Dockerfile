FROM php:8.3-apache

# Instala dependências do banco Aiven, Node.js e extensões do Laravel
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

# BALA DE PRATA: Instala ignorando frescuras de versão de ambiente
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Instala pacotes do Node e compila o Tailwind
RUN npm install && npm run build

# Dá permissão de pasta
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache