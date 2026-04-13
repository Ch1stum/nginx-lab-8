<?php
require 'db.php';
require 'Student.php';


$name = htmlspecialchars($_POST['name'] ?? '');
$birth_date = $_POST['birth_date'] ?? '';
$theme = htmlspecialchars($_POST['theme'] ?? '');
$materials = isset($_POST['materials']) ? 1 : 0;
$format = htmlspecialchars($_POST['format'] ?? '');


$errors = [];
if (empty($name)) $errors[] = "Имя не может быть пустым";
if (empty($birth_date)) $errors[] = "Дата рождения обязательна";
if (empty($theme)) $errors[] = "Выберите тему мастер-класса";
if (empty($format)) $errors[] = "Выберите формат участия";

if (!empty($errors)) {
    session_start();
    $_SESSION['errors'] = $errors;
    header("Location: form.html");
    exit();
}


$student = new Student($pdo);
$student->add($name, $birth_date, $theme, $materials, $format);


header("Location: index.php");
exit();
