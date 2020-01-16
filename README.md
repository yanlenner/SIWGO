# SIWGO

### El presente proyecto consiste en implementar un sistema de información web en el Servicio Odontológico Kléber Ramírez que permita llevar el control de los pacientes, para dar respuesta a los problemas en el retardo de la prestación del servicio administrativo; debido a que el registro de atención de los estudiantes se realiza manualmente, ocasionando pérdida de información y poca capacidad para elaborar estadísticas del servicio prestado. Se utilizó la metodología del Marco Lógico para el desarrollo del proyecto y la metodología de Procesos Unificados Esenciales como desarrollo del software. La población consistió en un total de tres personas que laboran en el servicio odontológico. La implementación del sistema de información generó un cambio en la comunidad debido a la sistematización de los registros del servicio odontológico prestado a los estudiantes, lo cual permite garantizar la protección de los datos, el procesamiento automático de estadísticas del servicio, optimizando la capacidad de respuesta de tipo administrativo en la unidad odontológica.

---

#### Configuración del Servidor Apache:

* Debes usar o modificar el virtual host odontologia.uptm que apunta hacia la dirección 127.0.0.1.
* Debes configurar el servidor web para que utilice direcciones url amigables.


#### Instalación de la Base de Datos en el Sistema Gestor de Base de Datos MariaDB:

* Debes revisar el archivo db.sql ubicado en la ruta src/maria, el cual contiene la estructura de la base de datos. Puedes crear el usuario que gestionará dicha base de datos, por lo que se sugiere establecer las credenciales de acceso desde la linea 27 hasta la linea 31.

```sql
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT USAGE ON *.* TO 'usuario'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `odontologia`.* TO 'usuario'@'localhost';
GRANT ALL PRIVILEGES ON `test`.* TO 'usuario'@'localhost';
```


#### Conexión hacia la Base de Datos:

* Debes modificar los parámetros de acceso que se encuentran en los archivos conexion.php, enlace.php, fin_esregular.php, put_name.php, put_apel.php, put_carr.php y put_carn.php de la ruta src/php.


#### Demostración:

http://lenner.byethost15.com

---

Este trabajo se encuentra bajo la [![Licencia: CC BY-NC-SA 4.0](https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg)](https://creativecommons.org/licenses/by-nc-sa/4.0/).