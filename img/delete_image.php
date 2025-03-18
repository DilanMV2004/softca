<?php
// Configuración de conexión a la base de datos
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

// Verificar si se recibió un ID válido
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = (int)$_POST['id'];

// Consulta para verificar si la imagen existe antes de eliminarla
$check_sql = "SELECT nombre FROM imagenes WHERE id = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("i", $id);  // Asegúrate de que aquí coincida "i" con el parámetro de la consulta.
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // La imagen existe, proceder con la eliminación
    $stmt->bind_result($nombre);  // Solo necesitas vincular una variable aquí (nombre)
    $stmt->fetch();

    // Consulta para eliminar la imagen
    $delete_sql = "DELETE FROM imagenes WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id);  // Solo se requiere un parámetro aquí

    if ($delete_stmt->execute()) {
        // Redirigir con un mensaje de éxito
        header("Location: index.php?status=success&message=Imagen eliminada exitosamente.");
    } else {
        // Redirigir con un mensaje de error
        header("Location: index.php?status=error&message=Error al eliminar la imagen.");
    }

    $delete_stmt->close();
} else {
    // Redirigir con un mensaje si la imagen no existe
    header("Location: index.php?status=error&message=La imagen no existe o ya fue eliminada.");
}

$stmt->close();
} else {
    // Redirigir con un mensaje si el ID no es válido
    header("Location: index.php?status=error&message=ID de imagen no válido.");
}

// Cerrar conexión
$conn->close();
exit();
?>


