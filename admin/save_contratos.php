<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "softca_db"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir y validar los datos del formulario
$tipo_contrato = isset($_POST['contrato_tipo']) ? trim($_POST['contrato_tipo']) : '';
$fecha_inicio = isset($_POST['contrato_fecha_inicio']) ? trim($_POST['contrato_fecha_inicio']) : '';
$fecha_fin = isset($_POST['contrato_fecha_fin']) ? trim($_POST['contrato_fecha_fin']) : '';

// Validar los datos
$valid_tipo_contrato = ['docente', 'administrativo', 'servicios'];

if (!in_array($tipo_contrato, $valid_tipo_contrato)) {
    die("Tipo de contrato inválido.");
}

if (empty($fecha_inicio) || empty($fecha_fin)) {
    die("Las fechas de inicio y fin son obligatorias.");
}

$fecha_inicio_obj = DateTime::createFromFormat('Y-m-d', $fecha_inicio);
$fecha_fin_obj = DateTime::createFromFormat('Y-m-d', $fecha_fin);

if (!$fecha_inicio_obj || !$fecha_fin_obj) {
    die("Formato de fecha inválido.");
}

if ($fecha_inicio_obj > $fecha_fin_obj) {
    die("La fecha de inicio no puede ser posterior a la fecha de fin.");
}

// Escapar los datos para prevenir inyecciones SQL
$tipo_contrato = $conn->real_escape_string($tipo_contrato);
$fecha_inicio = $conn->real_escape_string($fecha_inicio);
$fecha_fin = $conn->real_escape_string($fecha_fin);

// Consulta para insertar datos
$sql = "INSERT INTO contratos (tipo_contrato, fecha_inicio, fecha_fin) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("sss", $tipo_contrato, $fecha_inicio, $fecha_fin);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Contrato guardado exitosamente.";
} else {
    echo "Error al guardar el contrato: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

