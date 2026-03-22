# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **test/demo project** for the [`jwderoos/configurable`](https://github.com/jwderoos/configurable) bundle — a Symfony 7.4 application that demonstrates how to build configurable services with dynamic configuration management.

## Common Commands

```bash
# Run all tests
./bin/phpunit

# Run a single test file
./bin/phpunit tests/Unit/Entity/ConfigurationPropertyTest.php

# Run a single test method
./bin/phpunit --filter testMethodName

# Static analysis
./vendor/bin/phpstan analyse

# Code style check / fix
./vendor/bin/phpcs
./vendor/bin/rector process

# Mutation testing
./vendor/bin/infection run

# Symfony console
./bin/console app:test
```

GrumPHP runs automatically on `git commit` and executes the full quality suite (phpcs, phpstan, phpunit, rector, infection, phpcpd, phpmnd, security checks).

## Architecture

### Core Concept

The `jwderoos/configurable` bundle provides traits and interfaces for building services that declare their own configuration requirements. This project implements them:

- **`Configuration`** entity — holds a collection of `ConfigurationProperty` objects; implements `ConfigurableServiceConfigurationInterface` using `ConfigurationPropertiesTrait`
- **`ConfigurationProperty`** entity — a single key/value property; implements `ConfigurableServiceConfigurationPropertyInterface`; maintains bidirectional ownership with `Configuration`
- **`ConfigurableService`** — an example service implementing `ConfigurableServiceInterface` via `ConfigurableServiceTrait`; declares config keys as class constants (`CONFIG_STRING_OPTION_1`, `CONFIG_OPTIONAL_OPTION_2`)

### Runtime Flow

1. `ConfigurableServiceRegistry` (from the bundle) discovers all tagged `ConfigurableServiceInterface` services via DI
2. Calling `registry->prepareConfiguration($configuration)` populates the `Configuration` entity with required `ConfigurationProperty` objects based on what the matched service declares
3. `TestCommand` (`app:test`) demonstrates this flow end-to-end

### Composition via Traits

The project avoids inheritance in favor of trait-based composition. All behavior (property collection management, service configuration handling) comes from traits provided by the external bundle — the local classes are thin implementations that wire the traits to Symfony's DI container.

## Quality Standards

- **PHPStan level 9** — enforced on `src/` and `tests/`
- **PSR-12** code style via PHP_CodeSniffer
- **100% mutation score** required (Infection) — every line must be covered by tests that actually catch mutations
- **PHP 8.3+** with Rector modernization (Symfony/Doctrine/PHPUnit presets)
- Commit messages must reference an issue number; branch names must follow `feature/N-description` / `hotfix/N-description` / etc.