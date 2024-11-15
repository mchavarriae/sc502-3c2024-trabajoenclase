<?php
require 'db.php';

function userRegistry($username, $password, $email)
{
    try {
        global $pdo;
        //encriptamos el password;
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, email) values (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute( ['username' => $username, 'password' => $passwordHashed, 'email' => $email]);
        logDebug("Usuario Registrado");
        return true;

    } catch (Exception $e) {
        logError("Ocurrio un error: " . $e->getMessage());
        return false;
    }
}