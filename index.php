<?php
// Сообщаем браузеру, что это UTF-8
header("Content-type: text/html; charset=UTF-8");

// Проверяем, существует ли файл
if (file_exists("catalog.xml")) {
    // Загружаем XML
    $sxml = simplexml_load_file("catalog.xml");
} else {
    echo "Ошибка: файл catalog.xml не найден!";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ЛР 2.3 - Каталог книг</title>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 50%; font-family: Arial; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Каталог книг (Cloud PHP)</h1>
    <table>
        <tr>
            <th>Автор</th>
            <th>Название</th>
            <th>Год</th>
            <th>Цена</th>
        </tr>
        <?php foreach($sxml->book as $book){ ?>
        <tr>
            <td><?php echo $book->author; ?></td>
            <td><?php echo $book->title; ?></td>
            <td><?php echo $book->pubyear; ?></td>
            <td><?php echo $book->price; ?></td>
        </tr>
        <?php } ?>
    </table>
    <p><i>Развернуто на Render.com</i></p>
</body>
</html>