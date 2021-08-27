# Envíos

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

# EndPoints

## Registrar un Envío
### Método POST {{host}}/api/envio
#### Argumentos : ['cpOrigen','cpDestino','peso','largo','alto','ancho','id_usuario','id_mensajeria'];
#### Ejemplo:
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

#### Ejemplo:
```sh
    {{host}}/api/rastreo/2700099000Paqa112345
```