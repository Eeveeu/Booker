<html>
<head>
<meta charset="UTF-8">
<title>Магазин "КнигоМакс" - Заказы</title>
</head>
<body>

<h1>Магазин "КнигоМакс" - Список заказов</h1>

<a href="general_page.php">Вернуться на главную страницу</a> | <a href="customers_list.php">Список покупателей</a>

<h2>Все заказы:</h2>

<?php
$conn = mysqli_connect('mysql', 'root', '', 'books');
mysqli_set_charset($conn, 'utf8');
if (mysqli_connect_errno())
{
  echo 'Ошибка: Не удалось установить соединение с базой данных.';
  exit;
}

$result=mysqli_query($conn, "
  SELECT o.orderid, c.name, o.amount, o.date 
  FROM orders o 
  JOIN customers c ON o.customerid = c.customerid 
  ORDER BY o.date DESC
");

echo '<table border="1" cellpadding="5">';
echo '<tr><th>№ Заказа</th><th>Клиент</th><th>Сумма</th><th>Дата</th></tr>';

while ($row = mysqli_fetch_row($result))
{
  echo '<tr>';
  echo '<td>'.stripslashes($row[0]).'</td>';
  echo '<td>'.stripslashes($row[1]).'</td>';
  echo '<td>'.number_format($row[2], 2).' руб.</td>';
  echo '<td>'.stripslashes($row[3]).'</td>';
  echo '</tr>';
}

echo '</table>';
mysqli_close($conn);
?>

</body>
</html>
