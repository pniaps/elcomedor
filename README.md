[![Laravel](https://github.com/pniaps/elcomedor/actions/workflows/laravel.yml/badge.svg)](https://github.com/pniaps/elcomedor/actions/workflows/laravel.yml)

# elcomedor

`elcomedor` es una API de prueba para un restaurante ficticio que necesita mostrar información de los ingredientes y alérgenos de sus platos.

## Introducción

Se ha escogido Laravel porque permite realizar aplicaciones robustas de manera rápida y tiene una gran comunidad debido a la cantidad de funcionalidades y paquetes existentes. 

No se ha implementado gestión de usuarios y la API está configurada con un límite de 60 peticiones por minuto.

## Origen de los datos

Para usar datos reales se ha optado por incluir los productos de los restaurantes ``100 Montaditos``

## Datos de prueba.

Se puede rellenar los datos con el comando ``php artisan migrate:fresh --seed`` una vez que se haya configurado la conexión a la base de datos.

Hay algunos productos que no tienen ingredientes porque no coinciden los nombres. Se han dejado así a modo de ejemplo. El producto ``Pollo con alioli`` tendría dos ingredientes si se renombrara a ``Pollo asado con salsa alioli`` (porque coincidirían los ingredientes `Pollo asado` y `Salsa alioli`).

## Puesta en marcha

Ejecutar los siguientes comandos (linux, windows necesita pequeños cambios) para clonar el repositorio y configurar la base de datos.

````shell
# Clonar repositorio
git clone https://github.com/pniaps/elcomedor.git
cd elcomedor
composer install --optimize-autoloader

# copiar archivo .env
php -r "file_exists('.env') || copy('.env.example', '.env');"

# Generate key
php artisan key:generate

# Crear base de datos
touch database/database.sqlite
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env | grep DB
sed -i '/DB_DATABASE/d' .env

# Crear datos de prueba
php artisan migrate:fresh --seed

# Arrancar servidor web
php artisan serve
````

Una vez ejecutado todos los pasos anteriores, se podrá ver la api en las siguientes URLs

- http://127.0.0.1:8000/api/v1/alergenos
- http://127.0.0.1:8000/api/v1/ingredientes
- http://127.0.0.1:8000/api/v1/platos

# Tests

Los tests se pueden ejecutar con el comando ``vendor/bin/phpunit``.
