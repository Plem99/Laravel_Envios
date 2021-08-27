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