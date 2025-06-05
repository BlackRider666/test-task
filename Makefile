install:
	cp api/.env.example api/.env
	cp .env.example .env
	docker-compose up -d
	docker exec api_todo composer install
	docker exec api_todo php artisan key:generate
install-new:
	cp api/.env.example api/.env
	cp .env.example .env
	docker compose up -d
	docker exec api_todo composer install
	docker exec api_todo php artisan key:generate
up:
	docker-compose up -d
up-new:
	docker-compose up -d
down:
	docker-compose down
