# Блок управления приложением
up: docker-up
down: docker-down
build: docker-build

docker-up:
	docker compose up --detach --remove-orphans

docker-down:
	docker compose down --remove-orphans

docker-build:
	docker compose build

composer-install:
	docker compose exec php composer install

migrate-db:
	docker compose exec php ./yii migrate --interactive=0
	docker compose exec php ./yii migrate-queue/up --interactive=0

migrate-fresh-db:
	docker compose exec php ./yii migrate/fresh --interactive=0
	docker compose exec php ./yii migrate-queue/up --interactive=0

migrate-fresh-test-db:
	docker compose exec php ./tests/bin/yii migrate/fresh --interactive=0
	docker compose exec php ./tests/bin/yii migrate-queue/up --interactive=0

run-queue-listen:
	docker compose exec php ./yii queue/listen

api-tests:
	docker compose exec php ./vendor/bin/codecept run api
api-tests-debug:
	docker compose exec php ./vendor/bin/codecept run api --debug
functional-tests:
	docker compose exec php ./vendor/bin/codecept run functional
unit-tests:
	docker compose exec php ./vendor/bin/codecept run unit

tests: migrate-fresh-test-db api-tests functional-tests unit-tests
