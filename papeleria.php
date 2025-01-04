<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .product-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-size: 1.2em;
            margin: 10px 0;
            color: #555;
        }

        .product-price {
            font-size: 1em;
            color: #28a745;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nuestros Productos</h1>

        <h2>Bebidas</h2>
        <div class="product-list">
            <?php
            // Conexión a la base de datos
            $conn = new mysqli("localhost", "root", "", "inventariodepapeleria");

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT PRODUCTO, precio FROM bebidas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<div class='product-name'>" . $row['PRODUCTO'] . "</div>";
                    echo "<div class='product-price'>\$" . number_format($row['precio'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay bebidas disponibles.</p>";
            }
            ?>
        </div>

        <h2>Comida</h2>
        <div class="product-list">
            <?php
            $sql = "SELECT PRODUCTO, precio FROM comida";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<div class='product-name'>" . $row['PRODUCTO'] . "</div>";
                    echo "<div class='product-price'>\$" . number_format($row['precio'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay comida disponible.</p>";
            }
            ?>

        </div>

        <h2>Electrónica</h2>
        <div class="product-list">
            <?php
            $sql = "SELECT PRODUCTO, precio FROM electronica";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<div class='product-name'>" . $row['PRODUCTO'] . "</div>";
                    echo "<div class='product-price'>\$" . number_format($row['precio'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay productos electrónicos disponibles.</p>";
            }
            ?>
        </div>

        <h2>Papelería</h2>
        <div class="product-list">
            <?php
            $sql = "SELECT PRODUCTO, precio FROM papeleria";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<div class='product-name'>" . $row['PRODUCTO'] . "</div>";
                    echo "<div class='product-price'>\$" . number_format($row['precio'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay productos de papelería disponibles.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <div class="footer">
    &copy; 2025 LEGION CHUU SV.
    </div>
</body>
</html>
