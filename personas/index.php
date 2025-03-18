<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas de Reportes</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            margin: 5px;
        }
        .button:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Consultas de Reportes</h1>
        <div class="button-container">
            <a href="index.php?report=students" class="button">Reporte de Estudiantes</a>
            <a href="index.php?report=employees" class="button">Reporte de Empleados</a>
            <a href="index.php?report=teachers" class="button">Reporte de Docentes</a>
            <a href="person.html" class="button">Página Principal</a>
        </div>

        <?php
        $host = 'localhost';
        $db = 'softca_db';
        $user = 'root'; // Cambia esto según tu configuración
        $pass = ''; // Cambia esto según tu configuración

        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['report'])) {
            $report = $_GET['report'];
            $table = '';

            switch ($report) {
                case 'students':
                    $table = 'students';
                    break;
                case 'employees':
                    $table = 'employees';
                    break;
                case 'teachers':
                    $table = 'teachers';
                    break;
                default:
                    echo '<p>Reporte no válido.</p>';
                    exit;
            }

            $stmt = $pdo->query("SELECT * FROM $table");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($rows) {
                echo '<table>';
                echo '<thead><tr>';
                foreach (array_keys($rows[0]) as $header) {
                    echo "<th>" . htmlspecialchars($header) . "</th>";
                }
                echo '</tr></thead><tbody>';
                foreach ($rows as $row) {
                    echo '<tr>';
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>No hay datos para mostrar.</p>';
            }
        }
        ?>
    </div>
    
</body>
</html>
