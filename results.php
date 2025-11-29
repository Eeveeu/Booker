<html>
<head>
<meta charset="UTF-8">
<title>Магазин "Буквофил" - Результаты поиска</title>
</head>
<body>

<h1>Магазин "Буквофил" - Результаты поиска</h1>

<a href="general_page.php">Вернуться на главную страницу</a> | <a href="search.html">Новый поиск</a>

<hr>

<?php
$searchtype=$_POST['searchtype'];
$searchterm=$_POST['searchterm'];

if (!$searchtype || !$searchterm)
{
  echo 'Вы не ввели параметры поиска.  Пожалуйста, вернитесь на предыдущую страницу и повторите ввод.';
  exit;
}

$conn = mysqli_connect('mysql', 'root', '', 'books');
mysqli_set_charset($conn, 'utf8');
if (mysqli_connect_errno())
{
  echo 'Ошибка: Не удалось установить соединение с базой данных.';
  exit;
}

$result=mysqli_query($conn, "select * from books_with_sales where ".$searchtype." like '%".$searchterm."%'");

$i=0;
while ($row = mysqli_fetch_row($result))
{
  echo '<p><strong>'.($i+1).'. Название: </strong>';
  echo htmlspecialchars(stripslashes($row[2]));
  
  echo '</strong><br />Автор: ';
  echo stripslashes($row[1]);
  
  echo '<br />ISBN: ';
  echo stripslashes($row[0]);
  
  echo '<br />Цена: ';
  echo stripslashes($row[3]);
  $row[3];
  $i=$i+1;
}

echo '<p>Количество книг: '.$i.'</p>';

mysqli_close($conn);
?>

</body>
</html>
