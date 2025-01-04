<html>
<head>
    <title>Registro de Productos</title>
</head>
<body>
    <?php
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "inventariodepapeleria") 
        or die("Problemas con la conexión");

    // Escapar y validar los datos
    $producto = mysqli_real_escape_string($conexion, $_POST['PRODUCTO']);
    $precio = mysqli_real_escape_string($conexion, $_POST['PRECIO']);
    $contenido = isset($_POST['CONTENIDO']) ? mysqli_real_escape_string($conexion, $_POST['CONTENIDO']) : null;
    $fecha_decad = isset($_POST['FECHADECAD']) ? mysqli_real_escape_string($conexion, $_POST['FECHADECAD']) : null;
    $existencia = mysqli_real_escape_string($conexion, $_POST['EXISTENCIA']);
    $numeroserie = isset($_POST['NUMEROSERIE']) ? mysqli_real_escape_string($conexion, $_POST['NUMEROSERIE']) : null;
    $categoria = mysqli_real_escape_string($conexion, $_POST['CATEGORIA']);

    // Insertar en la tabla correspondiente
    if ($categoria === "bebidas") {
        if (!empty($contenido)) {
            $query_bebidas = "INSERT INTO bebidas (PRODUCTO, PRECIO, CONTENIDO, EXISTENCIA) 
                              VALUES ('$producto', '$precio', '$contenido', '$existencia')";
            mysqli_query($conexion, $query_bebidas) or die("Error al insertar en bebidas: " . mysqli_error($conexion));
            echo "Producto registrado en la categoría 'Bebidas'.<br>";
        } else {
            echo "Error: El campo 'Contenido' es obligatorio para bebidas.<br>";
        }
    } elseif ($categoria === "comida") {
        if (!empty($fecha_decad)) {
            $query_comida = "INSERT INTO comida (PRODUCTO, PRECIO, `FECHA DE CAD`, EXISTENCIA) 
                             VALUES ('$producto', '$precio', '$fecha_decad', '$existencia')";
            mysqli_query($conexion, $query_comida) or die("Error al insertar en comida: " . mysqli_error($conexion));
            echo "Producto registrado en la categoría 'Comida'.<br>";
        } else {
            echo "Error: El campo 'Fecha de Caducidad' es obligatorio para comida.<br>";
        }
    } elseif ($categoria === "electronica") {
        if (!empty($numeroserie)) {
            $query_electronica = "INSERT INTO electronica (PRODUCTO, PRECIO, NUMEROSERIE, EXISTENCIA) 
                                  VALUES ('$producto', '$precio', '$numeroserie', '$existencia')";
            mysqli_query($conexion, $query_electronica) or die("Error al insertar en electrónica: " . mysqli_error($conexion));
            echo "Producto registrado en la categoría 'Electrónica'.<br>";
        } else {
            echo "Error: El campo 'Número de Serie' es obligatorio para electrónica.<br>";
        }
    } elseif ($categoria === "papeleria") {
        if (!empty($numeroserie)) {
            $query_Papelería = "INSERT INTO papeleria (PRODUCTO, PRECIO, NUMEROSERIE, EXISTENCIA) 
                                VALUES ('$producto', '$precio', '$numeroserie', '$existencia')";
            mysqli_query($conexion, $query_Papelería) or die("Error al insertar en Papelería: " . mysqli_error($conexion));
            echo "Producto registrado en la categoría 'Artículos de Papelería'.<br>";
        } else {
            echo "Error: El campo 'Número de Serie' es obligatorio para artículos de Papelería.<br>";
        }
    } else {
        echo "Error: Categoría no válida.<br>";
    }

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
    <a href="formulario.html">Regresar al formulario</a>
</body>
</html>
