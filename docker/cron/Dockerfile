FROM php:7.4-fpm-alpine

# Install PHP and some extensions
RUN apk add --update-cache \
    php \
    php-common \
    php-fpm \
    php-sodium \
    php-bcmath \
    php-bz2 \
    php-calendar \
    php-ctype \
    php-curl \
    php-gd \
    php-intl \
    php-json \
    php-mbstring \
    php-opcache \
    php-openssl \
    php-pear

RUN php -v
RUN apk add nginx

COPY scheduler.conf /etc/crontabs/root

ENV PATH="${PATH}:/app/bin"

WORKDIR /app

CMD ["crond", "-f", "-d", "8"]
