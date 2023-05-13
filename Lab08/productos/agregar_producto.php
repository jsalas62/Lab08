<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos los valores del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$precio_venta = $_POST['precio_venta'];

// Formamos la consulta SQL

$query = $conexion->prepare('INSERT INTO producto (nombre, descripcion, stock, precio_venta) VALUES (?, ?, ?, ?)');
$query->bind_param('ssii', $nombre, $descripcion, $stock, $precio_venta);

if ($query->execute()) {
    echo "<script>alert('Producto registrado con exito');</script>";
    echo "<script>window.location.replace('producto.php');</script>";

    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    echo "<script>alert('No se pudo registrar el producto');</script>";
    echo "<script>window.location.replace('editar_producto.php?libro_id=" . $producto_id . "');</script>";
}

//Cerramos la conexión a la base de datos

desconectar($conexion);
?>