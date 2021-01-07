FROM php:7.3-apache

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get update
RUN apt-get install git zip vim --yes
RUN docker-php-ext-install pcntl pdo pdo_mysql
COPY ressources/memory_limit.ini /usr/local/etc/php/conf.d/memory_limit.ini
RUN a2enmod rewrite

ENV API_DOCUMENT_ROOT /var/www/html/api/public
ENV APACHE_LOG_DIR /var/log/apache2


ADD vhosts /etc/apache2/sites-available

#RUN sed -ri -e 's!/var/www/html!${BO_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${BO_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf