<?
/*====================================================
Модуль ModeRAT v0.3
---
В разработке принимали участие: ТехнОкраТ , st.Anger
Поставляется только как часть утилиты ToMBAdmin
======================================================
Модерирование сообщений основано на принципе записи Базы Данных "заново".
База Данных считывается в переменную $data .
Затем переменная перезаписывает в себе данные, основываясь на условии:
      Если номера элемента нет в списке удаляемых,
            То данные под этим номером остаются в Базе.
      Если номер элемента есть в списке удаляемых,
           Под его номером записывается следующий элемент.
Когда следующий элемент имеет номер, превышающий максимально количество элементов Базы Данных,
Вместо него на место заменяемого элемента записывается пустой элемент $empty .
=====================================================*/

/*============ определение переменных и функций ============*/
if (isset($logged)&&$logged==true){
  include ('.'.$tomb[library]); // Получаем единственно необходимую функцию считывания Базы Данных

  $data = $database->read_db('.'.$tomb[database]); // загружаем БД
  if (!is_array($data)) {
    $data = $database->init($data, $tomb[max_total], '.'.$tomb[database]);
    adderror('База Данных повреждена.','');
  }
  $empty = array(); //пустой элемент БД
  $empty['_nick'] = '';
  $empty['_message'] = '';
  $empty['_ip'] = '';
  $empty['_date'] = '';
/*===================   собственно скрипт   ================*/

  if($_SERVER[REQUEST_METHOD]=='POST'){ //только если состоялась отправка формы и только, если отправка состоялась с этой страницы
    // Подготавливаем массив выделенных пользователем сообщений
    $sel = array();
    for ($k = 0; $k < $tomb[max_total]; $k++){
      $nextEl = count($sel);
      if (isset($_POST['sel'.$k])){
        $sel[$nextEl] = $k;
      }
    }
    if(count($sel)>0){ // Если есть выделения
      if($_POST['act']=='delete'){ // удаление сообщений
        $step = 0; // "шаг" анализатора (указывает на следующий сравниваемый элемент БД)
        $k = 0; // место записи сообщения (указатель на текущий элемент БД)
        $j = 0; // анализируемый сейчас выделенный элемент-сообщение
        while($k < $tomb[max_total]){
          if(($k==$step)&&($sel[$j]==$k)){
            $step++;
            if(isset($sel[$j+1])){$j++;}
          }
          if(($k==$step)&&($sel[$j]!=$k)){
            $k++;
            $step++;
          }
          if($k!=$step){
            if($step==$sel[$j]){ $step++;
              if(isset($sel[$j+1])){$j++;}
            } else {
              if($step < $tomb[max_total]){
                $data[$k]=$data[$step];
                $k++;
                $step++;
              } else {
                $data[$k]=$empty;
                $k++;
              }
            }
          }
        }
      } elseif($_POST['act']=='edit'){ // редактирование сообщений
        $k = 0; // место записи сообщения + выбор элементов записи
        $j = 0; // анализируемый сейчас выделенный элемент-сообщение
        while ($k < $tomb[max_total]){
          if ($k == $sel[$j]){
            $nick = $_POST['nick'.$k];
            $message = $_POST['msg'.$k];
            $date = $_POST['date'.$k];
            $ip = $_POST['ip'.$k];
            
            //Обработка ника, сообщения, даты и ip на предмет недопустимых символов с заменой последних
          	$nick = substr($nick, 0 , 19);
          	$nick = str_replace('&', '&amp;', $nick);
            $nick = str_replace('"', '&quot;', $nick);
          	$nick = str_replace("'", '&#39;', $nick);
            $nick = str_replace('\\', '&#92;', $nick);
            /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
          	$message = substr($message, 0, ($tomb[max_str]-1));
          	$message = str_replace('&', '&amp;', $message);
            $message = str_replace('"', '&quot;', $message);
          	$message = str_replace("'", '&#39;', $message);
            $message = str_replace('\\', '&#92;', $message);
            /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
          	$date = str_replace('&', '&amp;', $date);
            $date = str_replace('"', '&quot;', $date);
          	$date = str_replace("'", '&#39;', $date);
            $date = str_replace('\\', '&#92;', $date);
            /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
          	$ip = str_replace('&', '&amp;', $ip);
            $ip = str_replace('"', '&quot;', $ip);
          	$ip = str_replace("'", '&#39;', $ip);
            $ip = str_replace('\\', '&#92;', $ip);
            /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
            /*
            $data[$k][_nick] = $_POST['nick'.$k];
            $data[$k][_message] = $_POST['msg'.$k];
            $data[$k][_ip] = $_POST['ip'.$k];
            $data[$k][_date] = $_POST['date'.$k];
            */
            $data[$k][_nick] = $nick;
            $data[$k][_message] = $message;
            $data[$k][_ip] = $ip;
            $data[$k][_date] = $date;
            if(isset($sel[$j+1])){$j++;}
            $k++;
          } else {
            $k++;
          }
        }
      } else {
        adderror('Нет такой операции модерирования.','');
      }
      $database->init($data, $tomb[max_total], '.'.$tomb[database]); // Записываем БД в файл
    } else {
      adderror ('Ничего не было выбрано','');
    }
  }
?>
<style type='text/css'>
input {
      height:22px;
      border:solid 1px #000056;
}
</style>
<form action="./?c=moderation" target="_self" id="theForm" method="POST" name="theForm">
<input type=hidden value='something' name=act>
<table bgcolor=#FDF7CA width=100%>
<tr valign=top><td valign=top align=center>
      <input type=button value='Удалить Выделенное' onClick='return agreement(1);'>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type=button value='Изменить Выделенное' onClick='return agreement(2);'>
</td></tr>
</table>
<table bgcolor=#FDF79A width=100% id=msgs>
<tr valign="TOP"><td align="CENTER" valign="TOP">
<div style="height:400px; width:450px; overflow:auto; text-align:left;">
<input type=checkbox value="empty" name=checker onClick="check(this);">Выделить всё<br> <br>
<? 
  $out = '';
  for ($i = 0; $i < count($data); $i++){
    if($data[$i]!=$empty){
      $out.='  <input type=checkbox value='.$i.' name=sel'.$i.'>
      <input type=TEXT" value="'.$data[$i][_nick].'" name=nick'.$i.'>
      <input type=TEXT name=msg'.$i.' value="'.$data[$i][_message].'">
      <a href="http://ripe.net/cgi-bin/whois?'.$data[$i][_ip].'" target=_blank>'.$data[$i][_ip].'</a>
      <input type=hidden name=ip'.$i.' value='.$data[$i][_ip].'><br>
  ';
      if(($i+1)==$tomb[max_view]){
        $out.='<b>Архивные сообщения:</b>
        ';
      }
    }
  }
  echo $out;
?>
</div>
</td></tr>
</table>
<table bgcolor=#FDF7CA width=100%>
<tr valign=top><td valign=top align=center>
      <input type=button value='Удалить Выделенное'  onClick='agreement(1); return false;'>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type=button value='Изменить Выделенное' onClick='agreement(2); return false;'>
</td></tr>
</table>
</form>
<script language="javascript" type='text/javascript'>
var allCheck = false;
function agreement(todo){
  if (todo == 1){
     act = 'удалить';
     document.theForm.act.value='delete';
  } else if(todo == 2){
     act = 'отредактировать';
     document.theForm.act.value='edit';
  }
  choice = confirm('Вы уверены, что хотите '+act+' выбранные сообщения?');
  if (choice){
     document.theForm.submit();
  }
}
function check(btn){
  if (!allCheck) {
    allCheck = true; btn.value = 'Снять выделение';
  } else {
    allCheck = false; btn.value = 'Выделить всё';
  }
  inputs = document.getElementsByTagName('input');
  for (n=0; n < inputs.length; n++){
    if (inputs[n].type == 'checkbox'){
      switch (allCheck){
        case true:  inputs[n].checked = allCheck; break;
        case false: inputs[n].checked = allCheck; break;
        default :  break;
      }
    }
  }
}
</script>
<?}?>
