<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción de Aspirantes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header-container">
        <h1>Inscripción de Aspirantes</h1>
    </div>
    <div class="container">
        <div class="welcome-box">
            <h2>Formulario de Inscripción</h2>
        </div>
        <form>
            <label for="nombre">Nombre del Aspirante:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellido">Apellido del Aspirante:</label>
            <input type="text" id="apellido" name="apellido" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <h3>Datos del Padre/Madre o Responsable</h3>
            <label for="nombre_padre">Nombre:</label>
            <input type="text" id="nombre_padre" name="nombre_padre" required>

            <label for="telefono_padre">Teléfono:</label>
            <input type="tel" id="telefono_padre" name="telefono_padre" required>

            <button type="submit">Inscribir Aspirante</button>
        </form>
    </div>
    <footer>
        <h3>&copy; Colegio Americano de Barranquilla. Todos los derechos reservados.</h3>
    </footer>
</body>
</html>