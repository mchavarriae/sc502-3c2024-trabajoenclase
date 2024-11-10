<?php
session_start();

require('db.php');
function login($username, $password)
{
    try {
        global $pdo;
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);//arreglo asociativo con los datos del usuario
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user["id"];
                return true;
            }
        }
        return false;
    } catch (Throwable $e) {
        logError($e->getMessage());
        return false;
    }
}
