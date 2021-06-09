<?php
session_start();
$id = $_GET['id'];

echo $id;

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
if(isset($id) & $id!=""){
   	$query = "DELETE FROM `pled`.`orders` WHERE 
   	id = '{$id}';";
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