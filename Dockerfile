FROM php:5.6-fpm

LABEL maintainer="nicolas.rigaud@agence-ohana.fr"

ARG AGENDAV_VERSION

RUN apt-get update && \
    apt-get install -y wget zlib1g-dev libicu-dev g++ && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configure PHP extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-source delete

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    echo 'magic_quotes_runtime = false' >> /usr/local/etc/php/php.ini 

RUN cd /tmp && \
    wget https://github.com/agendav/agendav/releases/download/$AGENDAV_VERSION/agendav-$AGENDAV_VERSION.tar.gz && \
    tar -xf agendav-${AGENDAV_VERSION}.tar.gz -C /tmp && \
    mv /tmp/agendav-${AGENDAV_VERSION} /var/www/agendav && \
    chown -R www-data:www-data /var/www/agendav/web && \
    chmod -R 750 /var/www/agendav/web/var && \
    rm /tmp/agendav-${AGENDAV_VERSION}.tar.gz

COPY settings.php /var/www/settings.php

RUN ln -s /var/www/settings.php /var/www/agendav/web/config/settings.php

WORKDIR /var/www/agendav
