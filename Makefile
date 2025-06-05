up:
	docker-compose up -d

prod-up:
	docker-compose -f docker-compose.prod.yml up -d

down:
	docker-compose down
