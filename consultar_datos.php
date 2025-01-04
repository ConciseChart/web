<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "inventariodepapeleria") 
    or die("Problemas con la conexión");

// Obtener los datos del formulario
$categoria = isset($_GET['CATEGORIA']) ? mysqli_real_escape_string($conexion, $_GET['CATEGORIA']) : '';
$id = isset($_GET['ID']) ? intval($_GET['ID']) : 0; // Convertir ID a un entero

// Validar que se seleccionó una categoría
if (empty($categoria)) {
    die("Por favor, selecciona una categoría.");
}

// Crear la consulta según la categoría y el ID
if ($id > 0) {
    // Si se proporciona un ID, filtrar también por ID
    if ($categoria === "bebidas") {
        $query = "SELECT * FROM bebidas WHERE ID = $id";
    } elseif ($categoria === "comida") {
        $query = "SELECT * FROM comida WHERE ID = $id";
    } elseif ($categoria === "electronica") {
        $query = "SELECT * FROM electronica WHERE ID = $id";
    } elseif ($categoria === "papeleria") {
        $query = "SELECT * FROM papeleria WHERE ID = $id";
    } else {
        die("Categoría no válida.");
    }
} else {
    // Si no se proporciona un ID, mostrar todos los productos de la categoría
    if ($categoria === "bebidas") {
        $query = "SELECT * FROM bebidas";
    } elseif ($categoria === "comida") {
        $query = "SELECT * FROM comida";
    } elseif ($categoria === "electronica") {
        $query = "SELECT * FROM electronica";
    } elseif ($categoria === "papeleria") {
        $query = "SELECT * FROM papeleria";
    } else {
        die("Categoría no válida.");
    }
}

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query) or die("Error al consultar los datos: " . mysqli_error($conexion));

// Mostrar los datos
echo "<h1>Productos en la categoría '$categoria'</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Existencia</th>";
if ($categoria === "bebidas") {
    echo "<th>Contenido</th>";
} elseif ($categoria === "comida") {
    echo "<th>Fecha de Caducidad</th>";
} elseif ($categoria === "electronica" || $categoria === "papeleria") {
    echo "<th>Número de Serie</th>";
}
echo "</tr>";

// Mostrar los datos en la tabla
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$fila['ID']}</td>
                <td>{$fila['PRODUCTO']}</td>
                <td>{$fila['PRECIO']}</td>
                <td>{$fila['EXISTENCIA']}</td>";
        if ($categoria === "bebidas") {
            echo "<td>{$fila['CONTENIDO']}</td>";
        } elseif ($categoria === "comida") {
            echo "<td>{$fila['FECHADECAD']}</td>";
        } elseif ($categoria === "electronica" || $categoria === "papeleria") {
            echo "<td>{$fila['NUMEROSERIE']}</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
}
echo "</table>";

mysqli_close($conexion);
?>
<a href="formulario.html">Regresar al formulario</a>
