<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Все данные</title>
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
    </style>
</head>

<body>
    <h2>Все сохранённые данные:</h2>

    <?php if (file_exists("data.txt")): ?>
        <table>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Тема</th>
                <th>Формат</th>
                <th>Дата</th>
            </tr>
            <?php
            $lines = file("data.txt", FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line):
                $data = explode(";", $line);
                // Поддержка старого и нового формата
                if (count($data) >= 5):
            ?>
                    <tr>
                        <td><?= htmlspecialchars($data[0]) ?></td>
                        <td><?= htmlspecialchars($data[1]) ?></td>
                        <td><?= htmlspecialchars($data[2]) ?></td>
                        <td><?= htmlspecialchars($data[3]) ?></td>
                        <td><?= htmlspecialchars($data[4]) ?></td>
                    </tr>
            <?php
                endif;
            endforeach;
            ?>
        </table>
    <?php else: ?>
        <p>Данных нет</p>
    <?php endif; ?>

    <br>
    <a href="index.php">На главную</a>
</body>

</html>