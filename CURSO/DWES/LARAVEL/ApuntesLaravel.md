# Apuntes Sail

``` bash
  wsl -d ubuntu
``` 
Para meterse dentro de Linux Ubuntu dentro de Windows sin meterse directamente en una máquina virtual de Linux

exit (Estando dentro de Linux Ubuntu): Para salir de Ubuntu y volver a la terminal de Windows

wsl -l -v: Para listar las versiones que se usan de las distribuciones

(Dentro de tu proyecto) curl -s https://laravel.build/prueba-sail?with=mysql | bash: Para crear un proyecto Laravel
¡OjO!. De este comando, "prueba-sail" se refiere al nombre del proyecto. Luego, "?with=mysql", son los servicios del docker
Si no pones nada ahí, descargará por defecto los que tiene. Mejor pon sólo mysql, que será probablemente el único que usemos

npm install && npm run build: Para descargar los módulos del proyecto, como en Angular

(Dentro de Linux Ubuntu) echo 'alias sail="./vendor/bin/sail"' >> ~/.bashrc: Para crear un alias de la ruta que dirige a sail para ejecutarse

(Dentro de Linux Ubuntu) source ~/.bashrc: Para actualizar el archivo donde se puso el alias

(Dentro de Linux Ubuntu) sail up -d: Como si fuese docker-compose up, pero en Linux Ubuntu

(Dentro de Linux Ubuntu) sail artisan migrate: Para actualizar la base de datos de los archivos de migración

(En un navegador) localhost: Para acceder al servidor creado