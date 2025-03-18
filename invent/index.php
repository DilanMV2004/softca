<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: hsl(180, 7%, 97%);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #07046E;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            flex: 1;
        }

        h1 {
            margin: 0;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 2 2 45%;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input, .form-group select, .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .textarea-group {
            flex: 2 2 100%;
        }

        /* Estilo mejorado para los botones */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            width: 100%;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .button a {
            color: white;
            text-decoration: none;
        }

        footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="../img/logo-cumpleanos2.png" width="390" height="109" alt="Logo"/>
        <h1>Registrar Inventario</h1>
    </header>

    <div class="container">
        <form action="process_inventory.php" method="post">
            <!-- Formulario de inventario aquí -->
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="tipo_equipo">Tipo de Equipo:</label>
                <input type="text" id="tipo_equipo" name="tipo_equipo" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>
            </div>
            <div class="form-group">
                <label for="serial">Serial:</label>
                <input type="text" id="serial" name="serial" required>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable:</label>
                <input type="text" id="responsable" name="responsable" required>
            </div>
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required>
            </div>
            <div class="textarea-group">
                <label for="especificaciones">Especificaciones:</label>
                <textarea id="especificaciones" name="especificaciones" rows="2" required></textarea>
            </div>
            <div class="textarea-group">
                <label for="observaciones">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
            </div>
            <div class="form-group">
                <label for="garantia">Garantía:</label>
                <select id="garantia" name="garantia" required>
                    <option value="vigente">Vigente</option>
                    <option value="vencido">Vencido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_validacion">Fecha de Validación de Inventario:</label>
                <input type="date" id="fecha_validacion" name="fecha_validacion" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <!-- PHP para llenar las opciones -->
                </select>
            </div>

            <!-- Grupo de botones -->
            <div class="button-group">
                <button type="submit" class="button">Registrar Inventario</button>
                <a href="consultar_inventario.php" class="button">Consultar Inventario</a>
                <a href="../index.php" class="button">Salir</a>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

