<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softca_db";

try {
    // Crear conexión usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO para lanzar excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener las tablas
    $tables = [];
    $stmt = $conn->query("SHOW TABLES");
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Registro</title>
    <style>
        /* Tus estilos aquí */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        form {
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-size: 18px;
            margin-right: 10px;
        }
        select, input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-container a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 0 10px;
            text-align: center;
        }
        .btn-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Insertar Nuevo Registro</h1>

    <form method="post" action="">
        <label for="table">Selecciona una tabla:</label>
        <select name="table" id="table" onchange="this.form.submit()">
            <option value="">Selecciona una tabla</option>
            <?php foreach ($tables as $table): ?>
                <option value="<?= htmlspecialchars($table) ?>" <?= isset($_POST['table']) && $_POST['table'] === $table ? 'selected' : '' ?>>
                    <?= htmlspecialchars($table) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table']) && in_array($_POST['table'], $tables)) {
        $table = $_POST['table'];
        
        // Obtener columnas de la tabla seleccionada
        $stmt = $conn->query("DESCRIBE `$table`");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Mostrar formulario para insertar datos
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
        
        foreach ($columns as $column) {
            echo "<label for='$column'>$column:</label>";
            echo "<input type='text' name='$column' id='$column'><br>";
        }

        echo "<input type='submit' name='insert' value='Insertar'>";
        echo "</form>";
    }

    // Manejar la inserción de datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert']) && isset($_POST['table'])) {
        $table = $_POST['table'];
        $fields = [];
        $values = [];

        foreach ($_POST as $key => $value) {
            if ($key != 'insert' && $key != 'table') {
                $fields[] = "`$key`";
                $values[] = ":$key";
            }
        }

        $sql = "INSERT INTO `$table` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ")";

        try {
            $stmt = $conn->prepare($sql);

            foreach ($_POST as $key => $value) {
                if ($key != 'insert' && $key != 'table') {
                    $stmt->bindValue(":$key", $value);
                }
            }

            $stmt->execute();

            echo "<p>Registro insertado correctamente en la tabla " . htmlspecialchars($table) . ".</p>";
        } catch (PDOException $e) {
            echo "<p>Error al insertar el registro: " . $e->getMessage() . "</p>";
        }
    }

    $conn = null; // Cerrar la conexión
    ?>

    <!-- Botones de navegación -->
    <div class="btn-container">
        <a href="../secur/seguridad.php">Menú Principal</a>
        <a href="../BD/consultar_tablas.php">Consulta de Tablas Creadas</a>
        <a href="insertar.php">Insertar Nuevo Registro</a>
    </div>
</body>
</html>
