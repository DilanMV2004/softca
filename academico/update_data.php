<?php
include '../includes/db.php';

$id = $_POST['id'];
$type = $_POST['type'];
$nombre = $_POST[$type . 'Nombre'];

$query = "UPDATE $type SET nombre = '$nombre' WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "Registro actualizado con éxito";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
