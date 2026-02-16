# Makefile for WpElementor project
# Usage: make <command>

# Vars
PROJECT_NAME = codevelopers
THEME_NAME = ${PROJECT_NAME}
DB_NAME = ${PROJECT_NAME}
DOCKER_WEB = ${PROJECT_NAME}_web
DOCKER_DB = ${PROJECT_NAME}_db
PROJECT_PATH = /var/www/html
THEME_PATH = ${PROJECT_PATH}/public/content/themes/${THEME_NAME}

# Colors for output
GREEN = \033[0;32m
YELLOW = \033[0;33m
RED = \033[0;31m
NC = \033[0m # No Color

.PHONY: help up down build restart logs shell db-shell yarn-watch yarn-build yarn-install composer-install db-import db-export wp-cli theme-watch

# Default help command
help: ## Show help
	@echo "$(GREEN)Available commands:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "$(YELLOW)%-20s$(NC) %s\n", $$1, $$2}'

# Docker basics
up: ## Start services
	@echo "$(GREEN)Starting services...$(NC)"
	docker-compose up -d

down: ## Stop services
	@echo "$(RED)Stopping services...$(NC)"
	docker-compose down

build: ## Build images
	@echo "$(GREEN)Building images...$(NC)"
	docker-compose build

restart: ## Restart services
	@echo "$(YELLOW)Restarting services...$(NC)"
	docker-compose restart

logs: ## View logs for all services
	docker-compose logs -f

logs-web: ## View logs for web service
	docker-compose logs -f web

logs-db: ## View logs for db service
	docker-compose logs -f db

# Shells
shell: ## Access web container shell
	@echo "$(GREEN)Accessing web container shell...$(NC)"
	docker exec -it $(DOCKER_WEB) /bin/bash

db-shell: ## Access MySQL shell
	@echo "$(GREEN)Accessing MySQL shell...$(NC)"
	docker exec -it $(DOCKER_DB) mysql -uroot -proot_password $(DB_NAME)

# Yarn/NPM
yarn-watch: ## Run yarn watch for development
	@echo "$(GREEN)Running yarn watch...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(THEME_PATH) && yarn watch"

yarn-build: ## Run yarn build for production
	@echo "$(GREEN)Running yarn build...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(THEME_PATH) && yarn production"

yarn-install: ## Install yarn dependencies
	@echo "$(GREEN)Installing yarn dependencies...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(THEME_PATH) && yarn install"

yarn-dev: ## Run yarn dev
	@echo "$(GREEN)Running yarn dev...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(THEME_PATH) && yarn dev"

# Composer
composer-install: ## Install composer dependencies
	@echo "$(GREEN)Installing composer dependencies...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && composer install"

composer-update: ## Update composer dependencies
	@echo "$(GREEN)Updating composer dependencies...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && composer update"

composer-require: ## Require composer package (usage: make composer-require PACKAGE=name OR make composer-require package-name)
	$(eval ARGS := $(filter-out $@,$(MAKECMDGOALS)))
	$(eval PKG := $(if $(PACKAGE),$(PACKAGE),$(firstword $(ARGS))))
	@if [ -z "$(PKG)" ]; then \
		echo "$(RED)Error: Specify package with PACKAGE=name or as argument$(NC)"; \
		echo "$(YELLOW)Usage: make composer-require PACKAGE=package-name$(NC)"; \
		echo "$(YELLOW)   OR: make composer-require package-name$(NC)"; \
		exit 1; \
	fi
	@echo "$(GREEN)Installing composer package $(PKG)...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && composer require $(PKG)"

composer-require-plugin: ## Install WordPress plugin (usage: make composer-require-plugin PLUGIN=name OR make composer-require-plugin plugin-name)
	$(eval ARGS := $(filter-out $@,$(MAKECMDGOALS)))
	$(eval PLG := $(if $(PLUGIN),$(PLUGIN),$(firstword $(ARGS))))
	@if [ -z "$(PLG)" ]; then \
		echo "$(RED)Error: Specify plugin with PLUGIN=name or as argument$(NC)"; \
		echo "$(YELLOW)Usage: make composer-require-plugin PLUGIN=plugin-name$(NC)"; \
		echo "$(YELLOW)   OR: make composer-require-plugin plugin-name$(NC)"; \
		exit 1; \
	fi
	@echo "$(GREEN)Installing WordPress plugin $(PLG)...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && composer require wpackagist-plugin/$(PLG)"

composer-remove: ## Remove composer package (usage: make composer-remove PACKAGE=name OR make composer-remove package-name)
	$(eval ARGS := $(filter-out $@,$(MAKECMDGOALS)))
	$(eval PKG := $(if $(PACKAGE),$(PACKAGE),$(firstword $(ARGS))))
	@if [ -z "$(PKG)" ]; then \
		echo "$(RED)Error: Specify package with PACKAGE=name or as argument$(NC)"; \
		echo "$(YELLOW)Usage: make composer-remove PACKAGE=package-name$(NC)"; \
		echo "$(YELLOW)   OR: make composer-remove package-name$(NC)"; \
		exit 1; \
	fi
	@echo "$(RED)Removing composer package $(PKG)...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && composer remove $(PKG)"

# Database commands
db-import: ## Import database (requires file in database/)
	@echo "$(GREEN)Importing database...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli database:import"

db-export: ## Export database
	@echo "$(GREEN)Exporting database...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli database:export"

db-create: ## Create database
	@echo "$(GREEN)Creating database...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli database:create"

# WordPress CLI
wp-cli: ## Access WordPress CLI
	@echo "$(GREEN)Accessing WordPress CLI...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH)/public && wp --allow-root"

wp-plugins: ## List installed plugins
	@echo "$(GREEN)Listing plugins...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH)/public && wp plugin list --allow-root"

wp-themes: ## List installed themes
	@echo "$(GREEN)Listing themes...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH)/public && wp theme list --allow-root"

# Plugins and themes commands
plugin-install: ## Install plugin (usage: make plugin-install PLUGIN=plugin-name)
	@echo "$(GREEN)Installing plugin $(PLUGIN)...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli plugin:install $(PLUGIN)"

plugin-uninstall: ## Uninstall plugin (usage: make plugin-uninstall PLUGIN=plugin-name)
	@echo "$(RED)Uninstalling plugin $(PLUGIN)...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli plugin:uninstall $(PLUGIN)"

theme-update: ## Update theme
	@echo "$(GREEN)Updating theme...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli theme:update"

# Development
dev: ## Start services and run yarn watch
	@echo "$(GREEN)Starting development environment...$(NC)"
	make up
	make yarn-watch

# Cleaning
clean: ## Clean up unused containers and images
	@echo "$(YELLOW)Cleaning up containers and images...$(NC)"
	docker system prune -f

clean-all: ## Clean up everything (including volumes)
	@echo "$(RED)Cleaning up everything...$(NC)"
	docker system prune -a --volumes -f

# Permissions
fix-permissions: ## Fix file permissions
	@echo "$(GREEN)Fixing permissions...$(NC)"
	docker exec -it $(DOCKER_WEB) bash -c "chown -R www-data:www-data $(PROJECT_PATH)"

# Status
status: ## Check container status
	@echo "$(GREEN)Checking container status...$(NC)"
	docker-compose ps

# Prevent make from treating arguments as targets
%:
	@:

rename-project: ## Rename project (usage: make rename-project NEWNAME=yourproject)
	@if [ -z "$(NEWNAME)" ]; then \
		echo "$(RED)Error: Specify new project name with NEWNAME=yourproject$(NC)"; \
		echo "$(YELLOW)Usage: make rename-project NEWNAME=yourproject$(NC)"; \
		exit 1; \
	fi
	@echo "$(GREEN)Renaming project to $(NEWNAME)...$(NC)"
	# Update theme using ThemeUpdate command
	docker exec -it $(DOCKER_WEB) bash -c "cd $(PROJECT_PATH) && php cli theme:update"
	# Update PROJECT_NAME in Makefile
	@sed -i "s/^PROJECT_NAME = .*/PROJECT_NAME = $(NEWNAME)/" $(MAKEFILE_LIST)
	# Update docker-compose.yml values
	@sed -i -E "s/container_name: [^ ]+(_web)/container_name: $(NEWNAME)_web/" docker-compose.yml
	@sed -i -E "s/container_name: [^ ]+(_db)/container_name: $(NEWNAME)_db/" docker-compose.yml
	@sed -i -E "s/container_name: [^ ]+(_mailpit)/container_name: $(NEWNAME)_mailpit/" docker-compose.yml
	@sed -i "s/THEME_NAME=[^ ]*/THEME_NAME=$(NEWNAME)/" docker-compose.yml
	@sed -i "s/MYSQL_DATABASE: [^ ]*/MYSQL_DATABASE: $(NEWNAME)/" docker-compose.yml
	@sed -i "s|!/public/content/themes/wpelementor|!/public/content/themes/$(NEWNAME)|g" web/wpelementor/.gitignore
	@echo "$(GREEN)Project renamed successfully. Please review theme metadata and rebuild containers.$(NC)"