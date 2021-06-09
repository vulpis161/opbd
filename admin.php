<!DOCTYPE html>
<html lang="ru" >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Заказы</title>
</head>

<?php

session_start();
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$role = $_SESSION['role'];
 	if(isset($login) & isset($password))
 	{
 	
 	} else
 	{
 		header("Location: login.php");
 	}
 		$hostname="localhost";
	$username="root";
	$password="";
	$dbname="pled";
	
	
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
// Проверяем соединение
if (!$conn) {
    die("Соединение потерятно: " . mysqli_connect_error());

}

?>
		
		<?php
		error_reporting(E_ERROR | E_PARSE);
		?>

</div>
<p class="greet1">
<?php


?>
<?php $_SESSION['page_nums'] = $_POST['page_nums']; ?>
<?php
	
	if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        if (isset($_SESSION['page_nums']) & $_SESSION['page_nums']!="") {
        	$no_of_records_per_page = $_SESSION['page_nums'];
        } else
        {
        $no_of_records_per_page = 10;
    	}
        $offset = ($pageno-1) * $no_of_records_per_page;
	
	//Подключение к базе данных
	


/*echo "Соединение установлено!<hr><br>\n";*/

		$total_pages_sql = "SELECT COUNT(*) FROM orders";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

	$query = "SELECT * FROM `pled`.`orders` ORDER BY `id` DESC LIMIT $offset, $no_of_records_per_page;";
	$res = mysqli_query($conn,$query);
if($res){
echo <<<END
<table class="table" border="1">
<th>ID</th>
<th>Размер</th>
<th>Кол-во</th>
<th>Цвет</th>
<th>ФИО</th>
<th>Почта</th>


END;


if ($role == 'admin') {
	

while($row = mysqli_fetch_array($res))
{
echo <<<END
<tr><td style="border-bottom-width: 2px;">{$row['id']}</td>
<td style="border-bottom-width: 2px;">{$row['size']}</td>
<td style="border-bottom-width: 2px;">{$row['kol']}</td>
<td style="border-bottom-width: 2px;">{$row['colour']}</td>
<td style="border-bottom-width: 2px;">{$row['FIO']}</td>
<td style="border-bottom-width: 2px;">{$row['email']}</td>
<td style="border-bottom-width: 2px;"> <a onclick="return confirm('Вы действительно хотите удалить запись: {$row['id']}.{$row['size']}.{$row['kol']}{$row['colour']} {$row['FIO']}')" href='del_script.php?id={$row['id']}'><img width="13px;" src="trash.png"></img></a>
<a href='edit_script.php?var1={$row['id']}&var2={$row['size']}&var3={$row['kol']}&var4={$row['colour']}&var5={$row['FIO']}&var6={$row['email']}'><img width="13px;" src="edit.png"></img></a></td></tr>
END;

} echo <<<END
</table>
END;
}

}
mysqli_close($conn);	
?>

</p>

<p></p>
<ul class="pagination" style=" display: block; padding-left: 0px; text-align: center; align-items: center;">
	<li  style=" text-decoration: none; list-style-type: none; display: inline-block;" class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page_nav" style=" text-decoration: none;" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><=</a>
        </li>
	<p  style=" display: inline-block; text-align: center; margin-left: auto; margin-right: auto;"><?php echo $pageno; ?>|<?php echo $total_pages;?></p>
	<li  style="list-style-type: none; display: inline-block;" class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a class="page_nav" style=" text-decoration: none;" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">=></a>
        </li>
        
        <li   style="list-style-type: none;"><a class="page_nav" style=" text-decoration: none;" href="?pageno=1">В начало</a></li>

        <!--<form  method="post" style="font-size: 12px; margin-top:15px;" action="ta_bp_all">
        Записей на странице: <input style="width: 2em; font-size: 12px; height: 12px;" min="1" type="number" name="page_nums" > <input style="font-family:a_GroticLtNr ; font-size: 12px;" type="submit" name="sub_page" value="Отобразить">
        </form>-->

        
        
    </ul>
<a href="p10.php" title="Вернуться к началу" class="topbutton">К созданию</a>
</body>

</html>