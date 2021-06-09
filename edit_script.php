<?php
error_reporting(E_ERROR | E_PARSE);	
session_start();
$id = $_GET['var1'];
$size = $_GET['var2'];
$kol = $_GET['var3'];
$colour = $_GET['var4'];
$fio = $_GET['var5'];
$email = $_GET['var6'];

echo $id.".";
echo $size.".";
echo $kol.".";
echo $colour;
echo $fio;
echo $email;

$hostname="localhost";
	$username="root";
	$password="";
	$dbname="pled";
	
	
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
// Проверяем соединение
if (!$conn) {
    die("Соединение потерятно: " . mysqli_connect_error());
}
echo "Соединение установлено!<hr><br>\n";


?>

<form method="post">
	<table border="1" style="text-align: center;">
		<th>Размер</th>
		<th>Кол-во</th>
		<th>Цвет</th>
		<th>ФИО</th>
		<th>Почта</th>

	<tr>
	<td><p style="display: inline-block;"> <input  value='<?php echo $size;?>' type="text" style="width:4em;" name="size"  value=<?php echo $size;?>></p></td>
	<td><p style="display: inline-block; "> <input  type="text" name="kol" value=<?php echo $kol?>></p></td>
 	<td><p style="display: inline-block; "> <input  type="text" name="colour" value=<?php echo $colour?>></p></td>
 	<td><p style="display: inline-block; "> <input  type="text" name="fio" value=<?php echo $fio?>></p></td>
 	<td><p style="display: inline-block; "> <input  type="text" name="email" value=<?php echo $email?>></p></td>
	</tr>
	</table>
	<input type="submit" name="sub">
</form>

<?php

if(isset($_POST['size']) & $_POST['size']!="" &
   isset($_POST['kol']) & $_POST['kol']!="" &
   isset($_POST['colour']) & $_POST['colour']!="" &
	isset($_POST['fio']) & $_POST['fio']!="" &
	isset($_POST['email']) & $_POST['email']!="" ){
   	$query = "UPDATE `pled`.`orders` 
   	SET
   	size = '".$_POST['size']."',
   	kol = '".$_POST['kol']."',
    colour = '".$_POST['colour']."',
   	`FIO` = '".$_POST['fio']."',
   	email = '".$_POST['email']."'
   	WHERE id={$id};";
	$res = mysqli_query($conn,$query);}
	if($res)
	{
		check($conn);
	}
	function check($conn){
	if(mysqli_affected_rows($conn) > 0) {
		echo "Запись удалена";
		header("Location: admin.php");
	} else {
		echo "Произошла ошибка";
		echo <<<END
		<a href="admin.php"><br>Назад</a>
		END;
	}
	
	}


	

mysqli_close($conn);
?>