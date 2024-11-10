<?php
// tasks.php

require 'db.php';

// Crear una tarea
function crearTarea($user_id, $title, $description, $due_date)
{
    global $pdo;
    try {
        $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (:user_id, :title, :description, :due_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'title' => $title,
            'description' => $description,
            'due_date' => $due_date
        ]);
        return $pdo->lastInsertId(); // Devuelve el ID de la tarea creada
    } catch (PDOException $e) {
        logError("Error al crear la tarea: " . $e->getMessage());
        return false;
    }
}

// Obtener todas las tareas de un usuario
function obtenerTareasPorUsuario($user_id)
{
    global $pdo;
    try {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        logError("Error al obtener tareas: " . $e->getMessage());
        return [];
    }
}

// Obtener una tarea por ID
function obtenerTareaPorId($id)
{
    global $pdo;
    try {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        logError("Error al obtener la tarea: " . $e->getMessage());
        return false;
    }
}

// Editar una tarea
function editarTarea($id, $title, $description, $due_date)
{
    global $pdo;
    try {
        $sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'due_date' => $due_date,
            'id' => $id
        ]);
        return $stmt->rowCount() > 0; // Retorna true si se actualizó al menos una fila
    } catch (PDOException $e) {
        logError("Error al editar la tarea: " . $e->getMessage());
        return false;
    }
}

// Eliminar una tarea
function eliminarTarea($id)
{
    global $pdo;
    try {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0; // Retorna true si se eliminó al menos una fila
    } catch (PDOException $e) {
        logError("Error al eliminar la tarea: " . $e->getMessage());
        return false;
    }
}
