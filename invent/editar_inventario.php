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

// Verificar si se ha enviado un ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consultar los datos del inventario para el ID proporcionado
    $sql = "SELECT * FROM inventario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    die("ID no proporcionado.");
}

// Actualizar los datos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $tipo_equipo = $_POST['tipo_equipo'];
    $marca = $_POST['marca'];
    $serial = $_POST['serial'];
    $responsable = $_POST['responsable'];
    $ubicacion = $_POST['ubicacion'];
    $especificaciones = $_POST['especificaciones'];
    $observaciones = $_POST['observaciones'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $garantia = $_POST['garantia'];
    $fecha_validacion = $_POST['fecha_validacion'];
    $estado = $_POST['estado'];

    // Actualizar los datos del inventario
    $sql = "UPDATE inventario SET codigo=?, tipo_equipo=?, marca=?, serial=?, responsable=?, ubicacion=?, especificaciones=?, observaciones=?, fecha_ingreso=?, garantia=?, fecha_validacion=?, estado=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $codigo, $tipo_equipo, $marca, $serial, $responsable, $ubicacion, $especificaciones, $observaciones, $fecha_ingreso, $garantia, $fecha_validacion, $estado, $id);
    if ($stmt->execute()) {
        echo "<p>Datos actualizados con éxito.</p>";
    } else {
        echo "<p>Error al actualizar los datos: " . $stmt->error . "</p>";
    }
}

// Obtener los estados disponibles para el menú desplegable
$estadoSql = "SELECT * FROM estado_inventario";
$estadoResult = $conn->query($estadoSql);
$estados = [];
while ($estadoRow = $estadoResult->fetch_assoc()) {
    $estados[] = $estadoRow;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <style>
        body {
            font-family: 'Arial', Tahoma, 'Times New Roman', Times, serif, Verdana, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            padding: 15px;
            text-align: center;
        }
        footer {
            background-color: #07046E; /* Azul oscuro */
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .container {
            flex: 1;
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-color: #ffffff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea, select {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        .button-container {
            text-align: center;
        }
        .submit-button {
            background-color: #00509e;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .submit-button:hover {
            background-color: #003366;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #003366;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <img src="../img/logo-cumpleanos2.png" width="390" height="115" alt="Logo"/>
        <h1>Editar Inventario</h1>
    </header>

    <div class="container">
        <form action="" method="post">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo htmlspecialchars($row['codigo']); ?>" required>

            <label for="tipo_equipo">Tipo de Equipo:</label>
            <input type="text" id="tipo_equipo" name="tipo_equipo" value="<?php echo htmlspecialchars($row['tipo_equipo']); ?>" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($row['marca']); ?>" required>

            <label for="serial">Serial:</label>
            <input type="text" id="serial" name="serial" value="<?php echo htmlspecialchars($row['serial']); ?>" required>

            <label for="responsable">Responsable:</label>
            <input type="text" id="responsable" name="responsable" value="<?php echo htmlspecialchars($row['responsable']); ?>" required>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" value="<?php echo htmlspecialchars($row['ubicacion']); ?>" required>

            <label for="especificaciones">Especificaciones:</label>
            <textarea id="especificaciones" name="especificaciones"><?php echo htmlspecialchars($row['especificaciones']); ?></textarea>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones"><?php echo htmlspecialchars($row['observaciones']); ?></textarea>

            <label for="fecha_ingreso">Fecha de Ingreso:</label>
            <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($row['fecha_ingreso']); ?>" required>

            <label for="garantia">Garantía:</label>
            <input type="text" id="garantia" name="garantia" value="<?php echo htmlspecialchars($row['garantia']); ?>" required>

            <label for="fecha_validacion">Fecha de Validación:</label>
            <input type="date" id="fecha_validacion" name="fecha_validacion" value="<?php echo htmlspecialchars($row['fecha_validacion']); ?>" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo htmlspecialchars($estado['estado']); ?>"
                        <?php echo $estado['estado'] == $row['estado'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($estado['estado']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="button-container">
                <input type="submit" value="Actualizar" class="submit-button">
            </div>
        </form>

        <div class="back-link">
            <a href="consultar_inventario.php">Volver a la consulta de inventario</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>

