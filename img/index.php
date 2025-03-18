<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Imágenes - Colegio</title>
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #07046E;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.3);
        }
        .form-container {
            margin: 20px 0;
        }
        .form-container input[type="file"] {
            margin: 10px 0;
        }
        .form-container button {
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .form-container button:hover {
            background: #218838;
        }
        .image-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .image-table th, .image-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .image-table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }
        .image-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .image-table tr:hover {
            background-color: #f1f1f1;
        }
        .image-table img {
            max-width: 150px;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .delete-button {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="../img/logo-cumpleanos2.png" alt="Imagen del Colegio" style="max-width: 100%; height: auto;">
    </header>
    <div class="container">
    
        <div class="form-container">
            <h2>Subir Imagen</h2>
            <form action="save_image.php" method="POST" enctype="multipart/form-data">
                <label for="imagen">Selecciona una imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" required>
                <button type="submit">Guardar Imagen</button>
            </form>
        </div>

        <!-- Sección para mostrar imágenes en una tabla -->
        <div class="image-gallery">
            <table class="image-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Acciones</th> <!-- Nueva columna para las acciones -->
                    </tr>
                </thead>
                <tbody>
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

                    // Consulta para obtener imágenes
                    $sql = "SELECT id, nombre, formato, datos FROM imagenes"; // Incluye el campo 'id'
                    $result = $conn->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar cada imagen en una fila de la tabla
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id']; // Obtener el id de la imagen
                            $nombre = $row['nombre'];
                            $formato = $row['formato'];
                            $datos = base64_encode($row['datos']); // Codificar datos en base64 para mostrar en HTML

                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($nombre) . '</td>';
                            echo '<td><img src="data:image/' . $formato . ';base64,' . $datos . '" alt="' . htmlspecialchars($nombre) . '"></td>';
                            echo '<td><form action="delete_image.php" method="POST">
                                      <input type="hidden" name="id" value="' . htmlspecialchars($id) . '">
                                      <button type="submit" class="delete-button">Eliminar</button>
                                  </form></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">No hay imágenes disponibles.</td></tr>'; // Ajusta colspan a 3
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <a href="../secur/configuracion_sistema.php" class="back-button">Volver al Menú</a>
    </div>
    <footer class="footer">
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>
</body>
</html>


