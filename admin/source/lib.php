<?
//################ ���������� #####################

$error = array(); //������ � ����������� � ������������ �� ������� ������ �������� �������
$logged = false;  //���������� �������������� (����� ��������� ������ auth.php ����� ������� �������� true)

//################    �������    ##################

//// ����� ������������ ������� �� ������� Exclusive Bulletin Board v1.9.1 ////
function lock_file(&$file,$mode = 2) {
  if ( preg_match('/[c-z]:\\\.*/i', $_SERVER['PATH']) ) return;
  $i = 0;
  while ( !flock($file,$mode) ) {
      sleep(1);
      $i++;
      if ($i>=10) {
          @fclose($file);
          die('<font color="#FF0000">������ ������������ �����</font>');
      }
  }
}
//////////////////////////////////////////////////////////////////////////////

function write_file($file,$data){// ������ � ����
  $fp=@fopen($file,"w");
  if($fp){
      lock_file($fp,1);
      fwrite($fp,$data);
      lock_file($fp,3);
      fclose($fp);
  } else {
       adderror('���������� ����������� � ������ '.$file.' ��� ������.');
  }
}
function read_file($file,&$data){// ������ �� �����
  if(file_exists($file)){
    $data = file($file);
  } else adderror('���������� ����������� � ������ '.$file.' ��� ������.');
}
function adderror($text,$self){//���������� � ������ $error ������ ������ � ���������� ��������� ������ � ����� error.log
  global $error;
  $next=count($error);
  $error[$next]=$text;
  $out='['.date("Y.M.d h:m:s").']('.$_SERVER[REMOTE_ADDR].')='.$text.' ;'."\n";
  if (empty($self)){
    add2file('./error.log',$out);
  }
}
function add2file($file,$text){ //���������� ���������� � ����� �����
  $fp=@fopen($file,"a");
  if($fp){
      fwrite($fp,$text);
      fclose($fp);
  } else adderror('���������� ����������� � ������ '.$file.' ��� ������ ��������� ������ ������� ���������� ��������.');
}
function viewerror(){ //����������� ������ �� ������� ������ ��������
  global $error;
  echo '<font color=#ff0000 style="font-size:13px;">';
  for ($k=0;$k<count($error);$k++){
      echo ($k+1).': '.$error[$k].'<br>';
  }
  echo '</font>';
}
?>
