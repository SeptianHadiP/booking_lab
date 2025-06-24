# Stage 1: Build frontend assets with Node.js
FROM node:20-alpine AS nodebuilder

WORKDIR /app

# Install frontend deps & build Vite assets
COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# Stage 2: Laravel + PHP 8.2 with built assets
FROM php:8.2-cli-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    mysql-client \
    zlib-dev \
    libxml2-dev

# PHP Extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    tokenizer \
    xml \
    intl \
    zip \
    gd

# Set working directory
WORKDIR /app

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Copy Vite build result
COPY --from=nodebuilder /app/public/build ./public/build

# Install PHP deps
RUN composer install --optimize-autoloader --no-dev

# Set permissions (optional)
RUN chmod +x ./build.sh

# Run Laravel build steps (optimize/cache)
RUN ./build.sh

# Expose port for Railway
EXPOSE 9000

# Use port from Railway
ENV PORT=9000

# Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
