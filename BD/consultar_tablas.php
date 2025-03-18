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
    <title>Consulta de Tablas</title>
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
    <h1>Consulta de Tablas en la Base de Datos</h1>

    <form method="post" action="">
        <label for="table">Selecciona una tabla:</label>
        <select name="table" id="table">
            <?php foreach ($tables as $table): ?>
                <option value="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($table) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="Consultar">
    </form>

    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table']) && in_array($_POST['table'], $tables)) {
        $table = $_POST['table'];
        $sql = "SELECT * FROM `$table`"; 
        
        try {
            $stmt = $conn->query($sql);
            if ($stmt->rowCount() > 0) {
                echo "<h2>Resultados de la tabla: " . htmlspecialchars($table) . "</h2>";
                echo "<table>";
                echo "<tr>";

                // Obtener los nombres de las columnas
                $columnCount = $stmt->columnCount();
                for ($i = 0; $i < $columnCount; $i++) {
                    $columnMeta = $stmt->getColumnMeta($i);
                    echo "<th>" . htmlspecialchars($columnMeta['name']) . "</th>";
                }
                echo "<th>Acciones</th>"; // Columna para botones de acción
                echo "</tr>";

                // Mostrar los resultados
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($row as $key => $data) {
                        echo "<td>" . htmlspecialchars($data) . "</td>";
                    }
                    echo "<td>";
                    echo "<a href='?edit=" . $row['id'] . "&table=" . htmlspecialchars($table) . "'>Editar</a> | ";
                    echo "<a href='?delete=" . $row['id'] . "&table=" . htmlspecialchars($table) . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este registro?\");'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontraron datos en la tabla seleccionada.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Error al consultar la tabla: " . $e->getMessage() . "</p>";
        }
    }

    // Manejar la eliminación de registros
    if (isset($_GET['delete']) && isset($_GET['table'])) {
        $id = $_GET['delete'];
        $table = $_GET['table'];

        try {
            $stmt = $conn->prepare("DELETE FROM `$table` WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<p>Registro eliminado correctamente.</p>";
        } catch (PDOException $e) {
            echo "<p>Error al eliminar el registro: " . $e->getMessage() . "</p>";
        }
    }

    // Manejar la edición de registros
    if (isset($_GET['edit']) && isset($_GET['table'])) {
        $id = $_GET['edit'];
        $table = $_GET['table'];

        try {
            $stmt = $conn->prepare("SELECT * FROM `$table` WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<h2>Editar Registro</h2>";
            echo "<form method='post' action=''>";
            foreach ($record as $key => $value) {
                echo "<label for='$key'>$key:</label>";
                echo "<input type='text' name='$key' value='" . htmlspecialchars($value) . "'><br>";
            }
            echo "<input type='hidden' name='table' value='" . htmlspecialchars($table) . "'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>";
            echo "<input type='submit' name='update' value='Actualizar'>";
            echo "</form>";
        } catch (PDOException $e) {
            echo "<p>Error al obtener el registro para editar: " . $e->getMessage() . "</p>";
        }
    }

    // Manejar la actualización de registros
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && isset($_POST['table']) && isset($_POST['id'])) {
        $table = $_POST['table'];
        $id = $_POST['id'];

        $updateFields = [];
        foreach ($_POST as $key => $value) {
            if ($key != 'update' && $key != 'table' && $key != 'id') {
                $updateFields[] = "`$key` = :$key";
            }
        }

        $sql = "UPDATE `$table` SET " . implode(', ', $updateFields) . " WHERE id = :id";

        try {
            $stmt = $conn->prepare($sql);

            foreach ($_POST as $key => $value) {
                if ($key != 'update' && $key != 'table' && $key != 'id') {
                    $stmt->bindValue(":$key", $value);
                }
            }

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<p>Registro actualizado correctamente.</p>";
        } catch (PDOException $e) {
            echo "<p>Error al actualizar el registro: " . $e->getMessage() . "</p>";
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
