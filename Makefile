.DEFAULT_GOAL:= help
.PHONY: tests coverage view-coverage cs docs view-docs tag

tests: ## Executes the test suite
	vendor/bin/phpunit

tag: ## Creates a new signed git tag
	$(if $(TAG),,$(error TAG is not defined. Pass via "make tag TAG=2.0.1"))
	@echo Tagging $(TAG)
	chag update $(TAG)
	git add --all
	git commit -m 'Release $(TAG)'
	git tag -s $(TAG) -m 'Release $(TAG)'

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-16s\033[0m %s\n", $$1, $$2}'
