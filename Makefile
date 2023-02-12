# Executables (local)
DOCKER_COMP = docker compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP_CONT) bin/console
PHPSTAN  = $(PHP_CONT) vendor/bin/phpstan
PHPCS  	 = $(PHP_CONT) vendor/bin/phpcs
PHPUNIT  = $(PHP_CONT) bin/phpunit

# Paths
PATH_ROOT    = .
PATH_SRC     ?= $(PATH_ROOT)
PATH_BUILD   ?= $(PATH_ROOT)/build


# Other
PROC_NUM          ?= 4
PHP_MEMORY_LIMIT  ?= 2G
PHPSTAN_LEVEL     ?= 8
PATH_POSTFIX      ?= Default


# Misc
.DEFAULT_GOAL = help
.PHONY        : help build up start down logs sh composer vendor sf cc

## —— 🎵 🐳 The Symfony Docker Makefile 🐳 🎵 ——————————————————————————————————
help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Docker 🐳 ————————————————————————————————————————————————————————————————
build: ## Builds the Docker images
	@$(DOCKER_COMP) build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	@$(DOCKER_COMP) up --detach

start: build up ## Build and start the containers

down: ## Stop the docker hub
	@$(DOCKER_COMP) down --remove-orphans

logs: ## Show live logs
	@$(DOCKER_COMP) logs --tail=0 --follow

sh: ## Connect to the PHP FPM container
	@$(PHP_CONT) sh

## —— Composer 🧙 ——————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

vendor: ## Install vendors according to the current composer.lock file
vendor: c=install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction
vendor: composer

## —— Symfony 🎵 ———————————————————————————————————————————————————————————————
sf: ## List all Symfony commands or pass the parameter "c=" to run a given command, example: make sf c=about
	@$(eval c ?=)
	@$(SYMFONY) $(c)

cc: c=c:c ## Clear the cache
cc: sf


## —— Tests ———————————————————————————————————————————————————————————————

test-all:## all tests
	$(call title,"All tests")
	@make test-phpcs
	@make test-phpstan
	@make test-phpunit


test-phpunit:  ## phpunit test
	$(call title,"PHPUnit tests")
	@$(PHPUNIT)


test-phpstan: ## phpstan -static analyse tool
	$(call title,"PHPStan - Static Analysis Tool")
	@echo "Level   : $(PHPSTAN_LEVEL)"
	@echo "Src Path: $(PATH_SRC)"
	@echo "Config Path: $(PATH_SRC)/phpstan.neon"
	@$(PHPSTAN)  analyse \
			--configuration="$(PATH_ROOT)/phpstan.neon"   \
	    --error-format=table                          \
   	  --memory-limit=$(PHP_MEMORY_LIMIT)            \
  		--level=$(PHPSTAN_LEVEL)                      \
	   	--no-ansi                                     \
			 "$(PATH_SRC)"

	
test-phpcs: ##@Testing Check codebase via PHP CodeSniffer
	$(call title,"Testing by PHP_CodeSniffer by path: $(FIX_PATH)")
	@$(PHPCS) --version
	@$(PHPCS) "$(PATH_SRC)"       \
        --standard="$(PATH_ROOT)/.phpcs.xml"                           \
        --report=full                                                  \
        --parallel=$(PROC_NUM)                                         \
        -p -s

test-composer: ##@Testing Validate "composer.json" and "composer.lock".
	$(call tcStart,"test-composer: Composer - Basic Diagnose")
	$(call title,"Composer - Looking for common issues")
	@-$(COMPOSER) diagnose           --no-interaction
	$(call title,"Composer - Validate system requirements")
	@$(COMPOSER) validate            --no-interaction --strict --no-check-all
	@$(COMPOSER) check-platform-reqs --no-interaction
	$(call title,"Composer - List of outdated packages")
	@$(COMPOSER) outdated            --no-interaction --direct
	$(call tcFinish,"test-composer: Composer - Basic Diagnose")

