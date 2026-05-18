#!/bin/bash
set -e

sed -i 's/ZSH_THEME="devcontainers"/ZSH_THEME="robbyrussell"/' "$HOME/.zshrc" || true

echo "📂 current dir: $(pwd)"

composer install --no-interaction --prefer-dist

if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

mkdir -p database
touch database/database.sqlite

php artisan migrate --graceful --force

export COREPACK_ENABLE_DOWNLOAD_PROMPT=0
corepack enable
corepack prepare pnpm@10.15.0 --activate
pnpm install --ignore-scripts
