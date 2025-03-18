<?php
include '../includes/db.php';

// Verifica que se haya enviado un tipo válido y que sea 'programa'
if (isset($_POST['type']) && $_POST['type'] == 'programa') {
    // Obtiene el nombre del programa desde el formulario
    $programa = $_POST['programa'];

    // Prepara la consulta para evitar inyección SQL
    $query = "INSERT INTO programas (programa) VALUES (programa)";

    // Prepara la declaración
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Vincula el parámetro a la consulta preparada
        mysqli_stmt_bind_param($stmt, 's', $nombre);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Registro guardado con éxito";
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
        }

        // Cierra la declaración preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }
} else {
    echo "Error: Datos inválidos.";
}
?>


