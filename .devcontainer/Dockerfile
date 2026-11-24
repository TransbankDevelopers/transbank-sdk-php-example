FROM mcr.microsoft.com/devcontainers/php:3-8.2-trixie

USER root

ENV DEBIAN_FRONTEND=noninteractive
ENV TERM=xterm
ENV SHELL=/bin/zsh

RUN rm -f /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        sqlite3 \
        libsqlite3-dev \
        libzip-dev \
        unzip \
        ripgrep \
    && docker-php-ext-install pdo_sqlite zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

USER vscode
