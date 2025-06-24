# Usa imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instala driver PDO para PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Ativa mod_rewrite (útil para .htaccess se usado)
RUN a2enmod rewrite

# Define um ServerName para suprimir avisos do Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia os arquivos da aplicação
COPY . /var/www/html/

# Dá permissões apropriadas ao diretório
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80 (Render exige isso)
EXPOSE 80

# Comando padrão do container Apache
CMD ["apache2-foreground"]
