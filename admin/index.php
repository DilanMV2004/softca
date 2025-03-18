<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Administrativo</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            background-color: #07046E;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            background-color: #1a237e;
            overflow: hidden;
            color: white;
            padding: 0;
            text-align: center;
            margin: 0;
            list-style: none;
        }

        nav ul li {
            display: inline-block;
            padding: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #575757;
            transition: 0.3s;
        }

        main {
            flex: 1; /* This makes the main content area flexible and pushes the footer to the bottom */
            padding: 20px;
        }

        footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }
    </style>
    <script>
        function loadModule(module) {
            const content = document.getElementById('content');

            switch (module) {
                case 'presupuesto':
                    content.innerHTML = `
                        <h2>Gestión de Presupuesto</h2>
                        <form action="save_presupuesto.php" method="POST">
                            <label for="presupuesto-anual">Presupuesto Anual:</label>
                            <input type="number" id="presupuesto-anual" name="presupuesto_anual" required><br><br>

                            <label for="presupuesto-departamento">Presupuesto por Departamento:</label>
                            <input type="number" id="presupuesto-departamento" name="presupuesto_departamento" required><br><br>

                            <input type="submit" value="Guardar Presupuesto">
                        </form>
                    `;
                    break;

                case 'gastos':
                    content.innerHTML = `
                        <h2>Gestión de Gastos</h2>
                        <form action="save_gastos.php" method="POST">
                            <label for="gasto-descripcion">Descripción del Gasto:</label>
                            <input type="text" id="gasto-descripcion" name="gasto_descripcion" required><br><br>

                            <label for="gasto-monto">Monto del Gasto:</label>
                            <input type="number" id="gasto-monto" name="gasto_monto" required><br><br>

                            <label for="gasto-fecha">Fecha del Gasto:</label>
                            <input type="date" id="gasto-fecha" name="gasto_fecha" required><br><br>

                            <input type="submit" value="Registrar Gasto">
                        </form>
                    `;
                    break;

                case 'datos_institucionales':
                    content.innerHTML = `
                        <h2>Datos Institucionales</h2>
                        <form action="save_datos_institucionales.php" method="POST">
                            <label for="nombre-colegio">Nombre del Colegio:</label>
                            <input type="text" id="nombre-colegio" name="nombre_colegio" required><br><br>

                            <label for="direccion-colegio">Dirección:</label>
                            <input type="text" id="direccion-colegio" name="direccion_colegio" required><br><br>

                            <label for="telefono-colegio">Teléfono:</label>
                            <input type="tel" id="telefono-colegio" name="telefono_colegio" required><br><br>

                            <label for="email-colegio">Correo Electrónico:</label>
                            <input type="email" id="email-colegio" name="email_colegio" required><br><br>

                            <input type="submit" value="Actualizar Datos">
                        </form>
                    `;
                    break;

                case 'contratos':
                    content.innerHTML = `
                        <h2>Gestión de Contratos</h2>
                        <form action="save_contratos.php" method="POST">
                            <label for="contrato-tipo">Tipo de Contrato:</label>
                            <select id="contrato-tipo" name="contrato_tipo" required>
                                <option value="docente">Docente</option>
                                <option value="administrativo">Administrativo</option>
                                <option value="servicios">Servicios Generales</option>
                            </select><br><br>

                            <label for="contrato-fecha-inicio">Fecha de Inicio:</label>
                            <input type="date" id="contrato-fecha-inicio" name="contrato_fecha_inicio" required><br><br>

                            <label for="contrato-fecha-fin">Fecha de Fin:</label>
                            <input type="date" id="contrato-fecha-fin" name="contrato_fecha_fin" required><br><br>

                            <input type="submit" value="Guardar Contrato">
                        </form>
                    `;
                    break;

                case 'pagos':
                    content.innerHTML = `
                        <h2>Gestión de Pagos</h2>
                        <form action="save_pagos.php" method="POST">
                            <label for="pago-descripcion">Descripción del Pago:</label>
                            <input type="text" id="pago-descripcion" name="pago_descripcion" required><br><br>

                            <label for="pago-monto">Monto del Pago:</label>
                            <input type="number" id="pago-monto" name="pago_monto" required><br><br>

                            <label for="pago-fecha">Fecha del Pago:</label>
                            <input type="date" id="pago-fecha" name="pago_fecha" required><br><br>

                            <input type="submit" value="Registrar Pago">
                        </form>
                    `;
                    break;

                default:
                    content.innerHTML = `
                        <h2>Bienvenido</h2>
                        <p>Selecciona una opción del menú para empezar.</p>
                    `;
                    break;
            }
        }
    </script>
</head>
<body>
    <header>
        <img src="../img/logo-cumpleanos2.png" alt="Logo Colegio Americano" class="logo" width="350" height="120" />
        <h1>Módulo Administrativo</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#" onclick="loadModule('presupuesto')">Gestión de Presupuesto</a></li>
            <li><a href="#" onclick="loadModule('gastos')">Gestión de Gastos</a></li>
            <li><a href="#" onclick="loadModule('datos_institucionales')">Datos Institucionales</a></li>
            <li><a href="#" onclick="loadModule('contratos')">Gestión de Contratos</a></li>
            <li><a href="#" onclick="loadModule('pagos')">Gestión de Pagos</a></li>
            <li> <a href="../index.php">Menu principal</a></li>
        </ul>
    </nav>

    <main id="content">
        <h2>Bienvenido</h2>
        <p>Selecciona una opción del menú para empezar.</p>
    </main>

    <footer>
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

