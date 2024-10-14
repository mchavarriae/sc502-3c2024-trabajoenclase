 

**Paso 1: Estructura HTML**
 

1. **Crea la base del proyecto**:

•  Comienza creando los archivos index.html, register.html, y dashboard.html.

•  Estos archivos representarán las tres principales páginas de la aplicación: una para el login, otra para el registro de nuevos usuarios, y la tercera que mostrará el CRUD de tareas.

2. **Estructura del archivo HTML**:

•  Añade la estructura básica de HTML5 en cada uno de estos archivos. Algo similar a esto para cada archivo:

  
```html
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta  name="viewport"  content="width=device-width, initial-scale=1.0">

<title>Task Manager</title>

_<!-- Link to Bootstrap CSS -->_

<link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"  rel="stylesheet">

<link  href="css/styles.css"  rel="stylesheet">

</head>

<body>

_<!-- Page content goes here -->_

</body>

</html>
```
  

  

3. **Conexión de estilos y scripts**:

•  Asegúrate de enlazar correctamente el archivo de Bootstrap y tus propios estilos en css/styles.css.

•  También, enlaza los scripts que usarás para la funcionalidad de la app (ubicados en la carpeta js).

  

**Paso 2: Página de Login (index.html)**

  

1. **Formulario de login**:

•  En el archivo index.html, crea un formulario sencillo para que los usuarios puedan iniciar sesión. Usa componentes de Bootstrap para el formulario:

  
```html
<div  class="container mt-5">

<h2 class="text-center">Login</h2>

<form  id="loginForm">

<div class="form-group">

<label for="email">Email</label>

<input  type="email"  class="form-control"  id="email"  required>

</div>

<div class="form-group">

<label for="password">Password</label>

<input  type="password"  class="form-control"  id="password"  required>

</div>

<button  type="submit"  class="btn btn-primary btn-block">Login</button>

</form>

</div>
```
  

  

2. **Script para manejar el login**:

•  Asegúrate de agregar la lógica para manejar el login. Por ahora, este proceso será simulado. El objetivo es redirigir al usuario al dashboard.html si el login es correcto:

  
```javascript
<script>

document.getElementById('loginForm').addEventListener('submit', function(event) {

event.preventDefault();

_// Lógica simulada de autenticación_

window.location.href = "dashboard.html";

});

</script>
```
  

  

  

**Paso 3: Página de Registro (register.html)**

  

1. **Formulario de registro**:

•  En register.html, crea un formulario similar para el registro de nuevos usuarios. También, puedes usar componentes de Bootstrap:

  
``` html
<div  class="container mt-5">

<h2 class="text-center">Register</h2>

<form  id="registerForm">

<div class="form-group">

<label for="name">Name</label>

<input  type="text"  class="form-control"  id="name"  required>

</div>

<div class="form-group">

<label for="email">Email</label>

<input  type="email"  class="form-control"  id="email"  required>

</div>

<div class="form-group">

<label for="password">Password</label>

<input  type="password"  class="form-control"  id="password"  required>

</div>

<button  type="submit"  class="btn btn-primary btn-block">Register</button>

</form>

</div>
```
  

2. **Script para manejar el registro**:

•  Similar al login, se agrega una lógica simulada para manejar el registro. Por ahora, el usuario será redirigido al index.html después del registro:

  
``` javascript
<script>

document.getElementById('registerForm').addEventListener('submit', function(event) {

event.preventDefault();

_// Lógica simulada de registro_

window.location.href = "index.html";

});

</script>
```
  

  

  

**Paso 4: Página de Dashboard (dashboard.html)**

  

1. **Estructura del dashboard**:

•  La página dashboard.html es donde los usuarios pueden agregar, editar y eliminar tareas. Puedes comenzar por agregar un botón para agregar nuevas tareas y una tabla para listarlas:

  
``` html
<div  class="container mt-5">

<h2 class="text-center">Task Dashboard</h2>

<button  class="btn btn-success mb-3"  data-toggle="modal"  data-target="#taskModal">Add Task</button>

<table class="table">

<thead>

<tr>

<th>Task</th>

<th>Actions</th>

</tr>

</thead>

<tbody id="taskList">

_<!-- Task list will be generated here -->_

</tbody>

</table>

</div>
```
  

  

2. **Modal para agregar/editar tareas**:

•  Usa un modal de Bootstrap para permitir que los usuarios agreguen o editen una tarea. Este es el mismo modal que usaremos más adelante para la edición:

  
``` html
<div  class="modal fade"  id="taskModal"  tabindex="-1"  role="dialog"  aria-labelledby="taskModalLabel"  aria-hidden="true">

<div  class="modal-dialog"  role="document">

<div  class="modal-content">

<div class="modal-header">

<h5 class="modal-title" id="taskModalLabel">Add Task</h5>

<button  type="button"  class="close"  data-dismiss="modal"  aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>

</div>

<div class="modal-body">

<form id="taskForm">

<div class="form-group">

<label for="taskName">Task</label>

<input type="text" class="form-control" id="taskName" required>

</div>

<button type="submit" class="btn btn-primary">Save Task</button>

</form>

</div>

</div>

</div>

</div>
``` 
 

**Paso 5: Funcionalidad JavaScript para el CRUD de Tareas**

  

1. **Script básico para manejar las tareas**:

•  Primero, crearemos una estructura de almacenamiento temporal en el navegador usando **localStorage**. Luego, agregaremos las funciones para agregar, editar y eliminar tareas. Coloca este código al final de dashboard.html dentro de un archivo JavaScript (por ejemplo, js/app.js).

2. **Inicializar las tareas**:

•  Comienza obteniendo las tareas almacenadas en localStorage (si existen) y despliega la lista en la tabla del dashboard.

  
```javascript
document.addEventListener('DOMContentLoaded', function() {

let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

const taskList = document.getElementById('taskList');

  

_// Función para mostrar las tareas_

function displayTasks() {

taskList.innerHTML = '';

tasks.forEach((task, index) => {

const row = document.createElement('tr');

row.innerHTML = `

<td>${task.name}</td>

<td>

<button class="btn btn-primary btn-sm edit-task" data-index="${index}" data-toggle="modal" data-target="#taskModal">Edit</button>

<button class="btn btn-danger btn-sm delete-task" data-index="${index}">Delete</button>

</td>

`;

taskList.appendChild(row);

});

}

  

displayTasks();

});

  ```

  

3. **Agregar nuevas tareas**:

•  A continuación, permite agregar nuevas tareas. Esto se hará desde el modal que ya creamos. Cuando el usuario haga clic en “Save Task”, la tarea se añadirá a la lista y se almacenará en localStorage:

  
``` javascript
document.getElementById('taskForm').addEventListener('submit', function(event) {

event.preventDefault();

  

const taskName = document.getElementById('taskName').value;

  

if (taskName.trim()) {

const task = { name: taskName };

tasks.push(task);

localStorage.setItem('tasks', JSON.stringify(tasks));

displayTasks();

$('#taskModal').modal('hide');

}

});
```
  

  

4. **Editar tareas**:

•  Para editar tareas, primero se llenará el formulario con la información de la tarea que se va a editar, y luego se actualizará la lista al guardar los cambios.

  
``` javascript
let currentTaskIndex;

  

document.getElementById('taskList').addEventListener('click', function(event) {

if (event.target.classList.contains('edit-task')) {

currentTaskIndex = event.target.getAttribute('data-index');

const task = tasks[currentTaskIndex];

document.getElementById('taskName').value = task.name;

}

});

  

document.getElementById('taskForm').addEventListener('submit', function(event) {

event.preventDefault();

const taskName = document.getElementById('taskName').value;

  

if (taskName.trim()) {

tasks[currentTaskIndex] = { name: taskName };

localStorage.setItem('tasks', JSON.stringify(tasks));

displayTasks();

$('#taskModal').modal('hide');

}

});
```
  

  

5. **Eliminar tareas**:

•  Para eliminar una tarea, simplemente la quitamos del arreglo tasks y actualizamos el localStorage. El botón “Delete” que ya añadimos en la tabla se encargará de esto:

  
``` javascript
document.getElementById('taskList').addEventListener('click', function(event) {

if (event.target.classList.contains('delete-task')) {

const index = event.target.getAttribute('data-index');

tasks.splice(index, 1);

localStorage.setItem('tasks', JSON.stringify(tasks));

displayTasks();

}

});
```
  

  

6. **Limpiar el modal después de agregar o editar**:

•  Para asegurarte de que el modal esté vacío cada vez que se abre, puedes agregar esta pequeña función:

  
``` javascript
$('#taskModal').on('hidden.bs.modal', function () {

document.getElementById('taskForm').reset();

});

  ```

  
  
