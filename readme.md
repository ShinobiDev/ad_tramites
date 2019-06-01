<p align="center"><img src="http://tutramitador.com/core/img/logolarge.png"></p>



## Acerca de Tu Tramitador

Este sistema tiene como fin publicar anuncios de trátamites de transito, esta desarrollado bajo la version de [laravel 5.5](https://laravel.com/docs/5.5). 

## Recomendaciones para instalación en servidor local

Una vez clonado el sistema se recomienda 
## Paso 1 dar permisos a las carpetas de storage y storage/logs (linux)

	sudo chmod 777 -R storage

	cd storage 

	sudo chmod 777 -R logs

## Paso 2 limpiar el cache de la aplicación, debe hacerlo desde la raiz

	php artisan cache:clear

## Paso 3
   NO ejecute la migración, el script de la base de datos (db_tramitador_para_pruebas.sql)  se encuentra en la carpeta base_de_datos, los usuarios allí registrados tiene como defecto la clave '123456', para, si usted desea replicar el ambiente de producción, debe importar la base de datos (db_tramitador_para_producccion.sql), en este caso las contraseñas debe ser recuperadas.

## Paso 4 
   Cambie los valores de el archivo .env que usted requiera.






