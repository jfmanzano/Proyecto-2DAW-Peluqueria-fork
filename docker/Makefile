
UID=$(shell id -u)
GID=$(shell id -g)

.PHONY: help
help:
	@echo "Please use 'make <target>' where <target> is one of"
	@echo "    compile"
	@echo "    start"
	@echo "    stop"
	@echo "    restart"
	@echo "    network-list"
	@echo "    mysql-import (make BACKUP_FILE='' mysql-import)"
	@echo "    bash"
	@echo "    restart"
	@echo "    flush"

.PHONY: compile
compile:
	@make -s stop
	@docker-compose build

.PHONY: clean
clean:
	@docker system prune --volumes --force

.PHONY: up
up:
	export UID=${UID} \
	export GID=${GID} \
	&& docker-compose up --build -d

.PHONY: start
start:
	export UID=${UID} \
	export GID=${GID} \
	&& docker-compose start

.PHONY: down
down:
	@docker-compose down

.PHONY: stop
	@docker-compose stop

.PHONY: network-list
network-list:
	docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' apache-magento-status
	docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' php-magento-status
	docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql-magento-status
	docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' phpmyadmin-magento-status

.PHONY: bash
bash:
	export UID=${UID} \
	export GID=${GID} \
	&& docker exec -it php bash

.PHONY: restart
restart:
	@make -s stop
	@make -s start
	@echo "Restarted"
