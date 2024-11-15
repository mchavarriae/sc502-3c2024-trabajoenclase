<?php
session_start();
require 'db.php';

function login($username, $password){
    try{
        global $pdo;
        $sql = "SELECT * FROM users where username = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute(['username' => $username]);
        //$user va a ser un arreglo asociativo con los datos de usuario;
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($user){
            if(password_verify($password, $user['password'])){
                $_SESSION['user_id'] = $user["id"];
                return true;
            }
        }
        return false;
    }catch(Exception $e){
        logError($e -> getMessage());
        return false;
    }
}