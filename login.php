<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Аунтификация</title>
</head>

<body>
	
	
	<form method="post" class="log_form">
		<p class="log_text">Логин: <input class="form_input" type="text" name="login"></p>
		<p class="log_text">Пароль: <input class="form_input" type="password" name="password"></p>
		<input class="buttons" type="submit" value="Войти">
	</form >
	</div>
<p class="errors">
	<?php
error_reporting(E_ERROR | E_PARSE);
	
	//Подключение к базе данных
	
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="pled";
	
	
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Соединение установлено!<hr><br>\n";
if (isset($_POST['login']) & isset($_POST['password'])) {
	$login = $_POST['login'];
	$password = $_POST['password'];
	$query = "SELECT `id`
	FROM `users`
	WHERE `login`='{$login}' AND `password`='{$password}'
	";
	$query = "SELECT `role` FROM `pled`.`users` WHERE `login`='{$login}' AND `password`='{$password}' ";
	$res = mysqli_query($conn,$query);
	if($res){
	while($row = mysqli_fetch_array($res))
	{
	$full_name = $row['full_name'];
	$role = $row['role'];
	}
	}
 
$sql = mysqli_query($conn,$query) or die(mysql_error());
if (mysqli_num_rows($sql) > 0)
{
	
	session_start();	
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['role'] = $role;
	header("Location: admin.php");
	exit();

}
 
else 
	echo 'Неверный логин или пароль';
	
}
?>
</p>
</body>
</html>