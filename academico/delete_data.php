<?php
include '../includes/db.php';

$id = $_POST['id'];
$type = $_POST['type'];

$query = "DELETE FROM $type WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "Registro eliminado con éxito";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
