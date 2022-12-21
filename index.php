<link rel="stylesheet"  href="style.css">
<?php

echo'
<!DOCTYPE HTML>
<html id="App_interface">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lab8</title>
</head>
<body>
<table>
<tr>
<td width=850px>
<div style="color: rgb(0, 0, 0)">
<div style="background: currentcolor; height:0px; width:0px;"></div>
</div>
</td>
<td width=160px> Цветовые кластеры
</td>
</tr>
</table>
';
echo'
<table >';

//=========================================БД======================================
define('DB_HOST', 'localhost'); //Адрес
define('DB_USER', 'root'); //Имя пользователя
define('DB_PASSWORD', ''); //Пароль
define('DB_NAME', 'colors8'); //Имя БД
$mysql = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//=========================================БД======================================

$claster = 6;
for($i = 1; $i <= $claster; $i++){
    $result = mysqli_query($mysql, "SELECT c.r, c.g, c.b FROM cluster as c WHERE c.id = '$i'");
    $Arr = mysqli_fetch_array($result);
    $r = $Arr['r'];
    $g = $Arr['g'];
    $b = $Arr['b'];
    echo'
    <tr>
    <td width=200px>
        <div style="color: rgb('.$r.', '.$g.', '.$b.')">
        <div class="big">
        </div>
        </div>
        </td>';
    
    $mysql->query("DROP TABLE IF EXISTS answer");
    $mysql->query("CREATE table if not exists answer AS SELECT p.r, p.g, p.b FROM colors_1 AS p, mindists AS m, cluster AS c WHERE p.id = m.pid AND c.id_c = m.cid AND c.id_c = '$i'");
    $mysql->query("ALTER table answer add id int primary key auto_increment;");
    $result = mysqli_query($mysql, "SELECT COUNT(*) AS count FROM answer;");
    $Arr = mysqli_fetch_array($result);
    echo'<td>';

    
    $count = $Arr['count'];
    for($j = 1; $j <= $count; $j++){
        $result = mysqli_query($mysql, "SELECT p.r, p.g, p.b FROM answer AS p WHERE p.id = '$j'");
        $Arr = mysqli_fetch_array($result);
        $r = $Arr['r'];
        $g = $Arr['g'];
        $b = $Arr['b'];
        echo'<td>
        <div style="color: rgb('.$r.', '.$g.', '.$b.')">
        <div class="small">
        </div>
        </div></td>'
        ;
    }

    echo'</td>';
    echo'
    </tr>
    ';
}
?>
