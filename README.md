# appsalon
Aplicación Web de barbería para el manejo y administración de servicios y citas. Los clientes pueden seleccionar los servicios disponibles y seleccionar una fecha y hora, luego podrán ver un resumen con el total a pagar y reservar una cita. Los administradores del sitio pueden administrar los servicios y ver las citas reservadas.

### Clientes
- Registro
- Inicio de sesión
- Confirmación de email
- Recuperar contraseña
- Seleccionar servicios, fecha y hora y reservarlas

### Administrador
- Ver citas reservadas en determinada fecha
- Crear, actualizar y/o borrar servicios de manera asíncrona

## Requisitos
- PHP
- MySQL
- Node.js
- Composer

## Instalación
1. Correr los scripts del archivo "database.sql" para crear la base de datos y sus tablas. También hay un script para crear servicios de ejemplos.
2. Tener una cuenta en MailTrap para el manejo y testing de emails. Las credenciales del mismo se deben editar en el archivo "/classes/Email.php"
2. En la terminal, escribir "php start", esto iniciará automáticamente el servidor PHP (localhost:3000). El comando shell se puede editar en el archivo "/start"
