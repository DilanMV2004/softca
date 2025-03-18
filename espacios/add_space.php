<?php
include '../BD/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $capacidad = intval($_POST['capacidad']);
    $tipo = htmlspecialchars($_POST['tipo']);
    $estado = htmlspecialchars($_POST['estado']);
    $fecha_creacion = htmlspecialchars($_POST['fecha_creacion']);

    // Preparar la consulta para evitar inyecciones SQL
    $sql = "INSERT INTO espacios (nombre, capacidad, tipo, estado, fecha_creacion)
            VALUES (:nombre, :capacidad, :tipo, :estado, :fecha_creacion)";

    $stmt = $conn->prepare($sql);

    // Ejecutar la consulta
    if ($stmt->execute([
        ':nombre' => $nombre,
        ':capacidad' => $capacidad,
        ':tipo' => $tipo,
        ':estado' => $estado,
        ':fecha_creacion' => $fecha_creacion
    ])) {
        echo "Nuevo espacio agregado correctamente. <a href='index.php'>Volver a la lista</a>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $conn = null; // Cerrar la conexión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Espacio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #003366; /* Azul oscuro */
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 20px;
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
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[type="date"] {
            padding: 10px;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .message {
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Agregar Nuevo Espacio</h1>
    </header>

    <div class="container">
        <form action="add_space.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="abierto">Abierto</option>
                    <option value="cerrado">Cerrado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="disponible">Disponible</option>
                    <option value="reservado">Reservado</option>
                    <option value="ocupado">Ocupado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_creacion">Fecha de Creación:</label>
                <input type="date" id="fecha_creacion" name="fecha_creacion" required>
            </div>
            <button type="submit" class="button">Agregar Espacio</button>
        </form>
    </div>
</body>
</html>

