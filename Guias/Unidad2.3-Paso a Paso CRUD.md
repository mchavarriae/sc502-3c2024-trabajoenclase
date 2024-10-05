
# Unidad 2.3 Bootstrap – Guía paso a paso para creación de un CRUD

En este proyecto, se nos ha solicitado crear la seccion de administracion de usuarios.

La pagina web se vera asi:

<img src="https://storage.googleapis.com/bioenia-images-dev/unidad2.3-ejemplo.png">

A continuación vamos a ir construyendolo paso a paso:

## Paso 1: Estructura básica de HTML y configuración de Bootstrap

### 1.1 Crear el archivo HTML
Primero, crea un archivo HTML con la estructura básica para comenzar a desarrollar la aplicación CRUD.

```html  
<!DOCTYPE html>  
<html lang="es">  
<head>  
 <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Simulación CRUD con Modo Oscuro</title> <!-- Bootstrap CDN --> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <style> /* Estilos personalizados */ </style></head>  
<body>  
 <!-- Contenido aquí -->   <!-- Bootstrap JS -->  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></body>  
</html>  
```  

### 1.2 Importar Bootstrap
En este paso, estamos incluyendo el CDN de Bootstrap en el `<head>` del documento. Bootstrap es una biblioteca CSS que proporciona componentes predefinidos como botones, formularios, tablas, entre otros, para facilitar el diseño de interfaces.

```html  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
```  

### 1.3 Etiquetas `<meta>` y vista responsiva
Estamos utilizando las etiquetas meta:

```html  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
```  

Estas etiquetas aseguran que la página sea responsiva y se muestre correctamente en diferentes dispositivos (teléfonos, tablets, computadoras). El atributo `viewport` asegura que el contenido se ajuste al ancho de la pantalla.

### 1.4 JavaScript de Bootstrap
Al final del documento, estamos incluyendo el archivo de JavaScript de Bootstrap para que funcionen componentes interactivos como el modo oscuro que se implementará más adelante.

```html  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  
```  

## Paso 2: Crear la barra de navegación lateral (Sidebar)

Ahora que tenemos la estructura básica del HTML y Bootstrap configurado, vamos a crear una barra de navegación lateral.

```html  
<!-- Barra de navegación lateral -->  
<div class="sidebar">  
 <h2 class="text-center">Menú</h2> <a href="#">Inicio</a> <a href="#">Usuarios</a> <a href="#">Configuración</a> <a href="#">Ayuda</a> <button class="btn btn-light mt-4" id="toggleDarkMode">Modo Oscuro</button></div>  
```  

### 2.1 Explicación de las clases
- `.sidebar`: Esta clase es personalizada, por lo que está definida en el bloque `<style>`. Sirve para dar estilo a la barra lateral.
```css  
.sidebar {  
 height: 100%; background-color: #343a40; color: white; position: fixed; top: 0; left: 0; width: 220px; padding-top: 20px;}  
```  

- `.text-center`: Esta es una clase de Bootstrap que centra el texto horizontalmente. Se utiliza en el `<h2>` para centrar el título del menú.

- `.btn` y `.btn-light`: Estas son clases de Bootstrap para dar formato a los botones. `.btn` es la clase base para todos los botones de Bootstrap y `.btn-light` es un botón con un estilo de fondo claro y texto oscuro.

### 2.2 Estilos adicionales en CSS
```css  
.sidebar a {  
 color: white; text-decoration: none; display: block; padding: 10px 15px;}  
.sidebar a:hover {  
 background-color: #495057;}  
```  

Este bloque de CSS define el estilo de los enlaces dentro de la barra lateral. Hacemos que los enlaces sean de color blanco, eliminamos el subrayado (`text-decoration: none`) y añadimos un padding interno. Además, cambiamos el color de fondo del enlace cuando el mouse está sobre él con el selector `:hover`.

## Explicación detallada de `.sidebar`

```css  
.sidebar {  
 height: 100%; background-color: #343a40; color: white; position: fixed; top: 0; left: 0; width: 220px; padding-top: 20px;}  
```  

### 1. `height: 100%`
Esta propiedad establece la altura del elemento `.sidebar` al 100% del viewport, es decir, cubre toda la altura visible de la ventana del navegador. Esto asegura que la barra lateral ocupe todo el alto de la pantalla, sin importar el tamaño del contenido dentro de ella.

### 2. `background-color: #343a40`
Aquí estamos definiendo un color de fondo oscuro para la barra lateral usando el valor hexadecimal `#343a40`, que es un color gris oscuro. Este valor es el mismo que Bootstrap usa para sus componentes de fondo oscuro, como las barras de navegación (`navbar-dark`). Así, mantiene una estética uniforme con otros elementos de Bootstrap.

### 3. `color: white`
Esta propiedad establece que todo el texto dentro del contenedor `.sidebar` se mostrará en color blanco, proporcionando un buen contraste con el fondo oscuro.

### 4. `position: fixed`
Esta es una de las propiedades clave para la barra lateral. Establece la posición de la barra como "fija" en relación con la ventana del navegador, no con el flujo normal del documento. Esto significa que:
- La barra permanecerá visible en su posición incluso cuando el usuario haga scroll hacia abajo o arriba en la página.
- La posición fija asegura que siempre se vea en la esquina superior izquierda, independientemente del contenido desplazado.

### 5. `top: 0`
Con la posición fija (`position: fixed`), necesitamos especificar dónde debe estar la barra lateral en la pantalla. La propiedad `top: 0` asegura que la barra lateral comience justo en la parte superior de la ventana del navegador.

### 6. `left: 0`
Similar a `top: 0`, esta propiedad define que el borde izquierdo de la barra lateral debe alinearse con el borde izquierdo de la ventana del navegador. Por lo tanto, la barra lateral siempre aparece anclada en la parte izquierda de la pantalla.

### 7. `width: 220px`
Aquí definimos el ancho de la barra lateral, que es de 220 píxeles. Este valor asegura que la barra tenga un tamaño suficiente para albergar el contenido, pero no demasiado ancho como para ocupar demasiado espacio de la pantalla, permitiendo que el contenido principal tenga suficiente visibilidad.

### 8. `padding-top: 20px`
Finalmente, `padding-top` agrega un espacio interno de 20 píxeles entre la parte superior de la barra lateral y su contenido. Esto asegura que el título del menú no quede pegado al borde superior de la barra lateral, mejorando la estética y la legibilidad.
  
---  

### Desglose visual
El estilo aplicado a `.sidebar` genera una barra lateral fija, visible todo el tiempo en la parte izquierda de la pantalla, con un color de fondo gris oscuro, texto blanco, y un ancho fijo. El espaciado superior y los colores oscuros contribuyen a un diseño moderno y minimalista, acorde con las tendencias actuales.

### Importancia del diseño
El diseño fijo y oscuro de la barra lateral facilita la navegación en aplicaciones donde el usuario puede necesitar moverse rápidamente entre diferentes secciones. Además, al estar siempre visible, la barra lateral actúa como un punto de referencia constante, lo que mejora la usabilidad en sitios o aplicaciones con varias secciones.

## Paso 3: Crear el Contenido Principal

En este paso, agregaremos el contenido principal de la página, donde se realizará la gestión de usuarios. Esto incluye un formulario para agregar nuevos usuarios y una tabla para mostrar la lista de usuarios existentes.

```html
<!-- Contenido principal -->
<div class="content">
  <h1 class="text-center mb-4">Gestión de Usuarios</h1>

  <!-- Formulario para agregar usuario -->
  <h2>Agregar nuevo usuario</h2>
  <form>
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" placeholder="Ingresa el nombre del usuario" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="email" class="form-control" id="email" placeholder="Ingresa el correo electrónico" required>
    </div>
    <div class="mb-3">
      <label for="rol" class="form-label">Rol</label>
      <select class="form-select" id="rol">
        <option selected>Selecciona un rol</option>
        <option value="admin">Administrador</option>
        <option value="editor">Editor</option>
        <option value="viewer">Visualizador</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
  </form>

  <!-- Tabla de usuarios -->
  <h2 class="mt-5">Lista de Usuarios</h2>
  <table class="table table-striped table-bordered mt-3">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Juan Pérez</td>
        <td>juan.perez@example.com</td>
        <td>Administrador</td>
        <td>
          <button class="btn btn-warning btn-sm">Editar</button>
          <button class="btn btn-danger btn-sm">Eliminar</button>
        </td>
      </tr>
      <!-- Más filas -->
    </tbody>
  </table>
</div>
```

### 3.1 Clases de Bootstrap Utilizadas

#### 1. `.content`
La clase `.content` es personalizada. Aquí aseguramos que todo el contenido principal esté separado del menú lateral:

```css
.content {
  margin-left: 240px;
  padding: 20px;
}
```

Esto asegura que el contenido esté alineado a la derecha del menú lateral, dejando un margen de 240 píxeles. El `padding: 20px` agrega espacio interno para que el contenido no esté pegado a los bordes del contenedor.

#### 2. `.text-center`
La clase `.text-center` de Bootstrap centra horizontalmente el texto. Se utiliza en el título principal `<h1>` para centrar el texto "Gestión de Usuarios".

#### 3. `.mb-4`, `.mt-5`, `.mt-3`, `.mb-3`
Estas son clases de Bootstrap que agregan márgenes (margin) para espaciar los elementos:

- `.mb-4`: Agrega un margen inferior de 1.5rem (24 píxeles) al título `<h1>`.
- `.mt-5`: Agrega un margen superior de 3rem (48 píxeles) al subtítulo "Lista de Usuarios".
- `.mt-3`: Agrega un margen superior de 1rem (16 píxeles) a la tabla de usuarios.
- `.mb-3`: Agrega un margen inferior de 1rem (16 píxeles) a los elementos dentro del formulario.

#### 4. `.form-label`, `.form-control`, `.form-select`
- `.form-label`: Estilo que da formato a los labels de los formularios.
- `.form-control`: Clase que estiliza los inputs, haciéndolos más accesibles y alineados.
- `.form-select`: Clase de Bootstrap que estiliza los selectores `<select>` de una manera consistente.

#### 5. `.btn` y `.btn-primary`
- `.btn`: La clase base para todos los botones en Bootstrap.
- `.btn-primary`: Aplica el estilo del botón principal con un color de fondo azul.

#### 6. `.table`, `.table-striped`, `.table-bordered`
Estas son clases de Bootstrap para dar formato a las tablas:

- `.table`: Clase base que aplica estilos generales a las tablas, como el espaciado adecuado y el formato para que sean legibles.
- `.table-striped`: Agrega un fondo alterno a las filas para mejorar la legibilidad.
- `.table-bordered`: Agrega bordes alrededor de las celdas de la tabla para separarlas visualmente.

#### 7. `.btn-warning` y `.btn-danger`
Bootstrap incluye varias clases para diferentes estilos de botones:

- `.btn-warning`: Estilo de botón con fondo color naranja, utilizado para el botón "Editar".
- `.btn-danger`: Estilo de botón con fondo color rojo, utilizado para el botón "Eliminar".
- `.btn-sm`: Aplica un tamaño pequeño a los botones.

### 3.2 Formularios y Tabla

El formulario para agregar usuarios está compuesto por tres campos (nombre, correo electrónico y rol). Cada uno está estilizado usando las clases de formulario de Bootstrap, que aseguran que los elementos se alineen correctamente y sean responsivos.

La tabla de usuarios utiliza clases de Bootstrap para ser visualmente atractiva y funcional. La tabla muestra las columnas ID, Nombre, Email, Rol y Acciones. En las acciones, tenemos dos botones: uno para editar y otro para eliminar el usuario.


## Paso 4: Implementar el Modo Oscuro

En este paso, agregaremos la funcionalidad para que los usuarios puedan cambiar entre modo claro y oscuro con un botón. Ya tienes el botón en el menú lateral, ahora explicaremos cómo funciona el código JavaScript y las clases relacionadas con el modo oscuro.

### 4.1 Botón para cambiar el modo oscuro

```html
<button class="btn btn-light mt-4" id="toggleDarkMode">Modo Oscuro</button>
```

- **`btn` y `btn-light`**: Estas son clases de Bootstrap que estilizan el botón. `btn-light` aplica un color de fondo claro al botón.
- **`mt-4`**: Clase de margen superior (`margin-top`) que añade un margen de 1.5rem (24 píxeles).
- **`id="toggleDarkMode"`**: Este atributo `id` es clave, ya que será el que utilizaremos en JavaScript para agregar la funcionalidad de cambio de modo.

### 4.2 Estilos para el modo oscuro

```css
.dark-mode {
  background-color: #212529;
  color: white;
}

.dark-mode .table {
  color: white;
}

.dark-mode .btn {
  color: white;
}
```

- **`.dark-mode`**: Esta clase aplica el fondo oscuro a todo el contenido de la página cuando se activa. El color de fondo cambia a un gris oscuro (`#212529`), que es consistente con el tema oscuro de Bootstrap.
- **`.dark-mode .table`**: Esta clase hace que el texto dentro de las tablas sea blanco, para asegurar que sea visible sobre el fondo oscuro.
- **`.dark-mode .btn`**: Cambia el color del texto de los botones a blanco para que el contraste sea adecuado con el fondo oscuro.

### 4.3 JavaScript para alternar entre los modos

```html
<script>
  const toggleButton = document.getElementById('toggleDarkMode');
  const body = document.body;

  toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    toggleButton.textContent = body.classList.contains('dark-mode') ? 'Modo Claro' : 'Modo Oscuro';
  });
</script>
```

Este script realiza lo siguiente:

1. **`document.getElementById('toggleDarkMode')`**: Obtiene el botón que tiene el ID `toggleDarkMode` para que podamos asignarle un comportamiento cuando se haga clic en él.
2. **`body.classList.toggle('dark-mode')`**: Cuando el botón es presionado, usamos `classList.toggle` para alternar la clase `dark-mode` en el `<body>`. Si la clase `dark-mode` ya está presente, la elimina; si no está, la agrega.
3. **Cambio de texto en el botón**: Dependiendo de si la clase `dark-mode` está activa o no, el texto del botón cambiará entre "Modo Oscuro" y "Modo Claro".

### Funcionamiento

Cuando el usuario hace clic en el botón, el contenido de la página cambiará de color, activando el fondo oscuro y ajustando los colores del texto y los botones. La tabla y otros elementos también cambiarán para adaptarse al nuevo esquema de colores. Este es un cambio visual, y al hacer clic nuevamente, el modo claro volverá a activarse.
