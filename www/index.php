<?php
require 'db.php';
require 'Student.php';

$student = new Student($pdo);
$all = $student->getAll();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Записи на мастер-класс</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Сохранённые записи на мастер-класс</h1>

    <?php if (count($all) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата рождения</th>
                <th>Тема</th>
                <th>Материалы</th>
                <th>Формат</th>
                <th>Дата записи</th>
            </tr>
            <?php foreach ($all as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['birth_date'] ?></td>
                    <td><?= htmlspecialchars($row['theme']) ?></td>
                    <td><?= $row['materials'] ? 'Да' : 'Нет' ?></td>
                    <td><?= htmlspecialchars($row['format']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Пока нет записей на мастер-класс.</p>
    <?php endif; ?>

    <br>
    <a href="form.html">Записаться на мастер-класс</a>
</body>

</html>