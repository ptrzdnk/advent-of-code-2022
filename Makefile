SHELL = bash
PROJECT_NAME = advent-of-code-2022

run:
	mkdir log || true
	mkdir temp || true
	docker container stop $$(docker ps -q) || true
	docker-compose up -d
	docker exec --interactive --tty aoc composer install
