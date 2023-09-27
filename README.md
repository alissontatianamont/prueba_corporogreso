##Prueba corprogreso

Este es un proyecto desarrollado con Laravel 10, creado y mantenido por Alisson Montañez y Geordy Montenegro.
Requisitos

    PHP >= 8.0
    Laravel 10.x
    Biblioteca Laravel Excel

##Instalación

    Clonar el repositorio:


git clone [URL-del-repositorio]

##Cambiar al directorio del proyecto:


cd [nombre-del-repositorio]

##Instalar las dependencias con Composer:


composer install

##Instalar Laravel Excel:

Laravel Excel es una biblioteca que facilita la lectura y escritura de archivos Excel. Para instalarla, ejecuta:


composer require maatwebsite/excel

##Configurar el archivo .env:

Asegúrate de configurar tu archivo .env con los detalles de tu base de datos y cualquier otra configuración específica que necesites.

##Ejecutar migraciones:


    php artisan migrate

##Uso

La interfaz es intuitiva y se centra en la gestión de usuarios mediante archivos Excel:

   - Obtener la plantilla:

    Si necesitas saber el formato correcto del archivo Excel para cargar usuarios, simplemente haz clic en el botón "Obtener plantilla". Esto descargará un archivo Excel con la estructura adecuada.

   -Subir un archivo Excel:

    Una vez tengas tu archivo Excel preparado con la estructura adecuada, puedes subirlo usando el formulario proporcionado. Asegúrate de seguir el formato proporcionado en la plantilla.

   -Validación y resultados:

    Al subir el archivo, el sistema validará su contenido. Si todo está correcto, añadirá la lista de usuarios a la base de datos e imprimirá en pantalla los usuarios añadidos.

    En caso de errores, como registros con emails repetidos o problemas con las reglas definidas para el usuario y la contraseña, el sistema mostrará un listado o alertas con las incidencias encontradas para que puedas corregirlas.

##Agradecimientos

Se resalta y agradece el trabajo en equipo de Alisson Montañez y Geordy Montenegro, por su colaboración  en este proyecto. La cual   ha sido esencial para llevar este proyecto a buen término.