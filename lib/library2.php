<? 
// Functional Library of Tot Message Box (ToMB)

class library2{

// Здесь использована функция из скрипта Exclusive Bulletin Board v1.9.1 ////
function lockFile(&$file,$mode = 2) {
  if ( preg_match('/[c-z]:\\\.*/i', $_SERVER['PATH']) ) return;
  $i = 0;
  while ( !flock($file,$mode) ) {
      sleep(1);
      $i++;
      if ($i>=10) {
          @fclose($file);
          die('Доступ к Базе Данных закрыт!<br>Вы можете сохранить своё сообщение:<br>'.$_POST['message']);
}  }}
//////////////////////////////////////////////////////////////////////////////

function init($template, $max, $db){
// Создание структуры Базы Данных из имеющегося экземпляра $template на $max элементов и возврат строки, хранящей эту структуру
  global $tomb;
  $empty = array(); //пустой элемент БД
  $empty['_nick'] = '';
  $empty['_message'] = '';
  $empty['_ip'] = '';
  $empty['_date'] = '';
  
  $output = ''; //строка с готовой структурой БД
  
  if (is_array($template)){ // Если передан массив
    if (count($template)>$max){ // Если передан слишком длинный массив БД
      $i = count($template);
      while ($i >= $max){
        unset($template[$i]);
        $i-=1;
      }
    }
    if (count($template) < $max){ // Если передан слишком короткий массив БД
      $i = count($template);
      while ($i <= $max){
        $template[$i] = $empty;
        $i+=1;
      }
    }
    // преобразование в строку Базы Данных
    $output .='<? $value = '."'".serialize($template)."';?>";
    if(empty($db)){ return $output; }
    // При необходимости - сохранение в файл $db
    if (isset($db)){
      $fp = @fopen($db,"w");
 			@$this->lockFile($fp,1);
 			if (!$fp) {return false;} else
 			{
 				fwrite($fp, $output);
 				@$this->lockFile($fp,3);
 				fclose($fp);
			}
    }
  } else { // Если передан не массив - создание и запись пустого массива БД
    $data = array();
    for ($k = 0; $k < $max; $k++){
      $data[$k]=$empty;
    }
    $output .='<? $value = '."'".serialize($date)."';?>";
    if (isset($db)){
      $fp = @fopen($db,"w");
 			@$this->lockFile($fp,1);
 			if (!$fp) {return false;} else
 			{
 				fwrite($fp, $output);
 				@$this->lockFile($fp,3);
 				fclose($fp);
			}
    }
    return $data;
  }
}

function write_db($nick, $message, $ip, $date){
// запись сообщений в базу данных
	global $tomb;
	//обработка полученных данных: замена символов кавычек и перевода строки; обрезание ника и сообщения по длине
	$nick = substr($nick, 0 , 19);
	$nick = str_replace('&', '&amp;', $nick);
  $nick = str_replace('"', '&quot;', $nick);
	$nick = str_replace("'", '&#39;', $nick);
  $nick = str_replace('\\', '&#92;', $nick);
  /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
	$nick = str_replace('
', '', $nick); // InetCrack не победит :)
	$message = substr($message, 0, ($tomb[max_str]-1));
	$message = str_replace('&', '&amp;', $message);
	$message = str_replace('"', '&quot;', $message);
	$message = str_replace("'", '&#39;', $message);
  $message = str_replace('\\', '&#92;', $message);
  /*'*///Эта строка ничего не значит. Она нужна, чтобы в некоторых редакторах правильно отображалась подсветка кода
	$message = str_replace('
', '', $message); // InetCrack не победит :)

	if (!file_exists($tomb[database])) print "Нет доступа к Базе Данных"; else
	{
		// чтениe информации из Базы Данных
    include ($tomb[database]);
    $value = unserialize($value);
    if (is_array($value)){
  		if (($nick != 'nick') && ($message != 'message'))
  		{	// цикл добавления новых сообщений
  			$int = $tomb[max_total]-1;
  			$_int = $int-1;
  			if ($message != $value[0]["_message"]){
  				while ( ($int >= 0)&&($_int >= -1))
  				{
  					if (($int == 0)&&($_int == -1)) {
  					$value[$int]["_nick"] = $nick;
  					$value[$int]["_message"] = $message;
  					$value[$int]["_ip"] = $ip;
  					$value[$int]["_date"] = $date;
  					} else {
  					$value[$int]["_nick"] = $value[$_int]["_nick"];
  					$value[$int]["_message"] = $value[$_int]["_message"];
  					$value[$int]["_ip"] = $value[$_int]["_ip"];
  					$value[$int]["_date"] = $value[$_int]["_date"];
  					}
  					$int--;
  					$_int--;
  				}
  			} else {
          echo '<script>alert("Флудить - это нехорошо!");</script>';
        }
  			// запись в Базу Данных
  			$fp = @fopen($tomb[database], "w");
  			@$this->lockFile($fp,1);
  			if (!$fp) {print "Нет доступа к Базе Данных";} else
  			{
  				$buf = serialize($value);
  				$temp = '<?$value = '."'".$buf."';?>";
  				fwrite($fp, $temp);
  				@$this->lockFile($fp,3);
  				fclose($fp);
  				return $value;
  			}
  		}
		} else {
      echo '<FONT color="#FF0000">Повреждена База Данных!</FONT>';
    }
	}
}
function read_db($db){
	// Чтение Базы Данных и возврат её в виде массива
	global $tomb;
	include($db);
	$buf=unserialize($value);
	return $buf;
}
function print_msgs($min , $max , $value){
  global $tomb;
	print "<script language='JavaScript' type='text/javascript'>\n";
	$int = $min;
  $toOut = '';
	while ($int < $max)
	{
		// Обработка ника пользователя
		$nick = $value[$int]["_nick"];

		$nick = str_replace('<', '&lt;', $nick);
		$nick = str_replace('>', '&gt;', $nick);

		// Обработка сообщения пользователя
		$message = $value[$int]["_message"];

 		$message = str_replace('<', '&lt;', $message);
 		$message = str_replace('>', '&gt;', $message);
    // укорачивание слишком длинных слов
    $maxWrd_pattern = '#([\S]{'.$tomb[max_word].'})#i';
    $message = preg_replace($maxWrd_pattern , "$1 ", $message);
    // обработка гиперссылок
    if ($tomb[show_url] == 1){
      $message = preg_replace('#(^|\s)((http|https|news|ftp)://\w+[^\s\[\]\<]+)#i'  , "$1<a href='$2' target='_blank' id='msgLink'>$2</a>", $message);
    }
		$date = $value[$int]["_date"];
		$toOut .= 'cm ("'.$nick.'", "'.$message.'", "'.$date.'", '.$int.');'."\n";
		$int+=1;
	}
  print ($toOut).'</script>'."\n";
}
}
$database = new library2();
?>
