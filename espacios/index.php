<?php
include '../BD/database.php'; // Incluye la conexión a la base de datos

try {
    // La conexión ya está establecida en database.php, no es necesario volver a crearla aquí.
    
    // Consulta para obtener todos los espacios
    $sql = "SELECT * FROM espacios";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error en la conexión o en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Espacios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            position: relative; /* Para el posicionamiento del botón */
            min-height: 80vh; /* Asegura que el contenedor tenga suficiente altura para el botón */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff; /* Azul */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin: 5px 0;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .back-button {
            background-color: #28a745; /* Verde */
            bottom: 20px;
            left: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }
        .back-button:hover {
            background-color: #218838;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        footer {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Administrar Espacios</h1>
    </header>

    <div class="container">
        <a href="add_space.php" class="button">Agregar Espacio</a>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
            <?php
            if (!empty($result)) {
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["capacidad"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tipo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["estado"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["fecha_creacion"]) . "</td>";
                    echo "<td>
                        <a href='edit_space.php?id=" . urlencode($row["id"]) . "' class='button'>Editar</a>
                        <a href='delete_space.php?id=" . urlencode($row["id"]) . "' class='button' style='background-color: #dc3545;'>Eliminar</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron espacios.</td></tr>";
            }
            ?>
        </table>

        <a href="../project-root/index.html" class="back-button">Volver al Menú Principal</a> <!-- Botón para volver al menú principal -->
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Colegio Americano de Barranquilla. Todos los derechos reservados.
    </footer>
</body>
</html>

<?php
// La conexión se cierra automáticamente al finalizar el script, no es necesario hacerlo manualmente con PDO.
?>
