<?php
require 'tasks.php';

// Prueba de la función crearTarea
echo "Creando una nueva tarea...\n";
$idTarea = crearTarea(1, 'Aprender PHP', 'Practicar funciones CRUD en PHP con PDO', '2024-12-01');
if ($idTarea) {
    echo "Tarea creada exitosamente con ID: $idTarea\n";
} else {
    echo "Error al crear la tarea.\n";
}

// Prueba de la función obtenerTareasPorUsuario
echo "\nObteniendo todas las tareas del usuario con ID 1...\n";
$tareas = obtenerTareasPorUsuario(1);
if ($tareas) {
    foreach ($tareas as $tarea) {
        echo "ID: " . $tarea['id'] . " - Título: " . $tarea['title'] . " - Descripción: " . $tarea['description'] . "\n";
    }
} else {
    echo "No se encontraron tareas para el usuario.\n";
}

// Prueba de la función obtenerTareaPorId
echo "\nObteniendo detalles de la tarea con ID $idTarea...\n";
$tarea = obtenerTareaPorId($idTarea);
if ($tarea) {
    echo "ID: " . $tarea['id'] . " - Título: " . $tarea['title'] . " - Descripción: " . $tarea['description'] . " - Fecha límite: " . $tarea['due_date'] . "\n";
} else {
    echo "No se encontró la tarea con ID $idTarea.\n";
}

// Prueba de la función editarTarea
echo "\nEditando la tarea con ID $idTarea...\n";
$editado = editarTarea($idTarea, 'Aprender PHP y MySQL', 'Ampliar conocimiento en CRUD y SQL', '2024-12-15');
if ($editado) {
    echo "Tarea editada exitosamente.\n";
} else {
    echo "Error al editar la tarea.\n";
}

// Prueba de la función eliminarTarea
echo "\nEliminando la tarea con ID $idTarea...\n";
$eliminado = eliminarTarea($idTarea);
if ($eliminado) {
    echo "Tarea eliminada exitosamente.\n";
} else {
    echo "Error al eliminar la tarea.\n";
}
