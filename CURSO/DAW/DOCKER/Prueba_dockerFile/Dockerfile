#Usamos una imagen base que ya tiene Apache y PHP instalados
FROM php:8.1-apache

#Copiamos ela rchivo.index.php a la carpeta donde Apache buscar archivos
COPY index.php /var/www/html

#Exponemos el puerto 80 para que el servidor web sea accesible
EXPOSE 80  