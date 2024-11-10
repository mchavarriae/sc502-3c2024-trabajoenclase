<?php
require('db.php');

function userRegistry($username, $password, $email)
{
    try {
        global $pdo;
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $passwordHashed, 'email' => $email]);
        logDebug("Usuario registrado");
        return true;
    } catch (Exception $e) {
        logError("An error has ocurred: " . $e->getMessage());
        return false;
    }
}
