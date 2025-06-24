FROM php:8.1-apache

# Instala dependências para compilar extensões
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    pkg-config \
    build-essential \
    && docker-php-ext-install pdo_pgsql

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Define ServerName para evitar warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia os arquivos da aplicação
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80 exigida pela Render
EXPOSE 80

CMD ["apache2-foreground"]
