FROM php:5.6-apache

MAINTAINER PlanetaHuerto-dev <dev@planetahuerto.es>

#UPDATE SYSTEM
RUN a2enmod rewrite
RUN apt-get update -y && \
    apt-get install -y git zip unzip nano

#COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

#XDEBUG
RUN pecl install xdebug-2.5.5 && docker-php-ext-enable xdebug
RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20131226/xdebug.so"' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
RUN echo "date.timezone = 'Europe/Madrid'" >> /usr/local/etc/php/php.ini

#APACHE
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /etc/apache2/sites-available
RUN a2ensite 000-default.conf
RUN service apache2 restart



WORKDIR /var/www/html

