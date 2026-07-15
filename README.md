![Run Pest Tests](https://github.com/morgan-git/laravel-lab/actions/workflows/tests.yml/badge.svg)
# Laravel Lab

A collection of Laravel projects, experiments, and reusable components built to explore application architecture, integrations, and modern Laravel development practices.

Rather than isolated tutorial projects, this is a deliberately structured monorepo where each component ( service classes, queue jobs, caching layers, provider abstractions ) is built to be extracted and reused across multiple applications. The Feed Engine, for example, is designed to power both web interfaces and Discord bots from the same normalized data layer.

## Current Projects

### Feed Engine

A content ingestion system that retrieves, caches, normalizes, and stores external content from multiple providers. The long-term goal is to support multiple data sources through a common provider interface and expose that content to web applications, Discord bots, and other consumers.

Current work includes:

* RSS ingestion
* Redis caching
* Background jobs
* Service layer architecture
* Provider abstraction
* Database persistence
* Automated testing with Pest

### Planned Projects

* Discord bots
* Last.fm utilities and import tools
* API integrations
* Automation utilities
* Backend services
* Other standalone Laravel applications as they evolve

## Technologies

* Laravel
* PHP 8
* Pest
* Redis
* MySQL
* Guzzle
* Queue Jobs
* DaisyUI
* Git & GitHub

## Goals

This repository is intended to showcase practical backend development rather than tutorial exercises.

Areas of focus include:

* Clean architecture
* Service-oriented design
* External API integration
* Background processing
* Caching strategies
* Automated testing
* Reusable application components

The repository will continue to evolve as new projects are added and existing applications mature.



