FROM php:7.4.24-fpm
ENV REFRESHED_AT 2021-09-24

RUN apt-get update; apt-get install -y wget net-tools vim curl
RUN apt-get install -y libmemcached-dev libz-dev libpq-dev libjpeg-dev libicu-dev libcurl4-openssl-dev && \
    apt-get install -y libfreetype6-dev libmcrypt-dev gnupg g++ pkg-config apt-utils
RUN apt-get install -y wget net-tools iputils-ping mariadb-client traceroute telnet

RUN apt-get install -y libzip-dev zip && \
    docker-php-ext-install zip

# RUN pecl install xdebug && \
#     docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-install pgsql && \
    docker-php-ext-install mysqli
RUN docker-php-ext-install curl && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip
RUN docker-php-ext-install opcache && \
    docker-php-ext-install gettext && \
    docker-php-ext-install intl

RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-webp \
    --with-jpeg \
    --with-xpm \
    --with-freetype && \
    docker-php-ext-install gd

RUN set -ex; \
        docker-php-source extract; \
        { \
                echo '# https://github.com/docker-library/php/issues/103#issuecomment-271413933'; \
                echo 'AC_DEFUN([PHP_ALWAYS_SHARED],[])dnl'; \
                echo; \
                cat /usr/src/php/ext/odbc/config.m4; \
        } > temp.m4; \
        mv temp.m4 /usr/src/php/ext/odbc/config.m4; \
        apt-get update; \
        apt-get install -y --no-install-recommends unixodbc unixodbc-dev tdsodbc freetds-dev freetds-common freetds-bin; \
        docker-php-ext-configure odbc --with-unixODBC=shared,/usr; \
        docker-php-ext-install odbc; \
        docker-php-source delete; \
        apt-get purge -y --auto-remove

RUN apt-get install -y libxml2-dev && \
    docker-php-ext-install soap

RUN apt-get install -y libldb-dev libldap2-dev && \
    docker-php-ext-install ldap

RUN apt-get install -y unzip
RUN apt-get install -y qpdf

RUN curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer

RUN wget -O phpunit https://phar.phpunit.de/phpunit-8.phar; chmod +x phpunit; mv phpunit /usr/local/bin/phpunit

# Enable Remote xdebug
# ARG XDEBUG_INI
# RUN echo "xdebug.idekey = \${XDEBUG_IDEKEY}" >> ${XDEBUG_INI} && \
#     echo "xdebug.default_enable = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.remote_enable = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.remote_autostart = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.remote_connect_back = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.profiler_enable = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.remote_host = \${HOST_IP}" >> ${XDEBUG_INI} && \
#     echo "xdebug.remote_port=9000" >> ${XDEBUG_INI} && \
#     echo "xdebug.cli_color = 0" >> ${XDEBUG_INI} && \
#     echo "xdebug.profiler_enable = \${XDEBUG_ENABLED}" >> ${XDEBUG_INI} && \
#     echo "xdebug.var_display_max_children = -1" >> ${XDEBUG_INI} && \
#     echo "xdebug.var_display_max_data = -1" >> ${XDEBUG_INI} && \
#     echo "xdebug.var_display_max_depth = -1" >> ${XDEBUG_INI}

RUN apt-get install -y openssh-client

RUN apt-get install -y libfcgi0ldbl

RUN apt-get install -y netcat procps

COPY custom-php.ini /usr/local/etc/php/conf.d/
COPY php-fpm.conf /usr/local/etc/php-fpm.conf
COPY odbc.ini /etc/odbc.ini
COPY odbcinst.ini /etc/odbcinst.ini
COPY freetds.conf /etc/freetds/freetds.conf

ARG UID
ARG USERNAME
ARG APP_DIR
ARG USER_HOME_FOLDER
USER root
WORKDIR ${APP_DIR}

RUN useradd -ms /bin/bash ${USERNAME} || true
RUN usermod -u ${UID} ${USERNAME} || true
RUN usermod -d ${USER_HOME_FOLDER} ${USERNAME}
ARG FILES_OWNER_UID
ARG FILES_OWNER_NAME
RUN useradd -ms /bin/bash ${FILES_OWNER_NAME} || true
RUN usermod -u ${FILES_OWNER_UID} ${FILES_OWNER_NAME} || true
ARG GID
ARG GROUPNAME
RUN groupmod -g ${GID} ${GROUPNAME} || true
RUN usermod -a -G ${GROUPNAME} ${USERNAME}

RUN mkdir ${USER_HOME_FOLDER}/.ssh
COPY id_rsa ${USER_HOME_FOLDER}/.ssh/
RUN chmod 400 ${USER_HOME_FOLDER}/.ssh/id_rsa
COPY id_rsa.pub ${USER_HOME_FOLDER}/.ssh/
COPY known_hosts ${USER_HOME_FOLDER}/.ssh/
COPY config ${USER_HOME_FOLDER}/.ssh/
RUN chown -R ${USERNAME} ${USER_HOME_FOLDER}/.ssh && chmod 700 ${USER_HOME_FOLDER}/.ssh

USER ${USERNAME}
CMD ["php-fpm"]

ARG PHP_PORT
EXPOSE ${PHP_PORT}

