FROM php:8.1-apache

# Copia os arquivos para o container
COPY . /var/www/html/

# Habilita o mod_rewrite (opcional)
RUN a2enmod rewrite

# Dá permissões
RUN chown -R www-data:www-data /var/www/html

# Define porta padrão
EXPOSE 80
