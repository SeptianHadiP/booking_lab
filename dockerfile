# Stage 1: Build assets
FROM node:20-alpine AS nodebuilder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . ./
RUN npm run build


# Stage 2: Application with PHP
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    zip \
    unzip \
    curl \
    git \
    libpng \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    icu-dev \
    libzip-dev \
    zlib-dev \
    mysql-client \
    shadow \
    npm \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        tokenizer \
        xml \
        intl \
        zip \
        gd

# Set working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy app code
COPY . .

# Copy built frontend assets from node stage
COPY --from=nodebuilder /app/public/build ./public/build

# Set permissions for Laravel
RUN adduser -D appuser && \
    chown -R appuser:appuser /var/www && \
    chmod +x ./build.sh

# Switch to non-root user
USER appuser

# Run build steps
RUN ./build.sh

# Expose port (if needed for php-fpm, nginx will use it)
EXPOSE 9000

CMD ["php-fpm"]
