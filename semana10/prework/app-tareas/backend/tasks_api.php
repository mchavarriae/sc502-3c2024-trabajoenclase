<?php
session_start();
header("Content-Type: application/json");
require 'tasks.php';

// Función para obtener el cuerpo de la solicitud en JSON
function getJsonInput()
{
    return json_decode(file_get_contents("php://input"), true);
}

// Verifica el método HTTP
$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Ajusta los índices según la estructura de tu URL
$resource = $path[5] ?? null;
$id = $path[6] ?? null;
// Verifica que el recurso solicitado sea `tasks`
if (!str_contains($resource, 'tasks')) {
    http_response_code(404);
    echo json_encode(["error" => "Recurso no encontrado"]);
    exit;
}
//verifica que exista una sesion y extrae el user id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    //verifica si vamos a interactuar con una tarea
    
    switch ($method) {
        case 'GET':
            if ($id) {
                // Obtener una tarea por ID
                $tarea = obtenerTareaPorId($id);
                if ($tarea) {
                    echo json_encode($tarea);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Tarea no encontrada"]);
                }
            } else {
                // Obtener todas las tareas del usuario conectado
                if ($user_id) {
                    $tareas = obtenerTareasPorUsuario($user_id);
                    echo json_encode($tareas);
                } else {
                    http_response_code(response_code: 400);
                    echo json_encode(["error" => "Se requiere el parámetro user_id"]);
                }
            }
            break;

        case 'POST':
            // Crear una nueva tarea (requiere title, description, due_date), el usuario es el que esta conectado
            $input = getJsonInput();
            if (isset( $input['title'], $input['description'], $input['due_date'])) {
                $id = crearTarea($user_id, $input['title'], $input['description'], $input['due_date']);
                if ($id) {
                    http_response_code(201);
                    echo json_encode(["message" => "Tarea creada", "id" => $id]);
                } else {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al crear la tarea"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos para crear la tarea"]);
            }
            break;

        case 'PUT':
            // Editar una tarea existente (requiere id en URL y title, description, due_date en JSON)
            if ($id) {
                $input = getJsonInput();
                if (isset($input['title'], $input['description'], $input['due_date'])) {
                    $actualizado = editarTarea($id, $input['title'], $input['description'], $input['due_date']);
                    if ($actualizado) {
                        echo json_encode(["message" => "Tarea actualizada"]);
                    } else {
                        http_response_code(404);
                        echo json_encode(["error" => "Tarea no encontrada o sin cambios"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Faltan datos para editar la tarea"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Se requiere el ID de la tarea para editar"]);
            }
            break;

        case 'DELETE':
            // Eliminar una tarea (requiere id en URL)
            if ($id) {
                $eliminado = eliminarTarea($id);
                if ($eliminado) {
                    echo json_encode(["message" => "Tarea eliminada"]);
                } else {
                    http_response_code(404);
                    echo json_encode(["error" => "Tarea no encontrada"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Se requiere el ID de la tarea para eliminar"]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            break;
    }
} else {
    http_response_code(response_code: 401);
    echo json_encode(array("status" => "session_not_active"));

}