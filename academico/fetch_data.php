<?php
include '../includes/db.php';

// Valida que el parámetro 'type' esté definido antes de usarlo
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    
    // Asegúrate de usar consultas preparadas para evitar inyección SQL
    $query = "SELECT * FROM programas";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Genera el HTML con los resultados
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>
                    <button onclick=\"updateData('{$row['id']}')\">Modificar</button>
                    <button onclick=\"deleteData('{$row['id']}')\">Eliminar</button>
                </td>
            </tr>";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conn);
    }
} else {
    echo "Error: No se ha definido el tipo.";
}
?>

