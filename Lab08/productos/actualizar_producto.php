<?php
include('../conexion/conexion.php');
// Abrimos la conexión a la base de datos
$conexion = conectar();
// Obtenemos los nuevos datos del autor
$producto_id = $_POST['producto_id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$precio_venta = $_POST['precio_venta'];
// Formamos la consulta SQL
$query = $conexion->prepare('UPDATE producto SET nombre = ?, descripcion = ?, stock = ?, precio_venta = ? WHERE producto_id = ?');
$query->bind_param('ssiii', $nombre, $descripcion, $stock, $precio_venta, $producto_id);
if ($query->execute()) {
    echo "<script>alert('Producto actualizado con exito');</script>";
    echo "<script>window.location.replace('producto.php');</script>";
} else {
    echo "<script>alert('Error al actualizar los datos del producto');</script>";
    echo "<script>window.location.replace('editar_producto.php?producto_id=" . $producto_id . "');</script>";
}
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>