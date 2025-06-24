FROM php:8.1-apache

# Instala dependências e força habilitação do driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    pkg-config \
    build-essential \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Ativa mod_rewrite
RUN a2enmod rewrite

# Evita warning no Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia os arquivos da aplicação
COPY . /var/www/html/

# Corrige permissões
RUN chown -R www-data:www-data /var/www/html

# Exposição obrigatória para Render detectar o serviço
EXPOSE 80

# Mantém o Apache rodando
CMD ["apache2-foreground"]
