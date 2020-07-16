up:
	docker-compose up -d

docker-up: up memory

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

bash:
	docker-compose exec php-cli bash

test:
	docker-compose exec php-cli vendor/bin/phpunit

assets-install:
	docker-compose exec node yarn install

assets-rebuild:
	docker-compose exec node npm rebuild node-sass --force

assets-dev:
	docker-compose exec node yarn run dev

assets-watch:
	docker-compose exec node yarn run watch

queue:
	docker-compose exec php-cli php artisan queue:work

horizon:
	docker-compose exec php-cli php artisan horizon

horizon-pause:
	docker-compose exec php-cli php artisan horizon:pause

horizon-continue:
	docker-compose exec php-cli php artisan horizon:continue

horizon-terminate:
	docker-compose exec php-cli php artisan horizon:terminate

memory:
	sudo sysctl -w vm.max_map_count=262144

clear:
	docker-compose exec -T php-cli chown 1000:1000 /var/www/bootstrap/cache/ -R
	docker-compose exec -T php-cli chmod 777 /var/www/bootstrap/cache -R
	docker-compose exec -T php-cli rm -rf /var/www/bootstrap/cache/* -R
	docker-compose exec -T php-cli chown 1000:1000 /var/www/storage/ -R
	docker-compose exec -T php-cli chmod 777 /var/www/storage/ -R
	docker-compose exec -T php-cli php artisan config:cache
	docker-compose exec -T php-cli php artisan route:cache
	docker-compose exec -T php-cli php artisan view:cache
	docker-compose exec -T php-cli php artisan cache:clear

perm:
	sudo chown ${USER}:${USER} ./bootstrap/cache -R
	sudo chown ${USER}:${USER} ./storage -R
	if [ -d "node_modules" ]; then sudo chown ${USER}:${USER} node_modules -R; fi
	if [ -d "public/build" ]; then sudo chown ${USER}:${USER} public/build -R; fi
