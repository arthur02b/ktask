# Imagem base com Apache + PHP
FROM php:8.1-apache

# Ativa o mod_rewrite (se necessário para .htaccess)
RUN a2enmod rewrite

# Define o ServerName para eliminar o warning do Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copia todos os arquivos do projeto para o diretório do Apache
COPY . /var/www/html/

# Dá as permissões necessárias
RUN chown -R www-data:www-data /var/www/html

# Expõe a porta 80 — ESSENCIAL PARA RENDER
EXPOSE 80

# Inicia o Apache no modo foreground (padrão do Render)
CMD ["apache2-foreground"]
