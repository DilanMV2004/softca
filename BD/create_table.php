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

// Manejar la creación de la tabla
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_table'])) {
    $tableName = $conn->real_escape_string($_POST['table_name']);
    $columnsCount = (int)$_POST['columns_count'];

    // Generar formulario para definir columnas
    echo "<h1>Definir Columnas para la Tabla: $tableName</h1>";
    echo "<form action='create_table.php' method='post' class='form-container'>";
    echo "<input type='hidden' name='table_name' value='$tableName'>";
    echo "<input type='hidden' name='columns_count' value='$columnsCount'>";

    for ($i = 1; $i <= $columnsCount; $i++) {
        echo "<label for='column_name_$i'>Nombre de la columna $i:</label>";
        echo "<input type='text' id='column_name_$i' name='column_name_$i' required><br><br>";

        echo "<label for='column_type_$i'>Tipo de dato para columna $i:</label>";
        echo "<select id='column_type_$i' name='column_type_$i'>
                <option value='INT'>INT</option>
                <option value='VARCHAR(255)'>VARCHAR(255)</option>
                <option value='TEXT'>TEXT</option>
                <option value='DATE'>DATE</option>
              </select><br><br>";
    }

    echo "<input type='submit' name='submit_columns' value='Crear Tabla' class='btn'>";
    echo "</form>";
}

// Crear la tabla con las columnas definidas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_columns'])) {
    $tableName = $conn->real_escape_string($_POST['table_name']);
    $columnsCount = (int)$_POST['columns_count'];
    $columns = [];

    for ($i = 1; $i <= $columnsCount; $i++) {
        $columnName = $conn->real_escape_string($_POST["column_name_$i"]);
        $columnType = $_POST["column_type_$i"];
        $columns[] = "`$columnName` $columnType"; // Envolver el nombre de la columna en comillas invertidas
    }

    $columnsSql = implode(", ", $columns);
    
    // Verificar si la tabla ya existe
    $checkTableSql = "SHOW TABLES LIKE '$tableName'";
    $result = $conn->query($checkTableSql);

    if ($result->num_rows > 0) {
        echo "<p>La tabla '$tableName' ya existe. Por favor, elige otro nombre.</p>";
    } else {
        $sql = "CREATE TABLE `$tableName` ($columnsSql)";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p>Tabla '$tableName' creada exitosamente.</p>";
        } else {
            echo "<p>Error al crear la tabla: " . $conn->error . "</p>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tabla en MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button, .btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
            width: 100%;
        }

        button:hover, .btn:hover {
            background: #218838;
        }

        .message {
            text-align: center;
            margin: 10px 0;
        }

        .message.success {
            color: #28a745;
        }

        .message.error {
            color: #dc3545;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-container a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
            width: 48%;
            text-align: center;
        }

        .btn-container a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Tabla en MySQL</h1>
        <?php if (!isset($_POST['create_table']) && !isset($_POST['submit_columns'])): ?>
        <form action="" method="post" class="form-container">
            <label for="table_name">Nombre de la tabla:</label><br>
            <input type="text" id="table_name" name="table_name" required><br><br>

            <label for="columns_count">Cantidad de columnas:</label><br>
            <input type="number" id="columns_count" name="columns_count" min="1" required><br><br>

            <input type="submit" name="create_table" value="Definir Columnas" class="btn">
        </form>
        <?php endif; ?>

        <!-- Botones de navegación -->
        <div class="btn-container">
            <a href="../secur/configuracion_sistema.php">Menú Principal</a>
            <a href="../BD/consultar_tablas.php">Consulta de Tablas Creadas</a>
        </div>
    </div>
</body>
</html>

