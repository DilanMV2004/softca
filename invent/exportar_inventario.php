<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Cambia esto por tu contraseña de base de datos
$dbname = "my_school_app";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los datos del inventario
$sql = "SELECT * FROM inventario";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Encabezado para exportar el archivo a Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Inventario_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Crear los encabezados de la tabla
    echo "Codigo\tTipo de Equipo\tMarca\tSerial\tResponsable\tUbicacion\tEspecificaciones\tObservaciones\tFecha de Ingreso\tGarantia\tFecha de Validación\tEstado\n";

    // Iterar sobre los resultados para crear las filas
    while ($row = $result->fetch_assoc()) {
        echo $row["codigo"] . "\t" . $row["tipo_equipo"] . "\t" . $row["marca"] . "\t" . $row["serial"] . "\t" . $row["responsable"] . "\t" . $row["ubicacion"] . "\t" . $row["especificaciones"] . "\t" . $row["observaciones"] . "\t" . $row["fecha_ingreso"] . "\t" . $row["garantia"] . "\t" . $row["fecha_validacion"] . "\t" . $row["estado"] . "\n";
    }
} else {
    echo "No hay datos disponibles para exportar.";
}

// Cerrar conexión
$conn->close();
?>
    