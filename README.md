# Sistema web de la Posta de Salud Comunitaria

Proyecto integrador de DSI406 · Tecnología Backend (Laravel + PostgreSQL).

## Requisitos
- PHP 8.3 o superior con pdo_pgsql
- Composer 2 y PostgreSQL

## Instalación
1. git clone https://github.com/vvenero251ds32-code/posta-salud.git
2. cd posta-salud
3. composer install
4. copy .env.example .env (y completar DB_PASSWORD)
5. php artisan key:generate
6. Crear la base de datos posta_salud en PostgreSQL
7. php artisan migrate
8. php artisan serve

## Datos de prueba
Comando: php artisan migrate:fresh --seed

| Usuario              | Rol             | Contraseña |
|----------------------|-----------------|------------|
| admin@posta.test     | administrador   | password   |
| medico@posta.test    | personal_medico | password   |
| recepcion@posta.test | recepcion       | password   |

Autor: Vanessa Emma Venero La Rosa