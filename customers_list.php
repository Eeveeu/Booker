<html>
<head>
<meta charset="UTF-8">
<title>Магазин "КнигоМакс" - Покупатели</title>
</head>
<body>

<h1>Магазин "КнигоМакс" - Список покупателей</h1>

<a href="general_page.php">Вернуться на главную страницу</a> | <a href="orders_list.php">Список заказов</a>

<h2>Наши клиенты:</h2>

<?php
$conn = mysqli_connect('mysql', 'root', '', 'books');
mysqli_set_charset($conn, 'utf8');
if (mysqli_connect_errno())
{
  echo 'Ошибка: Не удалось установить соединение с базой данных.';
  exit;
}

$result=mysqli_query($conn, "select * from customers");
echo '<table border="1" cellpadding="5">';
echo '<tr><th>ID</th><th>Имя</th><th>Адрес</th><th>Город</th></tr>';

while ($row = mysqli_fetch_row($result))
{
  echo '<tr>';
  echo '<td>'.stripslashes($row[0]).'</td>';
  echo '<td>'.stripslashes($row[1]).'</td>';
  echo '<td>'.stripslashes($row[2]).'</td>';
  echo '<td>'.stripslashes($row[3]).'</td>';
  echo '</tr>';
}

echo '</table>';
mysqli_close($conn);
?>

</body>
</html>
