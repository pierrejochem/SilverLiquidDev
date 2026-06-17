## Silver Liquid Dev — WordPress theme dev environment
# Theme source lives in src/, live-mounted into a local WordPress container.

THEME      := silver-liquid-dev
SRC        := src
DIST       := dist
WP_PORT    ?= 8080
URL        := http://localhost:$(WP_PORT)
COMPOSE    := docker compose
# wp-cli helper: runs one-off wp commands in the cli container
WP         := $(COMPOSE) run --rm cli wp --path=/var/www/html

.DEFAULT_GOAL := help

.PHONY: help
help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| awk 'BEGIN{FS=":.*?## "}{printf "  \033[36m%-12s\033[0m %s\n", $$1, $$2}'

.PHONY: up
up: ## Start WordPress + DB (detached)
	$(COMPOSE) up -d wordpress
	@echo "WordPress starting at $(URL) — run 'make setup' on first boot."

.PHONY: setup
setup: ## Install WordPress + activate the theme (run once after first 'up')
	@echo "Waiting for WordPress to respond..."
	@until $(WP) core is-installed >/dev/null 2>&1 || \
		$(WP) core install \
			--url="$(URL)" \
			--title="Silver Liquid Dev (dev)" \
			--admin_user=admin \
			--admin_password=admin \
			--admin_email=dev@example.com \
			--skip-email >/dev/null 2>&1; do \
		echo "  ...not ready, retrying in 3s"; sleep 3; done
	$(WP) theme activate $(THEME)
	@echo "Done. Admin: $(URL)/wp-admin  (admin / admin)"

.PHONY: import
import: ## Import content (WXR xml) + media from data/ (media as attachments + featured images)
	$(WP) plugin install wordpress-importer --activate
	@for f in data/*.xml; do \
		echo "Importing $$f"; \
		$(WP) import "/data/$$(basename $$f)" --authors=create; \
	done
	@echo "Importing media from data/*.tar as attachments (+ featured images)"
	$(COMPOSE) run --rm cli sh -c 'set -e; \
		mkdir -p /tmp/m; \
		for t in /data/*.tar; do [ -e "$$t" ] || continue; tar xf "$$t" -C /tmp/m; done; \
		ids=$$(wp post list --path=/var/www/html --post_type=post --post_status=publish --field=ID); \
		set -- $$ids; \
		for f in $$(find /tmp/m -type f | sort); do \
			if [ -n "$$1" ]; then \
				wp media import "$$f" --path=/var/www/html --post_id="$$1" --featured_image --porcelain; shift; \
			else \
				wp media import "$$f" --path=/var/www/html --porcelain; \
			fi; \
		done; \
		rm -rf /tmp/m'
	$(WP) rewrite structure '/%postname%/' --hard
	@echo "Content imported. Browse $(URL)"

.PHONY: down
down: ## Stop containers (keep data)
	$(COMPOSE) down

.PHONY: restart
restart: down up ## Restart containers

.PHONY: logs
logs: ## Tail WordPress logs
	$(COMPOSE) logs -f wordpress

.PHONY: shell
shell: ## Open a shell in the WordPress container
	$(COMPOSE) exec wordpress bash

.PHONY: wp
wp: ## Run a wp-cli command, e.g. make wp CMD="plugin list"
	$(WP) $(CMD)

# Install PHPCS + WPCS into /tmp (not the repo), then run from the repo root so
# phpcs.xml.dist drives the ruleset — identical to the CI phpcs job.
PHPCS_SETUP = composer config --no-plugins allow-plugins.dealerdirect/phpcodesniffer-composer-installer true && \
	composer require --quiet --no-interaction squizlabs/php_codesniffer:^3.9 wp-coding-standards/wpcs:^3 dealerdirect/phpcodesniffer-composer-installer

.PHONY: lint
lint: ## Lint theme against WordPress coding standards (phpcs in a container)
	docker run --rm -v "$(CURDIR):/work" -w /tmp composer:2 sh -c '$(PHPCS_SETUP) && cd /work && /tmp/vendor/bin/phpcs'

.PHONY: phpcbf
phpcbf: ## Auto-fix coding-standard issues where possible
	docker run --rm -v "$(CURDIR):/work" -w /tmp composer:2 sh -c '$(PHPCS_SETUP) && cd /work && /tmp/vendor/bin/phpcbf'

.PHONY: zip
zip: ## Build distributable theme zip in dist/ (wrapped in a silver-liquid-dev/ folder)
	@mkdir -p $(DIST)
	@rm -f $(DIST)/$(THEME).zip
	@rm -rf $(DIST)/$(THEME)
	rsync -a --exclude '.DS_Store' --exclude '.git*' --exclude '__MACOSX*' \
		$(SRC)/ $(DIST)/$(THEME)/
	cd $(DIST) && zip -rq $(THEME).zip $(THEME)
	@rm -rf $(DIST)/$(THEME)
	@echo "Built $(DIST)/$(THEME).zip"

.PHONY: clean
clean: ## Stop containers and DELETE all data + dist
	$(COMPOSE) down -v
	rm -rf $(DIST)
