start:restart up migrate_analytic broker
up:
	docker-compose up -d
	docker-compose exec php-fpm composer install
	docker-compose exec php-fpm php artisan migrate --step
restart:
	docker-compose down
	docker-compose up -d
check:
	docker-compose exec php-fpm vendor/bin/rector process
	docker-compose exec php-fpm vendor/bin/phpstan analyse --memory-limit=2G --debug
migrate:
	docker-compose exec php-fpm php artisan migrate --step
composer:
	docker-compose exec php-fpm composer update
rollback:
	docker-compose exec php-fpm php artisan migrate:rollback
logs:
	docker-compose logs -f
stop:
	docker-compose stop
rebuild:
	docker-compose down -v
	docker-compose build
	make up
refresh:
	docker-compose down
	docker-compose build --no-cache
	make up
clear:
	docker-compose exec php-fpm composer dumpautoload
	docker-compose exec php-fpm php artisan route:clear
	docker-compose exec php-fpm php artisan config:clear
	docker-compose exec php-fpm php artisan cache:clear
	docker-compose exec php-fpm php artisan view:clear
	docker-compose exec php-fpm php artisan config:cache
seed:
	docker-compose exec php-fpm php artisan db:seed
build:
	docker-compose -f docker-compose.build.yml build
push:
	docker-compose -f docker-compose.build.yml push
build_and_push: build push

broker:
	docker-compose exec php-fpm php artisan broker:consume

migrate_analytic:
	docker-compose exec php-fpm php artisan migrate:analytic
