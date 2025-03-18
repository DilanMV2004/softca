<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softca_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
 

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para recuperar los niveles
function fetchUsers($conn) {
    $sql = "SELECT id, nivel FROM niveles";
            
            
    
    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta de niveles: " . $conn->error);
    }

    $niveles = [];
    while ($row = $result->fetch_assoc()) {
        $niveles[] = $row;
    }
    return $niveles;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $Id = $_POST['id'];

    $sql = "DELETE FROM niveles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración Académica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #07046E;
            color: white;
            padding: 20px;
            text-align: center;
        }
        a {
            color: white;
            text-decoration: none;
        }
        footer {
            background: #07046E;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .container {
            background: #07046E;
            padding: 20px;
            text-align: center;
            margin-bottom: 60px;
        }

        .btn {
            background: #F03709;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            display: inline-block;
        }

        .btn:hover {
            background: #043F7B;
        }

        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 900px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #07046E;
            color: white;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <header>
           <img src="../img/logo-cumpleanos2.png" width="390" height="100" alt="Logo" />
        <h1>Bienvenido: <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    </header>
    <div class="container">
        <button class="btn" onclick="showModal('programaModal')">Niveles</button>
        <button class="btn" onclick="showModal('gradoModal')">Grado</button>
        <button class="btn" onclick="showModal('areaModal')">Área</button>
        <button class="btn" onclick="showModal('asignaturaModal')">Asignatura</button>
        <button class="btn" onclick="showModal('desempenioModal')">Desempeño</button>
        <button class="btn" onclick="showModal('indicadorModal')">Indicador</button>
        <button class="btn" onclick="showModal('relacionModal')">Área - Asignatura</button>
        <button class="btn" onclick="location.href='../index.php'">Menu principal</button>
    </div>

    <!-- Modal para nivel -->
    <div id="programaModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('programaModal')">&times;</span>
            <h2>Niveles</h2>
            <form id="programaForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="programaNombre">Nombre del Nivel:</label>
                    <input type="text" id="programaNombre" name="programaNombre" required>
                </div>
                <button type="button" class="btn"><a href="crearnivel.php">Crear Nivel</a></button>
                <button type="submit" class="btn" value="updatelevel('nivel')">Guardar</button>
                <button type="button" class="btn" onclick="updateData('nivel')">Modificar</button>
                <button type="button" class="btn" onclick="deletelevel('<?= htmlspecialchars($id['id']) ?>')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('nivelTable', this.value)">
            </form>
            <table id="nivelTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateData') {
    $id = $_POST['id'];
    $nivel = $_POST['nivel'];
    

    $sql = "UPDATE niveles SET nivel = ?, id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nivel, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Nivel actualizado exitosamente.'); window.location.href = 'configuracion_academica.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el Nivel.');</script>";
    }
}
            ?>
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deletelevel') {
    $id = $_POST['id'];

    $sql = "DELETE fROM niveles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }
    exit;
}
                  ?>
                    <script>
        function deletelevel(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este Nivel?')) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "configuracion_academica.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    const response = JSON.parse(this.responseText);
                    const message = document.getElementById('message');
                    if (response.status === "success") {
                        message.innerHTML = "Nivel eliminado exitosamente.";
                        message.className = "message success";
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000); // Recargar la página después de 2 segundos
                    } else {
                        message.innerHTML = "Error al eliminar el Nivel. " + (response.message || "");
                        message.className = "message error";
                    }
                    message.style.display = "block";
                };
                xhr.send(`action=deletelevel&id=${encodeURIComponent(id)}`);
            }
        }
                </script>
                    <?php $niveles = fetchUsers($conn); ?>
                    <?php foreach ($niveles as $nivel): ?>
                    <tr>
                        <td><?= htmlspecialchars($nivel['id']) ?></td>
                        <td><?= htmlspecialchars($nivel['nivel']) ?></td>
                        <td>
                            <button onclick="updateData(<?= $nivel['id'] ?>, '<?= htmlspecialchars($nivel['nivel']) ?>')">Modificar</button>
                            <button onclick="deletelevel(<?= $nivel['id'] ?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Grado -->
    <div id="gradoModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('gradoModal')">&times;</span>
            <h2>Configurar Grado</h2>
            <form id="gradoForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="gradoNombre">Nombre del Grado:</label>
                    <input type="text" id="gradoNombre" name="gradoNombre" required>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('grado')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('grado')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('gradoTable', this.value)">
            </form>
            <table id="gradoTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Área -->
    <div id="areaModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('areaModal')">&times;</span>
            <h2>Configurar Área</h2>
            <form id="areaForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="areaNombre">Nombre del Área:</label>
                    <input type="text" id="areaNombre" name="areaNombre" required>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('area')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('area')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('areaTable', this.value)">
            </form>
            <table id="areaTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Asignatura -->
    <div id="asignaturaModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('asignaturaModal')">&times;</span>
            <h2>Configurar Asignatura</h2>
            <form id="asignaturaForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="asignaturaNombre">Nombre de la Asignatura:</label>
                    <input type="text" id="asignaturaNombre" name="asignaturaNombre" required>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('asignatura')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('asignatura')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('asignaturaTable', this.value)">
            </form>
            <table id="asignaturaTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Desempeño -->
    <div id="desempenioModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('desempenioModal')">&times;</span>
            <h2>Configurar Desempeño</h2>
            <form id="desempenioForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="desempenioNombre">Nombre del Desempeño:</label>
                    <input type="text" id="desempenioNombre" name="desempenioNombre" required>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('desempenio')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('desempenio')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('desempenioTable', this.value)">
            </form>
            <table id="desempenioTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Indicador -->
    <div id="indicadorModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('indicadorModal')">&times;</span>
            <h2>Configurar Indicador</h2>
            <form id="indicadorForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="indicadorNombre">Nombre del Indicador:</label>
                    <input type="text" id="indicadorNombre" name="indicadorNombre" required>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('indicador')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('indicador')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('indicadorTable', this.value)">
            </form>
            <table id="indicadorTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Relación Área con Asignatura -->
    <div id="relacionModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('relacionModal')">&times;</span>
            <h2>Relacionar Área con Asignatura</h2>
            <form id="relacionForm" action="save_program.php" method="post">
                <div class="form-group">
                    <label for="relacionArea">Área:</label>
                    <select id="relacionArea" name="relacionArea" required>
                        <!-- Opciones se llenarán dinámicamente -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="relacionAsignatura">Asignatura:</label>
                    <select id="relacionAsignatura" name="relacionAsignatura" required>
                        <!-- Opciones se llenarán dinámicamente -->
                    </select>
                </div>
                <button type="submit" class="btn">Guardar</button>
                <button type="button" class="btn" onclick="updateData('relacion')">Modificar</button>
                <button type="button" class="btn" onclick="deleteData('relacion')">Eliminar</button>
                <input type="text" placeholder="Buscar..." onkeyup="searchTable('relacionTable', this.value)">
            </form>
            <table id="relacionTable">
                <thead>
                    <tr>
                        <th>Área</th>
                        <th>Asignatura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se llenarán dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Colegio Americano de Barranquilla. Todos los derechos reservados.</p>
    </footer>

    <script>
        function showModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function updateData1(type) {
            // Implementa la lógica para modificar los datos aquí
            alert('Función de modificar datos para: ' + type);
        }

        function deleteData(type) {
            // Implementa la lógica para eliminar los datos aquí
            alert('Función de eliminar datos para: ' + type);
        }

        function searchTable(tableId, value) {
            const table = document.getElementById(tableId);
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(value.toLowerCase())) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Función para mostrar el modal
    function showModal(modalId) {
        document.getElementById(modalId).style.display = "block";
        loadData(modalId);
    }

    // Función para cerrar el modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Función para cargar los datos de la tabla usando AJAX
    function loadData(modalId) {
        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let tableBody = $('#' + modalId + 'Table tbody');
                tableBody.empty(); // Limpiar la tabla
                response.forEach(function(item) {
                    tableBody.append(`
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.nombre}</td>
                            <td>
                                <button onclick="editData(${item.id}, '${item.nombre}')">Modificar</button>
                                <button onclick="deleteData(${item.id})">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    }

    // Función para guardar datos
    $('#programaForm').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serialize() + '&action=create';

        $.ajax({
            url: 'save_program.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    alert('Datos guardados correctamente');
                    loadData('nivel');
                } else {
                    alert('Error al guardar los datos');
                }
            }
        });
    });

    // Función para modificar datos
    function editData(id, nombre) {
        $('#programaNombre').val(nombre);
        $('#programaForm').append(`<input type="hidden" name="programaId" value="${id}">`);
        $('#programaForm').append('<input type="hidden" name="action" value="update">');
    }

    // Función para eliminar datos
    function deleteData1(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este programa?')) {
            $.ajax({
                url: 'save_program.php',
                type: 'POST',
                data: { programaId: id, action: 'delete' },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        alert('Datos eliminados correctamente');
                        loadData('programa');
                    } else {
                        alert('Error al eliminar los datos');
                    }
                }
            });
        }
    }

    // Función para buscar en la tabla
    function searchTable(tableId, searchTerm) {
        let filter = searchTerm.toLowerCase();
        $('#' + tableId + ' tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(filter) > -1);
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="crud.js"></script>

</body>
</html>



