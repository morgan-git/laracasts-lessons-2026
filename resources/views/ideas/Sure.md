Sure. I'd keep it simple and not overengineer it yet.

1. Add Composer Scripts

In composer.json:

"scripts": {
    "format": [
        "./vendor/bin/pint",
        "./vendor/bin/rector"
    ],

    "format-check": [
        "./vendor/bin/pint --test",
        "./vendor/bin/rector process --dry-run"
    ],

    "test": [
        "@php artisan test"
    ],

    "quality": [
        "@format",
        "@test"
    ],

    "quality-check": [
        "@format-check",
        "@test"
    ]
}

Now you can run:

composer format
composer test
composer quality

and

composer quality-check
2. Create a Pre-Commit Hook

Create:

.githooks/pre-commit

Contents:

#!/bin/sh

echo "Running Pint..."
./vendor/bin/pint

echo "Running Rector..."
./vendor/bin/rector

echo "Running Tests..."
php artisan test

if [ $? -ne 0 ]; then
    echo "Tests failed."
    exit 1
fi

git add .

Make executable:

chmod +x .githooks/pre-commit
3. Tell Git To Use Project Hooks

Run once:

git config core.hooksPath .githooks

Now every commit runs:

Pint
↓
Rector
↓
Tests
↓
git add updated files
↓
commit
4. Add GitHub Action Validation

In:

.github/workflows/quality.yml

Something like:

name: Quality

on:
  pull_request:
  push:

jobs:
  quality:
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v4

      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.4'

      - run: composer install

      - run: ./vendor/bin/pint --test

      - run: ./vendor/bin/rector process --dry-run

      - run: php artisan test

This ensures:

Local machine forgot format
↓
PR fails

Local machine forgot tests
↓
PR fails
5. Sharing Hooks With Team

This is the part that surprises most people.

Git does not automatically share hooks.

If you commit:

.githooks/pre-commit

everyone gets the file.

But they STILL must run:

git config core.hooksPath .githooks

once.

Bonus: Automate Hook Installation

Add script:

"scripts": {
    "post-install-cmd": [
        "git config core.hooksPath .githooks || true"
    ]
}

Or put instructions in README:

composer install
git config core.hooksPath .githooks

Honestly most teams do exactly that.

What I'd Actually Do For ATS

Right now:

✅ Composer scripts

✅ GitHub Action

✅ Pre-commit hook

Skip anything more complicated.
