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
$presupuesto_anual = isset($_POST['presupuesto_anual']) ? trim($_POST['presupuesto_anual']) : '';
$presupuesto_departamento = isset($_POST['presupuesto_departamento']) ? trim($_POST['presupuesto_departamento']) : '';

// Validar los datos
if (!is_numeric($presupuesto_anual) || $presupuesto_anual < 0) {
    die("El presupuesto anual debe ser un número positivo.");
}

if (!is_numeric($presupuesto_departamento) || $presupuesto_departamento < 0) {
    die("El presupuesto del departamento debe ser un número positivo.");
}

// Escapar los datos para prevenir inyecciones SQL
$presupuesto_anual = $conn->real_escape_string($presupuesto_anual);
$presupuesto_departamento = $conn->real_escape_string($presupuesto_departamento);

// Consulta para insertar datos
$sql = "INSERT INTO presupuestos (presupuesto_anual, presupuesto_departamento) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("dd", $presupuesto_anual, $presupuesto_departamento);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Presupuesto guardado exitosamente.";
} else {
    echo "Error al guardar el presupuesto: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>


