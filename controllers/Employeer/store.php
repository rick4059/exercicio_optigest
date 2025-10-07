<?php
require_once '../../config/db_connect.php';
require_once '../../utils/functions.php';

session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['error'] = "Error processing form";
    header('Location: ../../index.php');
    exit;
}

// Sanitizar dados
$name = sanitize($_POST['name'] ?? '');
$age = filter_var($_POST['age'] ?? '', FILTER_VALIDATE_INT);
$job = sanitize($_POST['job'] ?? '');
$salary = !empty($_POST['salary']) ? filter_var($_POST['salary'], FILTER_VALIDATE_FLOAT) : null;
$admission_date = $_POST['admission_date'] ?? '';


$errors = [];

// Validar nome
if(empty($name)) {
    $errors[] = "Name is required";
} elseif(strlen($name) < 3) {
    $errors[] = "Name must have at least 3 characters";
}

// Validar idade
if(empty($age)) {
    $errors[] = "Age is required";
} elseif($age < 18 || $age > 120) {
    $errors[] = "Age must be between 18 and 120";
}

// Validar job
if(empty(trim($job))) {
    $errors[] = "Job is required";
}

// Validar salary
if($salary !== null && $salary < 0) {
    $errors[] = "Salary must be a positive value";
}

// Validar data de admissão
if(empty($admission_date)) {
    $errors[] = "Admission date is required";
} else {
    $date = DateTime::createFromFormat('Y-m-d', $admission_date);
    if(!$date || $date->format('Y-m-d') !== $admission_date) {
        $errors[] = "Invalid admission date format";
    } elseif($date > new DateTime()) {
        $errors[] = "Admission date cannot be in the future";
    }
}

if(!empty($erros)){
    $_SESSION['error'] = implode('<br>', $erros);
    header('Location: ../../index.php');
    exit;
}

try {
    // Tentar criar
    $query = "INSERT INTO employees (name, age, job, salary, admission_date) 
                VALUES (:name, :age, :job, :salary, :admission_date)";

    $stmt = $conn->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':job', $job);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':admission_date', $admission_date);

    if($stmt->execute()) {
        $_SESSION['success'] = "Employee created successfully!";
    }else{
        $_SESSION['error'] = "Failed to create employee. Please try again.";
    }
} catch(Exception $e) {
    $_SESSION['error'] = "Database error: " . $e->getMessage();
}

header('Location: ../../index.php');