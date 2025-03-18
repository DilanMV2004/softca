<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softca_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_documento = $_POST["doc_type"];
    $numero_documento = $_POST["doc_number"];
    $primer_nombre = $_POST["first_name"];
    $segundo_nombre = $_POST["second_name"];
    $primer_apellido = $_POST["last_name"];
    $segundo_apellido = $_POST["second_last_name"];
    $lugar_nacimiento = $_POST["birth_place"];
    $fecha_nacimiento = $_POST["birth_date"];
    $sexo = $_POST["sex"];
    $fecha_ingreso = $_POST["admission_date"];
    $cargo = $_POST["position"];

    $sql = "INSERT INTO empleado (tipo_documento, numero_documento, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, lugar_nacimiento, fecha_nacimiento, sexo, fecha_ingreso, cargo)
    VALUES ('$tipo_documento', '$numero_documento', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$lugar_nacimiento', '$fecha_nacimiento', '$sexo', '$fecha_ingreso', '$cargo')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Nuevo empleado registrado exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado - Colegio Americano de Barranquilla</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Empleados</h1>
        <?php if (isset($mensaje)): ?>
            <p class="message <?php echo isset($conn->error) ? 'error' : ''; ?>">
                <?php echo $mensaje; ?>
            </p>
        <?php endif; ?>
        <form method="POST" action="registrar_empleado.php">
            <div class="form-group">
                <label for="doc_type">Tipo Documento:</label>
                <select id="doc_type" name="doc_type">
                    <option value="Carnet">Carnet</option>
                    <option value="Cedula de ciudadania">Cédula de ciudadanía</option>
                    <option value="Cedula extranjera">Cédula extranjera</option>
                    <option value="Contraseña">Contraseña</option>
                    <option value="Nit">Nit</option>
                    <option value="Pasaporte">Pasaporte</option>
                    <option value="PEP">PEP</option>
                    <option value="PPT">PPT</option>
                    <option value="Registro civil">Registro civil</option>
                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                    <option value="VISA">VISA</option>
                </select>
            </div>
            <div class="form-group">
                <label for="doc_number">Doc. Empleado:</label>
                <input type="text" id="doc_number" name="doc_number" placeholder="123456789" required>
            </div>
            <div class="form-group">
                <label for="first_name">Primer Nombre:</label>
                <input type="text" id="first_name" name="first_name" placeholder="WILLIAM" required>
            </div>
            <div class="form-group">
                <label for="second_name">Segundo Nombre:</label>
                <input type="text" id="second_name" name="second_name" placeholder="DAVID">
            </div>
            <div class="form-group">
                <label for="last_name">Primer Apellido:</label>
                <input type="text" id="last_name" name="last_name" placeholder="ABDALA" required>
            </div>
            <div class="form-group">
                <label for="second_last_name">Segundo Apellido:</label>
                <input type="text" id="second_last_name" name="second_last_name" placeholder="LOPEZ">
            </div>
            <div class="form-group">
                <label for="birth_place">Lugar de Nacimiento:</label>
                <input type="text" id="birth_place" name="birth_place" placeholder="Barranquilla" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Fecha de Nacimiento:</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>
            <div class="form-group">
                <label for="sex">Sexo:</label>
                <select id="sex" name="sex">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="form-group">
                <label for="admission_date">Fecha de Ingreso:</label>
                <input type="date" id="admission_date" name="admission_date" required>
            </div>
            <div class="form-group">
                <label for="position">Cargo:</label>
                <input type="text" id="position" name="position" placeholder="Cargo" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button">Registrar Empleado</button>
            </div>
        </form>
        <div class="button-container">
        <a href="person.php" class="button">Página Principal</a>
        </div>
    </div>
</body>
</html>

