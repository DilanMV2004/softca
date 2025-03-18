<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softca_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todas las tablas de la base de datos
$tablesResult = $conn->query("SHOW TABLES");
$tables = [];
while ($row = $tablesResult->fetch_array()) {
    $tables[] = $row[0];
}

// Manejar la inserción de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insert_data'])) {
    $tableName = $_POST['table_name'];
    $columnsResult = $conn->query("SHOW COLUMNS FROM $tableName");
    $columns = [];
    while ($row = $columnsResult->fetch_assoc()) {
        $columns[] = $row['Field'];
    }

    $values = [];
    foreach ($columns as $column) {
        $values[] = "'" . $_POST[$column] . "'";
    }
    $valuesSql = implode(", ", $values);

    $sql = "INSERT INTO $tableName (" . implode(", ", $columns) . ") VALUES ($valuesSql)";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Datos insertados exitosamente en la tabla '$tableName'.</p>";
    } else {
        echo "<p>Error al insertar los datos: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Datos en MySQL</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function fetchColumns(table) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "insert_data.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                document.getElementById("columns_form").innerHTML = this.responseText;
            };
            xhr.send("table_name=" + table);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Insertar Datos en MySQL</h1>
        <form action="insert_data.php" method="post" class="form-container">
            <label for="table_name">Selecciona la tabla:</label><br>
            <select id="table_name" name="table_name" onchange="fetchColumns(this.value)" required>
                <option value="">Seleccione...</option>
                <?php foreach ($tables as $table): ?>
                    <option value="<?= $table ?>"><?= $table ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <div id="columns_form">
                <!-- Campos de columnas se cargarán aquí -->
            </div>

            <input type="submit" name="insert_data" value="Insertar Datos" class="btn">
        </form>
    </div>
</body>
</html>

