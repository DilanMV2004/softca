<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "softca_db"; // Cambia esto según tu configuración

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir y validar los datos del formulario
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$nivel = isset($_POST['nivel']) ? trim($_POST['nivel']) : '';




// Consulta para insertar datos
$sql = "INSERT INTO niveles (id, nivel,) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("sds", $id, $nivel);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "nivel registrado exitosamente.";
} else {
    echo "Error al registrar el nivel: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
