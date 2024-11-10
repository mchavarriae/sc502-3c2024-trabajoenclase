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

// Verifica el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Verifica si el método es POST
if ($method === 'POST') {
    // Verifica que los datos de username y password estén presentes en $_POST
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['email'];
        $password = $_POST['password'];

        // Llama a la función login
        if (login($username, $password)) {
            http_response_code(200);
            echo json_encode(["message" => "Login exitoso", "user_id" => $_SESSION['user_id']]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Credenciales incorrectas"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Se requieren username y password"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}