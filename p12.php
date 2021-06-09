<?php
    session_start();
    echo '<h2>'."Данные покупателя:".'</h2>';
    echo '<p>'."ФИО: ".$_SESSION["fio"].'</p>';
    echo '<p>'."Почта: ".$_SESSION["pochta"].'</p>';
    echo '<h3>'."Данные пледа:".'</h3>';
    echo '<p>'."Цвет: ".$_SESSION["colour"].'</p>';
    echo '<p>'."Размер: ".$_SESSION["size"].'</p>';
    echo '<p>'."Количество: ".$_SESSION["kol"].'</p>';
    $size=$_SESSION["size"];
    switch ($size) {
        case '85x85':
            $size = 1600;
            break;
        case '100x100':
            $size = 2400;
            break;
        case '100x120':
            $size = 2600;
            break;
        case '120x140':
            $size = 3800;
            break;
        case '140x190':
            $size = 5700;
            break;
        case '150x200':
            $size = 6800;
            break;   
        case '160x200':
            $size = 7000;
            break;  
        case '180x220':
            $size = 7500;
            break; 
 
    }
    echo '<p>'.'Итоговая стоимость: '.(int)$size*(int)$_SESSION["kol"].'</p>';
    echo '<p>'.'<h3>'."При некорректности данных позвоните по номеру: 8-800-555-35-35".'</h3>'.'</p>';
    session_destroy();
    // echo (int)$_POST["size"]*(int)$_POST["kol"];
?>
<a href="p10.php"> Создать заказ </a>