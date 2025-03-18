<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto por tu contraseña de base de datos
$dbname = "my_school_app";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los datos del inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Inventario</title>
    <style>
        body {
            font-family: 'Arial', Tahoma, 'Times New Roman', Times, serif, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        header {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
        }
        footer {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
            position: relative;
            bottom: 0;
        }
        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
            max-width: 95%;
            margin-top: 20px;
            width: 100%;
            overflow-x: auto; /* Permitir desplazamiento horizontal si es necesario */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 14px; /* Ajusta el tamaño de la fuente de la tabla */
        }
        table, th, td {
            border: 1px solid #003366;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #00509e; /* Azul más claro */
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #e8f1ff; /* Color al pasar el ratón */
        }
        .edit-button {
            background-color: #00509e;
            color: white;
            border: none;
            padding: 7px 15px;
            text-align: center;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }
        .edit-button:hover {
            background-color: #003366;
        }
        .action-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .export-button {
            background-color: #28a745; /* Color verde */
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .export-button:hover {
            background-color: #218838;
        }
        .back-link {
            text-align: right;
            margin-top: 20px;
        }
        .back-link a {
            color: white;
            background-color: #00509e;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
        .back-link a:hover {
            background-color: #003366;
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/logo-cumpleanos2.png" width="390" height="115" alt="Logo"/>
        <h1>Consulta de Inventario</h1>
    </header>

    <div class="container">
        <div class="action-container">
            <h2>Datos del Inventario</h2>
            <form action="exportar_inventario.php" method="post">
                <button type="submit" class="export-button">Exportar a Excel</button>
            </form>
        </div>

        <?php
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Mostrar datos en una tabla
            echo "<table>";
            echo "<tr><th>Código</th><th>Tipo de Equipo</th><th>Marca</th><th>Serial</th><th>Responsable</th><th>Ubicación</th><th>Especificaciones</th><th>Observaciones</th><th>Fecha de Ingreso</th><th>Garantía</th><th>Fecha de Validación</th><th>Estado</th><th>Acciones</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["codigo"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tipo_equipo"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["marca"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["serial"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["responsable"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ubicacion"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["especificaciones"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["observaciones"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["fecha_ingreso"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["garantia"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["fecha_validacion"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["estado"]) . "</td>";
                echo "<td><a href='editar_inventario.php?id=" . urlencode($row["id"]) . "' class='edit-button'>Editar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }

        // Cerrar conexión
        $conn->close();
        ?>

        <div class="back-link">
            <a href="index.php">Volver a la página de registro</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

        