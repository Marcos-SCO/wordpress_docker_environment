# Stage 1: Node.js
FROM node:24-alpine AS node

# Stage 2: PHP 8.5 FPM Alpine
FROM php:8.5-fpm-alpine

WORKDIR /var/www/html/wp-content

# Install required PHP extensions for MySQL and PDO
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy Composer binary from the official Composer image
COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

# Install system dependencies for PHP and Node builds
RUN apk --no-cache add \
    g++ \
    make \
    zlib-dev \
    libpng-dev \
    curl \
    gnupg \
    ca-certificates \
    tar \
    xz \
    git

# Copy Node.js and npm from the node image
COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /usr/local/lib /usr/local/lib

# Optional: Expose port (if needed)
# EXPOSE 5173

# Default user is root
