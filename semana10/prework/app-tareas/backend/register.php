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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all required fields are present
    if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Call the userRegistry function
        if (userRegistry($username, $password, $email)) {
            http_response_code(201);
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to register user"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Missing username, password, or email"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}
