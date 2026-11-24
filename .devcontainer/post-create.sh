#!/bin/bash
set -e

sed -i 's/ZSH_THEME="devcontainers"/ZSH_THEME="robbyrussell"/' "$HOME/.zshrc" || true

echo "📂 current dir: $(pwd)"

composer install --no-interaction --prefer-dist

if [[ ! -f .env ]]; then
    cp .env.example .env
    php artisan key:generate
fi

if [[ ! -f database/database.sqlite ]]; then
    mkdir -p database
    touch database/database.sqlite
fi

php artisan migrate --graceful --force

# node_modules is a Docker named volume, created with root as owner
sudo chown "$(id -u):$(id -g)" node_modules
pnpm install
