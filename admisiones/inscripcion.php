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
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los cursos y grados
$sql = "SELECT cursos.id, cursos.nombre_curso, grados.nombre_grado FROM cursos 
        JOIN grados ON cursos.grado_id = grados.id";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Preinscripción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 5px 0;
            width: 100%;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }
        .btn-red {
            background-color: #F03709;
        }
        .btn-red:hover {
            background-color: #ff8533;
        }
        .success, .error {
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="../img/logo-cumpleanos2.png" width="490" height="120" />
        <h1>Formulario de inscripción</h1>
    </div>

    <div class="container">
          <!-- Formulario de Preinscripción -->
        <form method="POST" action="insert_preinscripcion.php">
            <div class="section">
                <h2>Datos del Aspirante</h2>
                <label for="primer_nombre_aspirante">Primer Nombre </label>
                <input type="text" id="primer_nombre_aspirante" name="primer_nombre_aspirante" required>

                <label for="segundo_nombre_aspirante">Segundo Nombre </label>
                <input type="text" id="segundo_nombre_aspirante" name="segundo_nombre_aspirante">

                <label for="primer_apellido_aspirante">Primer Apellido </label>
                <input type="text" id="primer_apellido_aspirante" name="primer_apellido_aspirante" required>

                <label for="segundo_apellido_aspirante">Segundo Apellido </label>
                <input type="text" id="segundo_apellido_aspirante" name="segundo_apellido_aspirante">

                <label for="grado">Grado al que aspira:</label>
                <select id="curso" name="curso" required>
                    <option value="">Seleccione un curso</option>
                    <?php
                    if ($result->num_rows > 0) {
                        // Mostrar cada curso en la lista desplegable
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre_curso'] . " - " . $row['nombre_grado'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay cursos disponibles</option>";
                    }
                    ?>
                </select>


            </div>

            <div class="section">
                <h2>Datos del Acudiente</h2>
                <label for="primer_nombre_acudiente">Primer Nombre </label>
                <input type="text" id="primer_nombre_acudiente" name="primer_nombre_acudiente" required>

                <label for="segundo_nombre_acudiente">Segundo Nombre </label>
                <input type="text" id="segundo_nombre_acudiente" name="segundo_nombre_acudiente">

                <label for="primer_apellido_acudiente">Primer Apellido </label>
                <input type="text" id="primer_apellido_acudiente" name="primer_apellido_acudiente" required>

                <label for="segundo_apellido_acudiente">Segundo Apellido </label>
                <input type="text" id="segundo_apellido_acudiente" name="segundo_apellido_acudiente">

                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>

                <label for="celular">Celular</label>
                <input type="tel" id="celular" name="celular" required>
            </div>

            <div class="button-container">
                <input type="submit" class="btn btn-red" value="Enviar Preinscripción">
                <a href="admissions.html" class="btn btn-red">Menu Principal</a>
            </div>
        </form>
        
    </div>

    <div class="footer">
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </div>
</body>
</html>

