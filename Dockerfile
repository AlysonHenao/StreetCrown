FROM webdevops/php-apache:8.2

WORKDIR /app

ENV WEB_DOCUMENT_ROOT=/app/public

COPY . .

RUN mkdir -p database storage bootstrap/cache \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 80

CMD ["supervisord"]
