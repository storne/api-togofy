# API Togofy 

Este projecto esta construido con Laravel 8 y Mysql 5.6

## Starting server

Si se desea instalar este sistema se tiene los siguientes requisitos:
- PHP 7.2 o mayor
- Mysql 5.6 o mayor
- Composer
- Git
- Nodejs

Pasos para instalar y ejecutar la aplicacion:

1. Clona el repositorio
`git clone https://github.com/storne/api-togofy.git`

2. Instala los paquetes y dependencias con
`composer install`

3. Crea la base de datos con el nombre `togofy`

4. Crear las tablas
`php artisan migrate`

5. Copia y pega .env.example a .env y configura los accesos a la base de datos
``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=togofy
DB_USERNAME=root
DB_PASSWORD=
``` 

6. Inicia la aplicación con 
`php artisan serve`

7. El api corre en la ruta `http://localhost:8000/api`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
