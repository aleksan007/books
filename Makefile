ifneq (,$(wildcard ./.env))
	include ./.env
endif

init-env: ## Создаёт локальные .env и docker-compose.override.yml файлы. Настройте их как вам удобно
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
	fi; \
	if [ ! -f docker-compose.override.yml ]; then \
		cp docker-compose.yml docker-compose.override.yml; \
	fi; \


rm-env:
	@if [ -f docker-compose.override.yml ]; then \
    		rm docker-compose.override.yml; \
    	fi; \
	if [ -f .env ]; then \
				rm .env; \
	fi;


## Инициализирует чистый проект под разработку
init-dev: up-php up-db composer-install migrate after-init

down-clear:
	@docker-compose down -v --remove-orphans

down:
	@docker-compose down

up:
	@docker-compose up -d

up-php:
	@echo "Up php..."; \
	docker-compose pull php; \
	docker-compose up -d --remove-orphans --build php; \
	docker-compose exec php chmod -R 777 ./; \

up-db:
	@echo "Up db..."; \
	docker-compose up -d --remove-orphans --build db; \

migrate:
	@echo "Migrate..."; \
	docker-compose exec php php yii migrate up --interactive=0; \

composer-install: ## Composer install in app container
	@docker-compose exec php composer install --ignore-platform-reqs; \

composer-update: ## Composer update in app container
	@docker-compose exec php composer update; \

into-php:
	@docker-compose exec php /bin/bash

into-db:
	@docker-compose exec db /bin/bash

after-init:
	@echo "-------------------------------------------------------------------------------------------"; \
	echo "Поздравляем! Docker окружение работает!"; \

