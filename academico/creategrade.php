<?php
// Configuración de la base de datos
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'createUser') {
    $grado = $_POST['grado'];
   

    $sql = "INSERT INTO grados (grado) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nivel);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Nivel creado exitosamente."]);
        echo "<script>alert('grado creado exitosamente.');</script>";
        header("Location: configuracion_academica.php");
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nivel</title>
    <style>
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 30px;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #07046E;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header-container {
            background-color: #07046E;
            color: white;
            padding: 0px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .header-container h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .form {
            margin-bottom: 10px;
            text-align: center;
        }
        .form label {
            color: white;
        }
        button {
            background-color: rgb(255, 107, 8);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        h1 {
            color: white;
        }
        button:hover {
            background-color: rgb(255, 94, 0);
        }
        footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="../img/logo-cumpleanos2.png" width="390" height="100"  />
            <h1 >Modulo de Creacion de Grados</h1>
        </header>
        <form action="creategrade.php" method="post">
            <input type="hidden" name="action" value="createUser">
            <div class="form">
            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" required>
            <button type="submit">Crear Grado</button>
            </div>
        </form>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="configuracion_academica.php">
            <button>Volver</button>
        </a>
    </div>
    <footer>
        <p>&copy; 2025 Colegio Americano de Barranquilla</p>
    </footer>
</body>
</html>