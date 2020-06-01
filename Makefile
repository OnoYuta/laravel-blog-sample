.PHONY: up
up: ## Start container
	docker-compose up -d

.PHONY: up-build
up-build: ## Build and start container
	docker-compose up -d --build

.PHONY: down
down: ## Stop container
	docker-compose down

.PHONY: down-all
down-all: ## Stop container and delete image and volume
	docker-compose down --volumes --rmi all

.PHONY: attach
ifeq (attach,$(firstword $(MAKECMDGOALS)))
  RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(RUN_ARGS):;@:)
endif
attach: ## Attach to container : ## make attach app
	docker-compose exec $(RUN_ARGS) sh -c "[ -f /bin/bash ] && /bin/bash || /bin/sh"

.PHONY: db-fresh
db-fresh: ## Database migrate and seed
	docker-compose exec app php artisan migrate:fresh --seed

.PHONY: tinker
tinker: ## Start tinker which is laravel's REPL
	docker-compose exec app php artisan tinker

.PHONY: test
test: ## Execute unit-test with phpunit
	./vendor/bin/phpunit

.PHONY: dusk
ifeq (dusk,$(firstword $(MAKECMDGOALS)))
  RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(RUN_ARGS):;@:)
endif
dusk: ## Execute E2E-test with dusk
	php artisan dusk --env=testing $(RUN_ARGS)
	@make db-fresh

.PHONY: ci
ci: ## Execute CircleCI in local environment
	circleci local execute

.PHONY: analyse
analyse: ## Static analysis with phpstan
	./vendor/bin/phpstan analyse --memory-limit=4000M

.PHONY: format
format: ## Auto-format source code
	./vendor/bin/phpcbf --standard=phpcs.xml ./
	./vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --using-cache=no

.PHONY: commit
commit: ## Commit after fixing source code
	./vendor/bin/phpcbf --standard=phpcs.xml ./
	./vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --using-cache=no
	./vendor/bin/phpstan analyse --memory-limit=4000M
	git add .
	git commit

.PHONY: help
help: ## Display the list of make commands
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'