<?php
include '../BD/database.php';

// Verificar si el parámetro 'id' está presente en la solicitud
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el id a un número entero para evitar problemas de seguridad

    try {
        // Preparar la consulta para evitar inyecciones SQL
        $sql = "DELETE FROM espacios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        // Ejecutar la consulta
        if ($stmt->execute([':id' => $id])) {
            echo "Espacio eliminado correctamente. <a href='index.php'>Volver a la lista</a>";
        } else {
            echo "Error al eliminar el espacio.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; // Cerrar la conexión
} else {
    echo "ID inválido. <a href='index.php'>Volver a la lista</a>";
}
?>

