FROM php:8.1-apache

# Instalar extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar módulos Apache
RUN a2enmod rewrite

# Instalar wait-for-it para aguardar MySQL
RUN apt-get update && apt-get install -y wget \
    && wget -O /wait-for-it.sh https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh \
    && chmod +x /wait-for-it.sh

# Configurar charset padrão do PHP
RUN echo "default_charset = UTF-8" >> /usr/local/etc/php/conf.d/charset.ini

# Copiar código fonte
COPY src/ /var/www/html/

# Definir permissões
RUN chown -R www-data:www-data /var/www/html

# Script de inicialização
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]