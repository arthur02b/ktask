FROM php:8.1-apache

# Instala o driver do PostgreSQL com todas as dependências
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libedit-dev \
    && docker-php-ext-install pdo_pgsql

# Ativa mod_rewrite
RUN a2enmod rewrite

# Elimina aviso de ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia os arquivos do projeto para a pasta do Apache
COPY . /var/www/html/

# Corrige permissões
RUN chown -R www-data:www-data /var/www/html

# Exposição obrigatória para Render reconhecer o serviço
EXPOSE 80

# Mantém o Apache rodando em primeiro plano
CMD ["apache2-foreground"]
