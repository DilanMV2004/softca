<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admisiones - CA</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f8f8;
            color: #041dfd;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
           
        }
        .container {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            
        }
        h1 {
            color: hsl(210, 33%, 99%);
            font-size: 2.2em;
            margin: 0;
        }
        .menu {
            text-align: center;
            margin-bottom: 30px;
        }
        .menu .button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1em;
            color: #fff;
            background-color: #F03709;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
            margin: 5px;
            text-decoration: none;
        }
        .menu .button:hover {
            background-color: #ff8533;
        }
        .footer {
            background-color: #07046E;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container">
            <img src="../img/logo-cumpleanos2.png" width="490" height="120" alt="Logo Colegio Americano de Barranquilla" />
            <h1>Colegio Americano de Barranquilla - SoftCA</h1>
        </div>

        <div class="menu">
            <a href="preescripcion.php" class="button">Preinscripción</a>
            <a href="inscripcion.php" class="button">Inscripción</a>
            <a href="#cargar-documento" class="button">Cargar Documento</a>
            <a href="#cargar-mas-documentos" class="button">Cargar Más Documentos</a>
            <a href="#entrevista" class="button">Entrevista</a>
            <a href="#evaluacion-matricula" class="button">Evaluación Matrícula</a>
            <a href="../index.php" class="button">Inicio</a>
        </div>
    </div>

    <div class="footer">
        &copy; 2025 Colegio Americano de Barranquilla. Todos los derechos reservados.
    </div>
</body>

</html>
