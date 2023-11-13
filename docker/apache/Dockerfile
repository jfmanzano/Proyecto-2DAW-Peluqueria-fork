FROM httpd:2.4.49-alpine

LABEL maintainer="jfmanzano"

ENV REFRESHED_AT 2021-09-24

COPY httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf
COPY httpd.conf /usr/local/apache2/conf/httpd.conf
COPY ssl.conf /usr/local/apache2/conf/extra/ssl.conf

RUN apk add --no-cache cifs-utils shadow rsync vim
RUN apk add --no-cache curl && apk upgrade

RUN deluser --remove-home xfs

USER root
ARG UID
ARG USERNAME
ARG USER_HOME_FOLDER
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

ARG APP_DIR
WORKDIR ${APP_DIR}

ARG APACHE_PORT
EXPOSE ${APACHE_PORT}
