<?php
// Obtener los datos del formulario
$conexion = mysqli_connect("localhost", "root", "", "inventariodepapeleria") 
    or die("Problemas con la conexión");
$id = mysqli_real_escape_string($conexion, $_POST['ID']);
$categoria = mysqli_real_escape_string($conexion, $_POST['CATEGORIA']); // Obtén la categoría del formulario
$nuevo_producto = isset($_POST['NUEVO_PRODUCTO']) ? mysqli_real_escape_string($conexion, $_POST['NUEVO_PRODUCTO']) : null;
$nuevo_precio = isset($_POST['NUEVO_PRECIO']) ? mysqli_real_escape_string($conexion, $_POST['NUEVO_PRECIO']) : null;
$nuevo_contenido = isset($_POST['NUEVO_CONTENIDO']) ? mysqli_real_escape_string($conexion, $_POST['NUEVO_CONTENIDO']) : null;
$nueva_existencia = isset($_POST['NUEVA_EXISTENCIA']) ? mysqli_real_escape_string($conexion, $_POST['NUEVA_EXISTENCIA']) : null;
$nueva_fechadecad = isset($_POST['NUEVA_FECHADECAD']) ? mysqli_real_escape_string($conexion, $_POST['NUEVA_FECHADECAD']) : null;
$nuevo_numero_serie = isset($_POST['NUEVO_NUMEROSERIE']) ? mysqli_real_escape_string($conexion, $_POST['NUEVO_NUMEROSERIE']) : null;

// Asegurarse de que se ha seleccionado una categoría válida
if (!in_array($categoria, ['bebidas', 'comida', 'electronica', 'papeleria'])) {
    die("Categoría no válida.");
}

// Realizar la consulta para verificar si el producto existe en la categoría seleccionada
$query_verificar = "SELECT * FROM $categoria WHERE ID = '$id'";
$resultado = mysqli_query($conexion, $query_verificar);
if (mysqli_num_rows($resultado) > 0) {
    // Preparar los campos a actualizar
    $campos = [];
    if ($nuevo_producto) $campos[] = "PRODUCTO = '$nuevo_producto'";
    if ($nuevo_precio) $campos[] = "PRECIO = '$nuevo_precio'";
    if ($nuevo_contenido) $campos[] = "CONTENIDO = '$nuevo_contenido'";
    if ($nueva_existencia) $campos[] = "EXISTENCIA = '$nueva_existencia'";

    // Solo agregar FECHADECAD si el producto pertenece a "bebidas" o "comida"
    if (in_array($categoria, ['bebidas', 'comida']) && $nueva_fechadecad) {
        $campos[] = "FECHADECAD = '$nueva_fechadecad'";
    }

    // Solo agregar NUMEROSERIE si el producto pertenece a "electronica" o "papeleria"
    if (in_array($categoria, ['electronica', 'papeleria']) && $nuevo_numero_serie) {
        $campos[] = "NUMEROSERIE = '$nuevo_numero_serie'";
    }

    // Actualizar los datos del producto si hay campos a modificar
    if (!empty($campos)) {
        $query_actualizar = "UPDATE $categoria SET " . implode(", ", $campos) . " WHERE ID = '$id'";
        if (mysqli_query($conexion, $query_actualizar)) {
            echo "Producto actualizado con éxito.";
        } else {
            die("Error al actualizar los datos: " . mysqli_error($conexion));
        }
    } else {
        echo "No se especificaron cambios.";
    }
} else {
    echo "Producto no encontrado en la categoría seleccionada.";
}

mysqli_close($conexion);

?>
<a href="formulario.html">Regresar al formulario</a>
