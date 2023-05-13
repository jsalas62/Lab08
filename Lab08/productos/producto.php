<?php
include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Verificamos si se ha enviado el formulario de búsqueda
if (isset($_POST['buscar'])) {
    // Obtenemos el término de búsqueda
    $buscar = $_POST['buscar'];

    // Consulta SQL para buscar los productos que coincidan con el término de búsqueda
    $query = "SELECT producto_id, nombre, descripcion, stock, precio_venta FROM producto WHERE nombre LIKE '%$buscar%'";
    $resultado = mysqli_query($conexion, $query);
} else {
    // Consulta SQL para obtener todos los productos
    $query = "SELECT producto_id, nombre, descripcion, stock, precio_venta FROM producto";
    $resultado = mysqli_query($conexion, $query);
}

// Cerramos la conexión a la base de datos
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1>Productos</h1>
                <form action="" method="POST" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar" name="buscar" aria-label="Buscar">
                    <br>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-outline-secondary ml-2">Limpiar</a>
                </form>
                <br>


                <a href="agregar.html"><button class="btn btn-success">Nuevo producto</button></a>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <td>Id Producto</td>
                            <td>Nombre</td>
                            <td>Descripcion</td>
                            <td>Stock</td>
                            <td>Precio de Venta</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mostramos los resultados de la búsqueda
                        while ($producto = mysqli_fetch_assoc($resultado)) {
                            echo '<tr>';
                            echo '<td>' . $producto['producto_id'] . '</td>';
                            echo '<td>' . $producto['nombre'] . '</td>';
                            echo '<td>' . $producto['descripcion'] . '</td>';
                            echo '<td>' . $producto['stock'] . '</td>';
                            echo '<td>' . $producto['precio_venta'] . '</td>';
                            echo '<td>';
                            echo '<form action="eliminar_producto.php" method="post">';
                            echo '<input type="hidden" name="producto_id" value="' . $producto['producto_id'] . '">';
                            echo '<button class="btn btn-danger" type="submit">Eliminar</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="editar_producto.php?producto_id=' . $producto['producto_id'] . '"><button class="btn btn-warning">Editar</button></a>';

                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Liberamos la memoria del resultado y cerramos la conexión a la base de datos
mysqli_free_result($resultado);
desconectar($conexion);
?>