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
$descripcion = isset($_POST['gasto_descripcion']) ? trim($_POST['gasto_descripcion']) : '';
$monto = isset($_POST['gasto_monto']) ? trim($_POST['gasto_monto']) : '';
$fecha = isset($_POST['gasto_fecha']) ? trim($_POST['gasto_fecha']) : '';

// Validar los datos
if (empty($descripcion)) {
    die("La descripción del gasto es obligatoria.");
}

if (!is_numeric($monto) || $monto <= 0) {
    die("El monto debe ser un número positivo.");
}

$fecha_obj = DateTime::createFromFormat('Y-m-d', $fecha);
if (!$fecha_obj || $fecha_obj->format('Y-m-d') !== $fecha) {
    die("Formato de fecha inválido.");
}

// Escapar los datos para prevenir inyecciones SQL
$descripcion = $conn->real_escape_string($descripcion);
$monto = $conn->real_escape_string($monto);
$fecha = $conn->real_escape_string($fecha);

// Consulta para insertar datos
$sql = "INSERT INTO gastos (descripcion, monto, fecha) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular parámetros
$stmt->bind_param("sds", $descripcion, $monto, $fecha);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Gasto registrado exitosamente.";
} else {
    echo "Error al registrar el gasto: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

