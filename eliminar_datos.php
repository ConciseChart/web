<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "inventariodepapeleria") 
    or die("Problemas con la conexión");

// Obtener el ID del producto
$id = mysqli_real_escape_string($conexion, $_POST['ID']);

// Determinar a qué tabla pertenece el producto
$categorias = ['bebidas', 'comida', 'electronica', 'papeleria'];
foreach ($categorias as $categoria) {
    $query_verificar = "SELECT * FROM $categoria WHERE ID = '$id'";
    $resultado = mysqli_query($conexion, $query_verificar);
    if (mysqli_num_rows($resultado) > 0) {
        $tabla = $categoria;
        break;
    }
}

if (!isset($tabla)) {
    die("Producto no encontrado.");
}

// Eliminar el producto
$query_eliminar = "DELETE FROM $tabla WHERE ID = '$id'";
mysqli_query($conexion, $query_eliminar) or die("Error al eliminar el producto: " . mysqli_error($conexion));
echo "Producto eliminado con éxito.";

mysqli_close($conexion);
?>
<a href="formulario.html">Regresar al formulario</a>
