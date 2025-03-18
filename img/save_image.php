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

// Verificar si se ha subido un archivo
if (isset($_FILES['imagen']['tmp_name'])) {
    $nombre = $_FILES['imagen']['name'];
    $formato = pathinfo($nombre, PATHINFO_EXTENSION);
    $datos = file_get_contents($_FILES['imagen']['tmp_name']);

    // Escapar los datos para prevenir inyecciones SQL
    $nombre = $conn->real_escape_string($nombre);
    $formato = $conn->real_escape_string($formato);

    // Consulta para insertar datos
    $sql = "INSERT INTO imagenes (nombre, formato, datos) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Vincular parámetros
    $stmt->bind_param("sss", $nombre, $formato, $datos);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a la página anterior después de guardar la imagen
        header("Location: index.php");
        exit(); // Asegura que el script se detiene después de la redirección
    } else {
        echo "Error al guardar la imagen: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "No se ha subido ninguna imagen.";
}

// Cerrar la conexión
$conn->close();
?>

