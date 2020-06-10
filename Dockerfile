FROM php:7.3-fpm

# Comment this to improve stability on "auto deploy" environments
RUN apt-get update -y \

    && apt-get install -y \
        git \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libsqlite3-dev \
        libedit-dev \
        libbz2-dev \
        libcurl4-openssl-dev \
        libzip-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) pdo_sqlite readline zip gd json intl opcache pdo_mysql mysqli mbstring bz2 calendar curl fileinfo exif gettext iconv hash


# Install basic dependencies
#RUN apt -u add bash git

# Install PHP extensions
ADD ./.docker/install-php.sh /usr/sbin/install-php.sh
RUN chmod +x /usr/sbin/install-php.sh
RUN /usr/sbin/install-php.sh

# Copy existing application directory contents
COPY ./.docker/*.ini /usr/local/etc/php/conf.d/
COPY . .

# Change current user to www-data
USER www-data

# Expose ports and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
