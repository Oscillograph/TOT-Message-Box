<?
$view = 2; // число отображаемых последних сообщений

include ('../../config.php');
include ('../.'.$tomb[library]);

$value = read_db();

$int = 0;
while ($int<$view){
echo 'ip['.$int.']="'.$value[$int][_ip].'";
echo 'date['.$int.']="'.$value[$int][_date].'";
echo 'nick['.$int.']="'.$value[$int][_nick].'";
echo 'msg['.$int.']="'.$value[$int][_message].'";
$int++;
}

?>