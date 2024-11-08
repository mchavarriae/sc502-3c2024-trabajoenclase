<?php
// crear y escribir un archivo
$archivo = fopen("ejemplo.txt","w") or die("NO se puede abrir el archivo");
$txt = "Hola mundo ";
fwrite($archivo, $txt);
fclose($archivo);

// leer un archivo:
$archivoALeer = fopen(filename: "ejemplo.txt",mode: "r") or die("No se puede abrir el archivo");
while(!feof($archivoALeer)){
    echo fgets($archivoALeer);
}
fclose($archivoALeer);
