<!DOCTYPE html>
<html>
<head>
<title>SQLite Application</title>
<meta charset="utf-8">
<style>
    table { border-collapse: collapse; width: 50%; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #2196F3; color: white; }
</style>
</head>
<body>
<h1>Студенты (Cloud Database)</h1>
<table>
 <tr><th>ФИО</th><th>Возраст</th><th>Адрес</th></tr>
 <?php
 $db = new SQLite3('students.db');
 
 // Создаем таблицу если нет
 $db->exec("CREATE TABLE IF NOT EXISTS STUDENT (
     ID INTEGER PRIMARY KEY,
     NAME TEXT NOT NULL,
     AGE INTEGER NOT NULL,
     ADDRESS TEXT
 )");
 
 // Проверяем есть ли данные
 $result = $db->querySingle("SELECT COUNT(*) FROM STUDENT");
 if ($result == 0) {
     $db->exec("INSERT INTO STUDENT VALUES (1, 'Иванов Иван', 20, 'Москва')");
     $db->exec("INSERT INTO STUDENT VALUES (2, 'Петров Петр', 21, 'СПб')");
     $db->exec("INSERT INTO STUDENT VALUES (3, 'Сидоров Сидор', 19, 'Казань')");
 }
 
 $result = $db->query("SELECT NAME, AGE, ADDRESS FROM STUDENT");
 while($row = $result->fetchArray(SQLITE3_ASSOC)){
 ?>
 <tr>
  <td><?php echo $row['NAME']; ?></td>
  <td><?php echo $row['AGE']; ?></td>
  <td><?php echo $row['ADDRESS']; ?></td>
 </tr>
 <?php } 
 $db->close();
 ?>
</table>
<p><i>База данных: SQLite | Хостинг: Render</i></p>
</body>
</html>
