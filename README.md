# Requerimientos

    PHP v8.1
    Node v16.18.0
    Npm v8.19.2
    Docker Windows v4.14.1

# Pasos a seguir para levantar el proyecto

Utilizamos Laravel Sail para levantar el entorno de desarrollo (https://laravel.com/docs/9.x/sail)

    1. composer install
    2. cp .env.example .env
    3. ./vendor/bin/sail up -d
    4. ./vendor/bin/sail up
    5. ./vendor/bin/sail artisan migrate:fresh --seed
    6. npm install
    7. npm run dev
    8. ./vendor/bin/sail artisan route:clear
    9. ./vendor/bin/sail artisan config:cache
    10. Ingresar a http://localhost/
