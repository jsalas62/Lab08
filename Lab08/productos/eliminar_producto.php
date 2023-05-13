<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos el id del autor a eliminar
$producto_id = $_POST['producto_id'];
// Preparamos la consulta SQL
$query = $conexion->prepare("DELETE FROM producto WHERE producto_id = ?");
$query->bind_param("i", $producto_id);
// Ejecutamos la consulta SQL
if ($query->execute()) {
    $msg = "Producto eliminado con éxito";
    echo "<script>alert('" . $msg . "'); window.location='producto.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
} else {
    $msg = "No se pudo eliminar el producto";
    echo "<script>alert('" . $msg . "'); window.location='producto.php';</script>";
    exit(); // Terminar el script para prevenir la ejecución adicional
}
// Cerramos la conexión a la base de datos
desconectar($conexion);
?>