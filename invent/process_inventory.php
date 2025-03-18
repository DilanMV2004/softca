<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_school_app";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $tipo_equipo = $_POST['tipo_equipo'];
    $marca = $_POST['marca'];
    $serial = $_POST['serial'];
    $responsable = $_POST['responsable'];
    $ubicacion = $_POST['ubicacion'];
    $especificaciones = $_POST['especificaciones'];
    $observaciones = $_POST['observaciones'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $garantia = $_POST['garantia'];
    $fecha_validacion = $_POST['fecha_validacion'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO inventario (codigo, tipo_equipo, marca, serial, responsable, ubicacion, especificaciones, observaciones, fecha_ingreso, garantia, fecha_validacion, estado)
    VALUES ('$codigo', '$tipo_equipo', '$marca', '$serial', '$responsable', '$ubicacion', '$especificaciones', '$observaciones', '$fecha_ingreso', '$garantia', '$fecha_validacion', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

