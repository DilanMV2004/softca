<?php
include '../BD/database.php';

// Verificar si el parámetro 'id' está presente en la solicitud
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el id a un número entero para evitar problemas de seguridad

    // Procesar la actualización del espacio si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger y sanitizar los datos del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $capacidad = intval($_POST['capacidad']);
        $tipo = htmlspecialchars($_POST['tipo']);
        $estado = htmlspecialchars($_POST['estado']);
        $fecha_creacion = htmlspecialchars($_POST['fecha_creacion']);

        try {
            // Preparar la consulta para evitar inyecciones SQL
            $sql = "UPDATE espacios SET nombre = :nombre, capacidad = :capacidad, tipo = :tipo, estado = :estado, fecha_creacion = :fecha_creacion WHERE id = :id";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta
            $stmt->execute([
                ':nombre' => $nombre,
                ':capacidad' => $capacidad,
                ':tipo' => $tipo,
                ':estado' => $estado,
                ':fecha_creacion' => $fecha_creacion,
                ':id' => $id
            ]);

            echo "Espacio actualizado correctamente. <a href='index.php'>Volver a la lista</a>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        $conn = null; // Cerrar la conexión
    } else {
        // Obtener los datos del espacio para el formulario
        try {
            $sql = "SELECT * FROM espacios WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                die("Espacio no encontrado. <a href='index.php'>Volver a la lista</a>");
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
} else {
    die("ID inválido. <a href='index.php'>Volver a la lista</a>");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Espacio</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
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
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button.button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Editar Espacio</h1>
    </header>

    <div class="container">
        <form action="edit_space.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" value="<?php echo htmlspecialchars($row['capacidad']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="abierto" <?php if ($row['tipo'] == 'abierto') echo 'selected'; ?>>Abierto</option>
                    <option value="cerrado" <?php if ($row['tipo'] == 'cerrado') echo 'selected'; ?>>Cerrado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="disponible" <?php if ($row['estado'] == 'disponible') echo 'selected'; ?>>Disponible</option>
                    <option value="reservado" <?php if ($row['estado'] == 'reservado') echo 'selected'; ?>>Reservado</option>
                    <option value="ocupado" <?php if ($row['estado'] == 'ocupado') echo 'selected'; ?>>Ocupado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_creacion">Fecha de Creación:</label>
                <input type="date" id="fecha_creacion" name="fecha_creacion" value="<?php echo htmlspecialchars($row['fecha_creacion']); ?>" required>
            </div>
            <button type="submit" class="button">Actualizar Espacio</button>
        </form>
    </div>
</body>
</html>
