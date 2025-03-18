<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Contabilidad y Finanzas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            flex: 1;
        /* Permite que el contenedor crezca y ocupe el espacio disponible */
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 30px;
            width: 100%;
            max-width: 1000px;
            /* Aumentar el ancho máximo */
            margin: 0 auto;
            background-color: #ffffff;
            /* Fondo blanco para el contenedor */
            border-radius: 10px;
            /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Sombra para el contenedor */
        }

        .welcome-box {
            background-color: #07046E;
            padding: 10px;
            box-shadow: 0px 0px 8px rgba(55, 255, 100, 0.1);
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: center;
            color: white;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 columnas */
            gap: 10px; /* Espacio entre botones */
        }

        nav ul li {
            background-color: #F03709;
            border-radius: 8px;
            overflow: hidden;
        }

        nav ul li a {
            display: block;
            padding: 20px;
            color: #fff;
            text-decoration: none;
            text-align: center;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #d12b00;
        }

        footer {
            background-color: #030a64;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-box">
            <img src="../img/logo-cumpleanos2.png" width="390" height="100" alt="Logo del Colegio Americano de Barranquilla"/>
            <h1>Departamento de Contabilidad y Finanzas</h1>
            <h1>Bienvenido: <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="activo_fijo.php">Activo fijo</a></li>
                <li><a href="analisis_financiero.php">Análisis Financiero</a></li>    
                <li><a href="auditoria.php">Auditoría Interna</a></li>
                <li><a href="contabilidad_general.php">Contabilidad</a></li>
                <li><a href="cuentas_pagar.php">Cuentas por Pagar</a></li>
                <li><a href="cuentas_cobrar.php">Cuentas por Cobrar</a></li>
                <li><a href="cumplimiento_fiscal.php">Cumplimiento Fiscal</a></li>
                <li><a href="documento_electronico.php">Documento Electrónico</a></li>
                <li><a href="nomina.php">Nomina</a></li>
                <li><a href="presupuesto.php">Presupuesto</a></li>
                <li><a href="tesoreria.php">Tesorería</a></li>
                <li><a href="../index.php">Menu principal</a></li>
            </ul>
        </nav>
    </div>
    <footer>
        <h3>&copy; Colegio Americano de Barranquilla. Todos los derechos reservados.</h3>
    </footer>
</body>
</html>

