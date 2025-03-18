<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "my_school_app";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir y validar los datos del formulario
$nombre_colegio = isset($_POST['nombre_colegio']) ? trim($_POST['nombre_colegio']) : '';
$direccion_colegio = isset($_POST['direccion_colegio']) ? trim($_POST['direccion_colegio']) : '';
$telefono_colegio = isset($_POST['telefono_colegio']) ? trim($_POST['telefono_colegio']) : '';
$email_colegio = isset($_POST['email_colegio']) ? trim($_POST['email_colegio']) : '';

// Validar los datos
if (empty($nombre_colegio) || empty($direccion_colegio) || empty($telefono_colegio) || empty($email_colegio)) {
    die("Todos los campos son obligatorios.");
}

if (!filter_var($email_colegio, FILTER_VALIDATE_EMAIL)) {
    die("Correo electrónico inválido.");
}

// Escapar los datos para prevenir inyecciones SQL
$nombre_colegio = $conn->real_escape_string($nombre_colegio);
$direccion_colegio = $conn->real_escape_string($direccion_colegio);
$telefono_colegio = $conn->real_escape_string($telefono_colegio);
$email_colegio = $conn->real_escape_string($email_colegio);

// Consulta para insertar datos
$sql = "INSERT INTO datos_institucionales (nombre_colegio, direccion_colegio, telefono_colegio, email_colegio) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("ssss", $nombre_colegio, $direccion_colegio, $telefono_colegio, $email_colegio);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Datos institucionales actualizados exitosamente.";
} else {
    echo "Error al actualizar los datos institucionales: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
