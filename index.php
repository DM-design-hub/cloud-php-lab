<!DOCTYPE html>
<html>
<head>
<title>Cloud DB Application (PostgreSQL)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    table { border-collapse: collapse; width: 50%; font-family: Arial; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #2196F3; color: white; }
</style>
</head>
<body>
<h1>Студенты (Cloud PostgreSQL)</h1>
<table>
 <tr><th>ФИО</th><th>Возраст</th><th>Адрес</th></tr>
 <?php
 // Получаем строку подключения из переменных окружения Render
 $db_url = getenv('DATABASE_URL');

 if ($db_url) {
     // Парсим строку подключения
     $db = pg_connect($db_url);
     
     if ($db) {
         // Создаем таблицу, если нет (для первого запуска)
         $create_table = "CREATE TABLE IF NOT EXISTS student (
             id INT PRIMARY KEY,
             name VARCHAR(20),
             age INT,
             address CHAR(25)
         )";
         pg_query($db, $create_table);

         // Вставляем тестовые данные, если таблица пустая
         $check = pg_query($db, "SELECT count(*) FROM student");
         $row = pg_fetch_row($check);
         if ($row[0] == 0) {
             pg_query($db, "INSERT INTO student (id, name, age, address) VALUES (1, 'Иванов Иван', 20, 'Москва')");
             pg_query($db, "INSERT INTO student (id, name, age, address) VALUES (2, 'Петров Петр', 21, 'СПб')");
             pg_query($db, "INSERT INTO student (id, name, age, address) VALUES (3, 'Сидоров Сидор', 19, 'Казань')");
         }

         // Выбираем данные
         $result = pg_query($db, "SELECT name, age, address FROM student");
         
         while($row = pg_fetch_object($result)){
         ?>
         <tr>
          <td><?php echo $row->name; ?></td>
          <td><?php echo $row->age; ?></td>
          <td><?php echo $row->address; ?></td>
         </tr>
         <?php } 
     } else {
         echo "<tr><td colspan='3'>Ошибка подключения к БД</td></tr>";
     }
 } else {
     echo "<tr><td colspan='3'>Переменная DATABASE_URL не найдена</td></tr>";
 }
 ?>
</table>
<p><i>База данных: Render PostgreSQL | Хостинг: Render</i></p>
</body>
</html>
