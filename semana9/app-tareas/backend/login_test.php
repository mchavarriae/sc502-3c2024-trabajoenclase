<?php
require 'login.php';

if(login('juanito2@gmail.com', '123456')){
    echo 'Login Correcto' . PHP_EOL;
}else{
    echo 'Login incorrecto' . PHP_EOL;
}


if(login('juanito100@gmail.com', '55454545')){
    echo 'Login correcto'. PHP_EOL;
}else{
    echo 'Login incorrecto'. PHP_EOL;
}