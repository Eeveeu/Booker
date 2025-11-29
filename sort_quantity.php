<html>
<head>
<meta charset="UTF-8">
<title>Магазин "Буквофил" - Рейтинг продаж</title>
</head>
<body>

<h1>Рейтинг продаж</h1>

<a href="general_page.php">Вернуться на главную страницу</a>

<h2>От самых продаваемых к самым непокупаемым (выбор за Вами):</h2>

<?php
$conn = mysqli_connect('mysql', 'root', '', 'books');
mysqli_set_charset($conn, 'utf8');
if (mysqli_connect_errno())
{
  echo 'Ошибка: Не удалось установить соединение с базой данных.';
  exit;
}

$result=mysqli_query($conn, "select * from books_with_sales order by sum_order_items_quantity desc");
$i=0;
while ($row = mysqli_fetch_row($result))
{
  echo '<p><strong>'.($i+1).'. Название: </strong>';
  echo stripslashes($row[2]);
  
  echo '</strong><br />Автор: ';
  echo stripslashes($row[1]);
  
  echo '<br />ISBN: ';
  echo stripslashes($row[0]);
  
  echo '<br />Цена: ';
  echo stripslashes($row[3]);
  
  echo '<br />Продано экземпляров: ';
  echo stripslashes($row[5]);
  $i=$i+1;
}

mysqli_close($conn);
?>

</body>
</html>
