

# Unidad 3: Programación Frontend con JavaScript



## Demo de Clase: Calculadora Básica con JavaScript



### 1. Estructura HTML



```html

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Calculadora Básica</title>

</head>

<body>

<h1>Calculadora Básica</h1>

<div>

<input type="number" id="num1" placeholder="Primer número">

<input type="number" id="num2" placeholder="Segundo número">

<select id="operation">

<option value="sum">Suma</option>

<option value="sub">Resta</option>

<option value="mul">Multiplicación</option>

<option value="div">División</option>

</select>

<button onclick="calculate()">Calcular</button>

</div>

<h2>Resultado: <span id="result">0</span></h2>

  

<script src="script.js"></script>

</body>

</html>
```


**2. Script JavaScript**


```javascript
function calculate() {

const num1 = parseFloat(document.getElementById('num1').value);

const num2 = parseFloat(document.getElementById('num2').value);

const operation = document.getElementById('operation').value;

let result;

  

if (isNaN(num1) || isNaN(num2)) {

alert('Por favor ingrese números válidos');

return;

}

  

switch (operation) {

case 'sum':

result = num1 + num2;

break;

case 'sub':

result = num1 - num2;

break;

case 'mul':

result = num1 * num2;

break;

case 'div':

if (num2 !== 0) {

result = num1 / num2;

} else {

alert('No se puede dividir entre cero');

return;

}

break;

default:

result = 0;

}

  

document.getElementById('result').innerText = result;

}

  ```

**Ejercicios Prácticos:**



**Ejercicio 1: Manipulación del DOM**



1.  Crea un botón en la página que cambie el contenido de un párrafo cuando se le haga clic.

2.  Usa document.getElementById y innerHTML para lograrlo.



**Ejercicio 2: Estructura de control de flujo**



1.  Crea una página que permita al usuario ingresar su edad.

2.  Si el usuario es mayor de 18, mostrar un mensaje de “Eres mayor de edad”.

3.  Si no, mostrar un mensaje de “Eres menor de edad”.



**Ejercicio 3: Manipulación de Arreglos**



1.  Crea un arreglo de objetos que contenga información de estudiantes, con propiedades como nombre, apellido, y nota.

2.  Usa un ciclo for o forEach para recorrer el arreglo e imprimir los nombres y apellidos en un div en la página.

3.  Calcula el promedio de las notas y muestra el resultado al final de la lista.




**Ejercicio 4: Cargar y mostrar JSON**



1.  Define un objeto JSON que contenga información de productos (nombre, categoría, precio).

2.  Convierte ese JSON a un arreglo de objetos y muéstralo en una tabla en el HTML.

3.  Permite que el usuario filtre los productos por categoría.
