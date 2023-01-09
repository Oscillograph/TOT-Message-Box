<?
if (!isset($_SESSION['login'])){//&&!isset($_SESSION['password'])){
 if (isset($_POST['login'])&& isset($_POST['password'])){
   $login = $_POST['login'];
   $password = $_POST['password'];
   if ($login==$tomb[user] && $password==$tomb[pass]){
     session_register($login);$logged=true;//,$password); $logged = true;
     $_SESSION['login']=$login; $logged=true; //$_SESSION['password']=$swd; $logged = true;
   } else {
     adderror('Ќеверный логин или пароль (отказано в доступе)'."\n",'');
   }
 }
} else {
   $logged = true;
}
?>
