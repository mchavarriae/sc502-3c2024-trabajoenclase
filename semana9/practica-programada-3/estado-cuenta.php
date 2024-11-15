<?php
// Definir el arreglo de transacciones
$transacciones = [];

// Función para registrar una transacción
function registrarTransaccion($id, $descripcion, $monto) {
    global $transacciones;

    // Agregar nueva transacción usando array_push
    array_push($transacciones, [
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    ]);

    echo "Transacción registrada: $descripcion - Monto: $monto\n";
}

// Función para generar el estado de cuenta y guardarlo en un archivo de texto
function generarEstadoDeCuenta() {
    global $transacciones;
    $montoTotal = 0;

    // Crear o abrir el archivo de texto
    $archivo = fopen("estado_cuenta.txt", "w");

    // Encabezado del estado de cuenta en pantalla y en archivo
    $estado = "Estado de Cuenta\n";
    $estado .= "================\n";
    $estado .= "Detalles de las transacciones:\n";

    // Mostrar detalles de cada transacción y sumar los montos
    foreach ($transacciones as $transaccion) {
        $estado .= "- {$transaccion['descripcion']}: \${$transaccion['monto']}\n";
        $montoTotal += $transaccion['monto'];
    }

    // Calcular el monto con intereses (2.6%)
    $montoConInteres = $montoTotal * 1.026;

    // Calcular el cashback (0.1%)
    $cashback = $montoTotal * 0.001;

    // Añadir detalles al estado de cuenta
    $estado .= "\nMonto total de contado: $" . number_format($montoTotal, 2) . "\n";
    $estado .= "Monto total con intereses (2.6%): $" . number_format($montoConInteres, 2) . "\n";
    $estado .= "Cashback (0.1%): $" . number_format($cashback, 2) . "\n";

    // Mostrar el estado en pantalla y guardar en el archivo
    echo $estado;
    fwrite($archivo, $estado);

    // Cerrar el archivo
    fclose($archivo);

    echo "\nEstado de cuenta guardado en 'estado_cuenta.txt'.\n";
}

// Simulación de transacciones
registrarTransaccion(1, "Compra en supermercado", 30.0);
registrarTransaccion(2, "Pago de gasolina", 20.0);
registrarTransaccion(3, "Cena en restaurante", 45.0);
registrarTransaccion(4, "Compra en tienda de ropa", 80.0);

// Generar el estado de cuenta
generarEstadoDeCuenta();
