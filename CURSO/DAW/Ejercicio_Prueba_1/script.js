function sumarNumeros() {
    const num1 = parseFloat(document.getElementById('numero1').value); //Guardar valor del numero1 en variable
    const num2 = parseFloat(document.getElementById('numero2').value); //Guardar valor del numero2 en variable

    if(isNaN(num1) || isNaN(num2)) { //Asegurarse de que son válidos los números introducidos
        document.getElementById('resultado').textContent = "Por favor, ingrese numeros validos";
        return;
    }

    const suma = num1 + num2; //Realizar suma en caso de ser válidos
    document.getElementById('resultado').textContent = "Resultado: " + suma; //Mostrar contenido del resultado en el texto del div de Suma_Simple.html
}