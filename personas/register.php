<?php
$host = 'localhost';
$db = 'softca_db';
$user = 'root'; // Cambia esto según tu configuración
$pass = ''; // Cambia esto según tu configuración

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $type = $_POST['type'] ?? '';

        if ($type === 'student') {
            $stmt = $pdo->prepare("INSERT INTO students (doc_type, doc_number, first_name, second_name, last_name, second_last_name, birth_place, birth_date, sex, admission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['student_doc_type'],
                $_POST['student_doc'],
                $_POST['student_first_name'],
                $_POST['student_second_name'],
                $_POST['student_last_name'],
                $_POST['student_second_last_name'],
                $_POST['student_birth_place'],
                $_POST['student_birth_date'],
                $_POST['student_sex'],
                $_POST['student_admission_date']
            ]);
        } elseif ($type === 'employee') {
            $stmt = $pdo->prepare("INSERT INTO employees (doc_type, doc_number, first_name, second_name, last_name, second_last_name, birth_place, birth_date, sex, admission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['employee_doc_type'],
                $_POST['employee_doc'],
                $_POST['employee_first_name'],
                $_POST['employee_second_name'],
                $_POST['employee_last_name'],
                $_POST['employee_second_last_name'],
                $_POST['employee_birth_place'],
                $_POST['employee_birth_date'],
                $_POST['employee_sex'],
                $_POST['employee_admission_date']
            ]);
        } elseif ($type === 'teacher') {
            $stmt = $pdo->prepare("INSERT INTO teachers (doc_type, doc_number, first_name, second_name, last_name, second_last_name, birth_place, birth_date, sex, admission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST['teacher_doc_type'],
                $_POST['teacher_doc'],
                $_POST['teacher_first_name'],
                $_POST['teacher_second_name'],
                $_POST['teacher_last_name'],
                $_POST['teacher_second_last_name'],
                $_POST['teacher_birth_place'],
                $_POST['teacher_birth_date'],
                $_POST['teacher_sex'],
                $_POST['teacher_admission_date']
            ]);
        }

        $response['success'] = true;
        $response['message'] = 'Registro exitoso';
    } else {
        $response['message'] = 'Método de solicitud no válido';
    }
} catch (Exception $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

echo json_encode($response);
?>
