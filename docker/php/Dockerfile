FROM php:7.4-fpm

# APT-GET installs
RUN apt-get update && \
    export DEBIAN_FRONTEND=noninteractive && \
    apt-get install -y --no-install-recommends \
    apt-utils \
    curl \
    git \
    htop \
    libcurl4-gnutls-dev \
    libicu-dev \
    libmcrypt-dev \
    libpng-dev \
    libssl-dev \
    libxml2-dev \
    memcached \
    openssl \
    supervisor \
    tcpdump \
    telnet \
    unzip \
    vim \
    wget && \
    rm -rf /var/lib/apt/lists/*

# PHP Extensions
RUN docker-php-ext-install \
    bcmath \
    gd \
    opcache \
    pcntl \
    soap

# Extensions by PECL
RUN pecl install apcu && docker-php-ext-enable apcu && \
    pecl install redis && docker-php-ext-enable redis && \
    pecl install xdebug && docker-php-ext-enable xdebug


# Install and configure NewRelic
RUN curl -L https://download.newrelic.com/php_agent/release/newrelic-php5-9.13.0.270-linux.tar.gz | tar -C /tmp -zx && \
    export NR_INSTALL_USE_CP_NOT_LN=1 && \
    export NR_INSTALL_SILENT=1 && \
    /tmp/newrelic-php5-*/newrelic-install install && \
    rm -rf /tmp/newrelic-php5-* /tmp/nrinstall* && \
    sed -i \
        -e 's/"REPLACE_WITH_REAL_KEY"/"YOUR_LICENSE_KEY"/' \
        -e 's/newrelic.appname = "PHP Application"/newrelic.appname = "globo"/' \
        -e 's/;newrelic.daemon.app_connect_timeout =.*/newrelic.daemon.app_connect_timeout=15s/' \
        -e 's/;newrelic.daemon.start_timeout =.*/newrelic.daemon.start_timeout=5s/' \
        /usr/local/etc/php/conf.d/newrelic.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get -y install nodejs
RUN npm install

# Install Sonar Scanner CLI
RUN mkdir -p /tmp/sonar-scanner && chmod 777 -R -f /tmp/sonar-scanner
RUN wget "https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.4.0.2170-linux.zip" -P /tmp/sonar-scanner
RUN unzip /tmp/sonar-scanner/sonar-scanner-cli-4.4.0.2170-linux.zip -d /tmp/sonar-scanner
ENV PATH="${PATH}:/tmp/sonar-scanner/sonar-scanner-4.4.0.2170-linux/bin"

# PHP Configuration
RUN echo "error_reporting=E_ALL && ~E_DEPRECATED" >> /usr/local/etc/php/php.ini && \
    echo "display_errors=1" >> /usr/local/etc/php/php.ini && \
    echo "error_log=/var/log/php-error.log" >> /usr/local/etc/php/php.ini && \
    echo "max_execution_time=0" >> /usr/local/etc/php/php.ini && \
    echo "max_input_time=-1" >> /usr/local/etc/php/php.ini && \
    echo "memory_limit=4G" >> /usr/local/etc/php/php.ini && \
    echo "date.timezone=UTC" >> /usr/local/etc/php/conf.d/timezone_sao_paulo.ini && \
    echo "upload_max_filesize=50M" >> /usr/local/etc/php/conf.d/max_size.ini && \
    echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=15000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_wasted_percentage=10" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.enable_file_override=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.error_log=/var/log/php-opcache-error.log" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "extension=apcu.so" >> /usr/local/etc/php/conf.d/apcu.ini && \
    echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/apcu.ini && \
    echo "apc.enable=1" >> /usr/local/etc/php/conf.d/apcu.ini && \
    echo "extension=redis.so" >> /usr/local/etc/php/conf.d/redis.ini && \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_host=172.17.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_port=9126" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.idekey=globo" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.profiler_output_dir=/app/data/profiler" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.profiler_output_name=cachegrind.out.%t-%s" >> /usr/local/etc/php/conf.d/xdebug.ini

# PHP-FPM Configuration
RUN echo "pm=static" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.max_children=48" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.start_servers=48" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.min_spare_servers=20" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "pm.max_spare_servers=40" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "catch_workers_output=yes" >> /usr/local/etc/php-fpm.d/www.conf

# Directories
RUN mkdir -p /tmp/globo && chmod 777 -R -f /tmp/globo
RUN mkdir -p /tmp/globo/cache && chmod 777 -R -f /tmp/globo/cache

EXPOSE 9000

WORKDIR /app

CMD ["php-fpm"]
