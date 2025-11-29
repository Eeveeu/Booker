<html>
<head>
<meta charset="UTF-8">
<title>Вас приветствует магазин "Буквофил"!</title>
</head>
<body>

<h1>Вас приветствует магазин "КнигоМакс/Буквофил"!</h1>

<h3>Лабораторная работа №1:</h3>
<a href="customers_list.php">Список покупателей</a> | 
<a href="orders_list.php">Список заказов</a>

<h3>Лабораторная работа №2:</h3>
<a href="search.html">Поиск книг по ISBN, автору, названию</a> | 
<a href="sort_price.php">Сортировка книг по цене</a> | 
<a href="sort_quantity.php">Сортировка книг по рейтингу продаж</a>

<h2>Сегодня в продаже:</h2>

<?php
$conn = mysqli_connect('mysql', 'root', '', 'books');
mysqli_set_charset($conn, 'utf8');
if (mysqli_connect_errno())
{
  echo 'Ошибка: Не удалось установить соединение с базой данных.';
  exit;
}

$result=mysqli_query($conn, "select * from books_with_sales");
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
  $row[3];
  $i=$i+1;
}

echo '<p>Количество книг: '.$i.'</p>';
mysqli_close($conn);
?>

</body>
</html>
