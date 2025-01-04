<html>
<head>
    <title>Registro de Opiniones</title>
</head>
<body>
    <?php
    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "inventariodepapeleria") 
        or die("Problemas con la conexión");

    // Escapar y validar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['NOMBRE']);
    $correo = mysqli_real_escape_string($conexion, $_POST['CORREO']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['TELEFONO']);
    $opinion = mysqli_real_escape_string($conexion, $_POST['OPINION']);
    $mejoras = mysqli_real_escape_string($conexion, $_POST['MEJORAS']);

    // Insertar la opinión en la tabla 'opiniones'
    $query_opinion = "INSERT INTO opiniones (NOMBRE, CORREO, TELEFONO, OPINION, MEJORAS) 
                      VALUES ('$nombre', '$correo', '$telefono', '$opinion', '$mejoras')";
    mysqli_query($conexion, $query_opinion) or die("Error al registrar la opinión: " . mysqli_error($conexion));

    echo "Opinión registrada con éxito.<br>";

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
    <a href="opiniones.html">Regresar al formulario</a>
</body>
</html>
