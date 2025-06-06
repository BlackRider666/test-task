FROM php:8.3.6-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zip \
    unzip \
    locales \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    supervisor \
    sudo \
    && rm -r /var/lib/apt/lists/* \
        && sed -i 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen \
        && sed -i 's/# uk_UA.UTF-8 UTF-8/uk_UA.UTF-8 UTF-8/' /etc/locale.gen \
        && locale-gen

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

RUN curl -sL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    chown -R $user:$user /var/www/

ADD php/php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# Set working directory
WORKDIR /var/www/api
RUN mkdir -p /var/log/supervisor && \
    touch /var/log/supervisor/supervisord.log && \
    chown -R $user:$user /var/log/supervisor && \
    chown -R $user:$user /var/run/

USER $user

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
