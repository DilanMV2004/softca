<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignación de Cursos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header-container">
        <h1>Asignación de Cursos</h1>
    </div>
    <div class="container">
        <div class="welcome-box">
            <h2>Asignar Curso a Estudiante</h2>
        </div>
        <form>
            <label for="estudiante_id">ID del Estudiante:</label>
            <input type="text" id="estudiante_id" name="estudiante_id" required>

            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
                <option value="1A">1A</option>
                <option value="1B">1B</option>
                <option value="1C">1C</option>
                <!-- Agregar más opciones según sea necesario -->
            </select>

            <button type="submit">Asignar Curso</button>
        </form>
    </div>
    <footer>
        <h3>&copy; Colegio Americano de Barranquilla. Todos los derechos reservados.</h3>
    </footer>
</body>
</html>