<?php
include('../conexion/conexion.php');
//Abrimos la conexión a la base de datos
$conexion = conectar();
$id_producto = $_GET['producto_id'];
$query = $conexion->prepare('SELECT producto_id, nombre, descripcion, stock, precio_venta FROM producto WHERE producto_id = ?');
$query->bind_param('i', $id_producto);
$query->execute();
$resultado = $query->get_result();
if ($resultado) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "Error al obtener los datos del producto";
    exit();
}
//Cerramos la conexión a la base de datos
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h1>Editar producto</h1>
            <form method="post" action="actualizar_producto.php">
                <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">
                <table>
                    <tbody>
                        <tr>
                            <td><label>Nombre:</label></td>
                            <td><input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"
                                    maxlength="80" required></td>
                        </tr>
                        <tr>
                            <td><label>Descripcion:</label></td>
                            <td><input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>"
                                    maxlength="250"></td>
                        </tr>
                        <tr>
                            <td><label>Stock:</label></td>
                            <td><input type="text" name="stock" value="<?php echo $producto['stock']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><label>Precio de Venta:</label></td>
                            <td><input type="text" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-success" type="submit">Guardar</button>
                <a href="producto.php" class="btn btn-primary">Regresar</a>
            </form>
        </div>
    </div>
</div>

</body
