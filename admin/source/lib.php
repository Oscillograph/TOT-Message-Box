<?
//################ переменные #####################

$error = array(); //массив с информацией о произошедших за текущую работу сценария ошибках
$logged = false;  //переменная аутентификации (после включения модуля auth.php может принять значение true)

//################    функции    ##################

//// Здесь использована функция из скрипта Exclusive Bulletin Board v1.9.1 ////
function lock_file(&$file,$mode = 2) {
  if ( preg_match('/[c-z]:\\\.*/i', $_SERVER['PATH']) ) return;
  $i = 0;
  while ( !flock($file,$mode) ) {
      sleep(1);
      $i++;
      if ($i>=10) {
          @fclose($file);
          die('<font color="#FF0000">Ошибка блокирования файла</font>');
      }
  }
}
//////////////////////////////////////////////////////////////////////////////

function write_file($file,$data){// Запись в файл
  $fp=@fopen($file,"w");
  if($fp){
      lock_file($fp,1);
      fwrite($fp,$data);
      lock_file($fp,3);
      fclose($fp);
  } else {
       adderror('Невозможно соединиться с файлом '.$file.' для записи.');
  }
}
function read_file($file,&$data){// Чтение из файла
  if(file_exists($file)){
    $data = file($file);
  } else adderror('Невозможно соединиться с файлом '.$file.' для чтения.');
}
function adderror($text,$self){//добавление в массив $error текста ошибки и сохранение протокола ошибки в файле error.log
  global $error;
  $next=count($error);
  $error[$next]=$text;
  $out='['.date("Y.M.d h:m:s").']('.$_SERVER[REMOTE_ADDR].')='.$text.' ;'."\n";
  if (empty($self)){
    add2file('./error.log',$out);
  }
}
function add2file($file,$text){ //добавление информации в конец файла
  $fp=@fopen($file,"a");
  if($fp){
      fwrite($fp,$text);
      fclose($fp);
  } else adderror('Невозможно соединиться с файлом '.$file.' для записи протокола ошибок периода выполнения сценария.');
}
function viewerror(){ //отображение ошибок за текущую работу сценария
  global $error;
  echo '<font color=#ff0000 style="font-size:13px;">';
  for ($k=0;$k<count($error);$k++){
      echo ($k+1).': '.$error[$k].'<br>';
  }
  echo '</font>';
}
?>
