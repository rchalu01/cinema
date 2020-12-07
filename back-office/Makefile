EXEC_PHP    = php
SYMFONY     = $(EXEC_PHP) bin/console
COMPOSER    = $(EXEC_PHP) /usr/local/bin/composer
.DEFAULT_GOAL := help


help: ## Affiche cette page d'aide
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
compinstall: composer.lock ## Installe les dépendances php
	$(COMPOSER) install
load-fixtures: ## Crée la BD, charge les fixtures
	$(SYMFONY) doctrine:database:drop --force
	$(SYMFONY) doctrine:database:create
	$(SYMFONY) doctrine:schema:update --force
	$(SYMFONY) doctrine:fixtures:load -n
test: phpunit.xml.dist ## Lance les test
	bin/phpunit --stop-on-failure
install: compinstall load-fixtures ## Crée un environnement "propre"
