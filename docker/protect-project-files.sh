#!/bin/sh

find ${APP_DIR} -type f -exec chown ${FILES_OWNER_NAME}:${GROUPNAME} {} \;
find ${APP_DIR} -type f -exec chmod 640 {} \;
find ${APP_DIR} -type d -exec chown ${FILES_OWNER_NAME}:${GROUPNAME} {} \;
find ${APP_DIR} -type d -exec chmod 750 {} \;

find ${APP_DIR}/../Globomatik -type f -exec chown ${FILES_OWNER_NAME}:${GROUPNAME} {} \;
find ${APP_DIR}/../Globomatik -type f -exec chmod 640 {} \;
find ${APP_DIR}/../Globomatik -type d -exec chown ${FILES_OWNER_NAME}:${GROUPNAME} {} \;
find ${APP_DIR}/../Globomatik -type d -exec chmod 750 {} \;

chmod 750 ${APP_DIR}

chmod 770 ${APP_DIR}/storage/logs
chown -R ${GROUPNAME}:${GROUPNAME} ${APP_DIR}/storage/logs
chown ${FILES_OWNER_NAME} ${APP_DIR}/storage/logs

chmod 770 ${APP_DIR}/storage/framework/cache
chown -R ${GROUPNAME}:${GROUPNAME} ${APP_DIR}/storage/framework/cache/
chown ${FILES_OWNER_NAME} ${APP_DIR}/storage/framework/cache

chmod 770 ${APP_DIR}/storage/framework/sessions
chown -R ${GROUPNAME}:${GROUPNAME} ${APP_DIR}/storage/framework/sessions/
chown ${FILES_OWNER_NAME} ${APP_DIR}/storage/framework/sessions

chmod 770 ${APP_DIR}/storage/framework/views
chown -R ${GROUPNAME}:${GROUPNAME} ${APP_DIR}/storage/framework/views/
chown ${FILES_OWNER_NAME} ${APP_DIR}/storage/framework/views
