.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: attach
ifeq (attach,$(firstword $(MAKECMDGOALS)))
  RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(RUN_ARGS):;@:)
endif
attach: ## Attach to container : ## make attach app
	docker-compose exec $(RUN_ARGS) sh -c "[ -f /bin/bash ] && /bin/bash || /bin/sh"

.PHONY: db-fresh
db-fresh: ## make attach app
	docker-compose exec app php artisan migrate:fresh --seed

.PHONY: test
test:
	./vendor/bin/phpunit

.PHONY: dusk
dusk:
	php artisan dusk --env=testing

.PHONY: analyse
analyse:
	./vendor/bin/phpstan analyse

.PHONY: format
format:
	./vendor/bin/phpcbf --standard=phpcs.xml ./