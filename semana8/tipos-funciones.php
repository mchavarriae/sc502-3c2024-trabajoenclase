<?php
//funcion simple
function saludar($nombre){
    return "Hola " . $nombre . PHP_EOL;
}

echo saludar("Profe");

//funcion anonima
$suma = function($a, $b){
    return $a +  $b;
};

echo $suma(5,10);

//funcion flecha:
$duplicar = fn($n) => $n*2;

echo $duplicar(4);

//funciones integradas
echo strlen("Hola Mundo");
