# Unidad 2.2 CSS3 – Guía paso a paso para creación de página de producto
En este proyecto, se nos ha solicitado crear una página web para mostrar información de productos de una tienda ficticia. El objetivo es proporcionar una experiencia visual atractiva y funcional para los usuarios, donde puedan navegar por diferentes productos y filtrarlos según diversas categorías.

Esta página debe incluir una barra de navegación que permita acceder a diferentes secciones del sitio, una barra lateral para filtrar productos por categorías, y tarjetas de productos que muestren la imagen, el nombre, la descripción y el precio de cada artículo. Además, la página tendrá un pie de página con los detalles de la tienda, como su dirección y derechos de autor.

A lo largo de este documento, construiremos paso a paso los elementos fundamentales de la página, abordando aspectos como la estructura HTML, el uso de flexbox para crear un diseño adaptable, la aplicación de estilos CSS y la implementación de componentes como la barra de navegación, la barra lateral de filtros, y el pie de página. Este enfoque nos permitirá aprender y aplicar técnicas modernas de desarrollo web mientras creamos una página atractiva y funcional

La pagina web se vera asi: 

[<img src="https://storage.googleapis.com/bioenia-images-dev/Unidad2.2-Ejemplo.png">]
### **Paso 1: Crear la estructura básica del HTML**
**Objetivo:** Establecer la base de la página web, incluyendo las etiquetas necesarias como `<!DOCTYPE html>`, `html`, `head`, y `body`.

**Código:**
```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del producto</title>
</head>
<body>
</body>
</html>
```

---

### **Paso 2: Agregar la barra de navegación**
**Objetivo:** Incluir una barra de navegación sencilla que permita a los usuarios desplazarse entre secciones.

- Recuerda cómo el contenedor `nav` ayuda a crear una estructura de navegación.
- Vamos a usar `flexbox` para alinear los enlaces horizontalmente y veremos cómo aplicar efectos de estilo como el cambio de color al hacer hover.

**Código:**
```html
<nav class="navbar">
    <a href="#">Inicio</a>
    <a href="#">Productos</a>
    <a href="#">Servicios</a>
    <a href="#">Contacto</a>
</nav>

<style>
.navbar {
    display: flex;
    justify-content: space-between;
    background-color: #333;
    padding: 10px;
}
.navbar a {
    color: white;
    text-decoration: none;
    padding: 10px;
}
.navbar a:hover {
    background-color: #575757;
}
</style>
```

---

### **Paso 3: Agregar una barra lateral con categorías**
**Objetivo:** Crear una barra lateral usando `aside` para mostrar un filtro de categorías.

- Recuerda el uso de `aside` para contenido complementario como filtros.
- Estiliza la barra lateral para que sea fija en el lado izquierdo de la página.

**Código:**
```html
<aside>
    <h4>Filtrar por Categorías</h4>
    <ul>
        <li><a href="#">Electrónica</a></li>
        <li><a href="#">Ropa</a></li>
        <li><a href="#">Hogar</a></li>
        <li><a href="#">Juguetes</a></li>
        <li><a href="#">Deportes</a></li>
    </ul>
</aside>

<style>
aside {
    width: 200px;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
aside h4 {
    color: #333;
}
aside ul {
    list-style-type: none;
    padding: 0;
}
aside ul li {
    margin-bottom: 10px;
}
aside ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}
aside ul li a:hover {
    color: #e74c3c;
}
</style>
```

---

### **Paso 4: Mostrar las tarjetas de productos**
**Objetivo:** Mostrar productos en formato de tarjetas utilizando HTML y CSS.

- Podemos usar `div` para crear tarjetas de productos, con imágenes, descripciones y precios.
- Vamos a usar `flexbox` para alinear las tarjetas horizontalmente y permitir que se adapten a la pantalla.

**Código:**
```html
<section class="productos">
    <div class="tarjeta-producto">
        <img src="producto01.jpeg" alt="Producto">
        <h3>Producto 1</h3>
        <p>Descripción breve del producto.</p>
        <p class="precio">$29.99</p>
    </div>
    <div class="tarjeta-producto">
        <img src="producto02.jpeg" alt="Producto">
        <h3>Producto 2</h3>
        <p>Descripción breve del producto número 2</p>
        <p class="precio">$39.99</p>
    </div>
    <div class="tarjeta-producto">
        <img src="producto03.jpeg" alt="Producto">
        <h3>Producto 3</h3>
        <p>Descripción breve del producto número 3</p>
        <p class="precio">$19.99</p>
    </div>
</section>

<style>
.productos {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}
.tarjeta-producto {
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
    margin: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.tarjeta-producto img {
    max-width: 100%;
    height: auto;
}
.tarjeta-producto h3 {
    color: #333;
}
.tarjeta-producto .precio {
    color: #e74c3c;
    font-size: 20px;
    font-weight: bold;
}
</style>
```

---

### **Paso 5: Añadir un gradiente de fondo**
**Objetivo:** Mejorar el diseño visual del fondo con un gradiente suave.

- Vamos a usar `background: linear-gradient` para agregar un gradiente de colores en la página, en Internet hay recursos que nos pueden ayudar a crear estos gradientes.

**Código:**
```html
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom, #f8f9fa, #e0e0e0);
}
</style>
```

---

### **Paso 6: Añadir un pie de página (footer)**
**Objetivo:** Incluir un pie de página con información de la tienda y derechos de autor.

-  Vamos a usar la etiqueta `<footer>` para mostrar información en la parte inferior de la página.
  
**Código:**
```html
<footer>
    <p>Copyright © 2024 Tienda Fictalandia</p>
    <p>Dirección: Calle Los Almendros 123, Ciudad Juarez, Mexico</p>
</footer>

<style>
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    width: 100%;
}
</style>
```

---

### **Paso 7: Agregar el contenedor principal (`.container`)**
**Objetivo:** Crear una estructura de página con `flexbox` que alinee la barra lateral y el contenido principal.

Vamos a meter el aside y la lista de productos dentro de un div con la clase container, el section de productos lo vamos convertir en un div y encima de el vamos a crear un section con la clase main-content
  
- **`.container`**: Usamos `display: flex` para organizar los elementos de la página en dos columnas. La barra lateral (`aside`) ocupa una sección fija de 200px de ancho, mientras que el contenido principal (`.main-content`) toma el resto del espacio disponible gracias a la propiedad `flex: 1`.
  
- **`.main-content`**: El contenido principal está alineado a la derecha de la barra lateral. Le aplicamos `padding: 20px` para darle espacio interno y que no se vea pegado al borde.

Este contenedor es esencial para que la barra lateral y las tarjetas de productos se alineen correctamente.

**Código:**
```html
<div class="container">
    <aside>
        <h4>Filtrar por Categorías</h4>
        <ul>
            <li><a href="#">Electrónica</a></li>
            <li><a href="#">Ropa</a></li>
            <li><a href="#">Hogar</a></li>
            <li><a href="#">Juguetes</a></li>
            <li><a href="#">Deportes</a></li>
        </ul>
    </aside>

    <section class="main-content">
        <div class="productos">
            <div class="tarjeta-producto">
                <img src="producto01.jpeg" alt="Producto">
                <h3>Producto 1</h3>
                <p>Descripción breve del producto.</p>
                <p class="precio">$29.99</p>
            </div>
            <div class="tarjeta-producto">
                <img src="producto02.jpeg" alt="Producto">
                <h3>Producto 2</h3>
                <p>Descripción breve del producto número 2</p>
                <p class="precio">$39.99</p>
            </div>
            <div class="tarjeta-producto">
                <img src="producto03.jpeg" alt="Producto">
                <h3>Producto 3</h3>
                <p>Descripción breve del producto número 3</p>
                <p class="precio">$19.99</p>
            </div>
        </div>
    </section>
</div>

<style>
.container {
    display: flex;
    margin: 20px;
}
.main-content {
    flex: 1;
    padding: 20px;
}
</style>
```

---
