FROM php:7.4-fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apk --update --no-cache add git

RUN docker-php-ext-install pdo_mysql

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug-3.0.2 \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_8.x
RUN apk add --update nodejs npm
RUN npm install
RUN node -v
RUN npm -v
RUN npm i -g nodemon
RUN nodemon -v
#RUN cd ./www-data npm run dev

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY php.ini /usr/local/etc/php/

WORKDIR /var/www

CMD composer install ; wait-for-it database:3306 -- bin/console doctrine:migrations:migrate ;  php-fpm 

EXPOSE 9000
