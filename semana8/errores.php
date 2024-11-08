<?php
try {
    //code...
    // leer un archivo:
$archivoALeer = fopen(filename: "ejemplos.txt",mode: "r");
while(!feof($archivoALeer)){
    echo fgets($archivoALeer);
}
fclose($archivoALeer);

} catch (Exception $error) {
    echo "error: " . $error-> getMessage();
}