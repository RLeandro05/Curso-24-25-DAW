# 1. Usamos una imagen base con Python 3.9
FROM python:3.9-slim
# 2. Copiamos los archivos del proyecto al contenedor
WORKDIR /app
COPY . /app
# 3. Instalamos las dependencias desde requirements.txt
RUN pip install --no-cache-dir -r requirements.txt
# 4. Exponemos el puerto 5000 para Flask
EXPOSE 5000
# 5. Comando para ejecutar la aplicación Flask
CMD ["python", "app.py"]