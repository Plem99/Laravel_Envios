# EndPoints

## Registrar un Envio
### Método POST {{host}}/api/envio
#### Ejemplo
```sh
    {
        "cpOrigen": "27000",
        "cpDestino": "99000",
        "peso": 10,
        "largo": 120,
        "alto": 20,
        "ancho": 20,
        "id_usuario": 1,
        "id_mensajeria": 1
    }
```
## Consultar una orden de Rastreo
### Método GET {{host}}/api/rastreo/{codigo}
#### Ejemplo
```sh
    {{host}}/api/rastreo/2700099000Paqa112345
```

### Instalación
```sh
# Instala los recursos necesarios para iniciar un nuevo contenedor
$ composer require laravel/sail --dev

# Instala todas las dependencias
$ composer install

# Copiar el .env.example a .env
$ cp .env.example .env

# Generar key
$ php artisan key:generate

# Inicia el contenedor de docker
$ ./vendor/bin/sail up

# Detiene el contenedor de docker
$ ./vendor/bin/sail down

# Ejecuta las migraciones con sus respectivas seeds
$ php artisan migrate:refresh --seed

# Ejecuta las pruebas
$ php artisan test

# Ejecuta pruebas unitarias
$ ./vendor/bin/phpunit --filter <Nombre_de_Prueba>

```