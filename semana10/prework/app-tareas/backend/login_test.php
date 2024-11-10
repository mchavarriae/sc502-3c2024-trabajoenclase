<?php
require("login.php");
//tests
if(login("juanito@gmail.com", "123456")){
    echo "Login correcto";
}else{
    echo "Login incorrecto";
}