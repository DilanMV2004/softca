<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evolución a Matrícula</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header-container">
        <h1>Evolución de Inscritos a Matrícula</h1>
    </div>
    <div class="container">
        <div class="welcome-box">
            <h2>Seleccionar Inscrito</h2>
        </div>
        <form>
            <label for="inscrito_id">ID del Inscrito:</label>
            <input type="text" id="inscrito_id" name="inscrito_id" required>

            <label for="monto">Monto a Pagar:</label>
            <input type="number" id="monto" name="monto" required>

            <button type="submit">Evolucionar a Matrícula</button>
        </form>
    </div>
    <footer>
        <h3>&copy; Colegio Americano de Barranquilla. Todos los derechos reservados.</h3>
    </footer>
</body>
</html>