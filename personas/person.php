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
    <title>Registro de Personas - Colegio Americano de Barranquilla</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            flex: 8; /* Permite que el contenedor crezca y ocupe el espacio disponible */
            display: flex;
            flex-direction: column;
            text-align: center;
            padding: 5px; /* Reducido de 10px a 5px */
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
        }
        .welcome-box {
            background-color: #07046E;
            padding: 25px;
            box-shadow: 0px 0px 8px rgba(55, 255, 100, 0.1);
            border-radius: 8px;
            margin-bottom: 8px;
            width: 130%;
            max-width: 700px;
            text-align: center;
        }
        .welcome-box h2 {
            margin: 0;
            font-size: 24px;
            color: white;
            text-align: center;
        }
        h1, h2 {
            text-align: center;
            color: #f9fbe7;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            margin: 5px;
            text-align: center;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .button-1 {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fcfafa;
            background-color: #ff0303;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            margin: 5px;
            text-align: center;
        }
        .button-1:hover {
            background-color: #6d0b04;
        }
        .footer {
            background-color: #030a64;
            color: #fff;
            text-align: center;
            padding: 0.5em 0; /* Reducido de 1em a 0.5em */
            position: fixed;
            width: 100%;
            bottom: 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Agrega una sombra sutil para mejorar la visibilidad */
        }
        .form-container {
            margin-bottom: 30px;
            display: none;
        }
        .form-container.active {
            display: block;
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .horizontal-buttons a {
            margin: 0 5px;
        }
        .footer {
            background-color: #030a64; /* Color de fondo del footer */
            color: #fff; /* Color del texto */
            text-align: center; /* Centrar el texto dentro del footer */
            padding: 0.5em 0; /* Espaciado vertical reducido */
            position: fixed; /* Fijar el footer en la parte inferior de la página */
            width: 100%; /* Ancho completo del footer */
            bottom: 0; /* Posicionar en la parte inferior de la página */
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Agregar sombra sutil para separar el footer del contenido */
            margin: 0; /* Asegurarse de que no haya márgenes adicionales que puedan desalinear el footer */
        }
    </style>
</head>
<body>
<div class="container">
    
    <div class="welcome-box">
     
            <img src="../img/logo-cumpleanos2.png" width="390" height="100" align="center"/>
            <h1>Registro de Personas</h1>
            
            
    </div>

        
        <div class="button-container horizontal-buttons">
            <a href="registrar_estudiante.php" class="button">Registrar Estudiante</a>
            <a href="registrar_empleado.php" class="button">Registrar Empleado</a>
            <a href="registrar_docente.php" class="button">Registrar Docente</a>
        </div>
        
        <div class="button-container horizontal-buttons">
            <a href="reporte_estudiante.php" class="button">Reporte Estudiantes</a>
            <a href="reporte_empleado.php" class="button">Reporte Empleados</a>
            <a href="reporte_docente.php" class="button">Reporte Docentes</a>
        </div>

        <div class="button-container">
            
            <a href="../index.php" class="button-1">Salir</a>
        </div>


    </div>
    <div class="footer">
        <h3>&copy;  Colegio Americano de Barranquilla. Todos los derechos reservados</h3>
        </div>
    </div>
</body>
</html>

