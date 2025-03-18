<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_school_app";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("<p class='error'>Error de conexión: " . $conn->connect_error . "</p>");
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $primer_nombre_aspirante = $_POST['primer_nombre_aspirante'];
    $segundo_nombre_aspirante = $_POST['segundo_nombre_aspirante'];
    $primer_apellido_aspirante = $_POST['primer_apellido_aspirante'];
    $segundo_apellido_aspirante = $_POST['segundo_apellido_aspirante'];
    $grado = $_POST['grado'];
    $primer_nombre_acudiente = $_POST['primer_nombre_acudiente'];
    $segundo_nombre_acudiente = $_POST['segundo_nombre_acudiente'];
    $primer_apellido_acudiente = $_POST['primer_apellido_acudiente'];
    $segundo_apellido_acudiente = $_POST['segundo_apellido_acudiente'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];

    // Preparar la sentencia SQL
    $sql = "INSERT INTO preinscripcion (
        primer_nombre_aspirante, segundo_nombre_aspirante, primer_apellido_aspirante, segundo_apellido_aspirante, 
        grado, primer_nombre_acudiente, segundo_nombre_acudiente, primer_apellido_acudiente, segundo_apellido_acudiente, 
        correo, celular) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", 
        $primer_nombre_aspirante, $segundo_nombre_aspirante, $primer_apellido_aspirante, $segundo_apellido_aspirante,
        $grado, $primer_nombre_acudiente, $segundo_nombre_acudiente, $primer_apellido_acudiente, $segundo_apellido_acudiente,
        $correo, $celular);

    // Ejecutar la sentencia y verificar el resultado
    if ($stmt->execute()) {
        // Redirigir a preinscripcion.php después de la inserción exitosa
        header("Location: preescripcion.php");
        exit();
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
}
?>


