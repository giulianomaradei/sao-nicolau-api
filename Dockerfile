# Use a imagem do PHP com Apache como base
FROM php:8.2-apache

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql 

# Ative o módulo rewrite do Apache
RUN a2enmod rewrite

# Copie os arquivos do seu aplicativo para o diretório raiz do servidor web Apache
COPY ./app /var/www/html/

# Copie o arquivo .htaccess para o diretório raiz do servidor web Apache
COPY .htaccess /var/www/html/

# Defina o diretório de trabalho
WORKDIR /var/www/html/

# Exponha a porta 80 para acessar o servidor web
EXPOSE 80

# Inicialize o servidor Apache
CMD ["apache2-foreground"]
