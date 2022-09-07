## elcomedor

`elcomedor` es una API de prueba para un restaurante ficticio que necesita mostrar información de los ingredientes y alérgenos de sus platos.

## Origen de los datos

Para usar datos reales se ha optado por incluir los productos de los restaurantes ``100 Montaditos``

## Inserción de los datos de prueba.

Se puede rellenar los datos con el comando ``php artisan migrate:fresh --seed`` una vez que se haya configurado la conexión a la base de datos.

Hay algunos productos que no tienen ingredientes porque no coinciden los nombres. Se han dejado así a modo de ejemplo. El producto ``Pollo con alioli`` tendría dos ingredientes si se renombrara a ``Pollo asado con salsa alioli`` (porque coincidirían los ingredientes `Pollo asado` y `Salsa alioli`).
