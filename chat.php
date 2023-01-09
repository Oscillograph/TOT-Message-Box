<?
include ('./config.php');
include ($tomb[library]);
?>
<script type="text/javascript">
var max_msg = "<?=$tomb[max_view] ; ?>";
var smiles = <?=$tomb[smiles] ; ?>;
var refresh_time = <?=$tomb[refresh_time] ; ?>;
var isDate = <?=$tomb[show_date] ; ?>;
var isCodes = <?=$tomb[show_codes] ; ?>;
var fileName="chat.php";
</script>
<html>
<head>
  <title>ToMB :: Tot Message Box</title>
  <META content="text/html; charset=windows-1251" http-equiv=Content-Type>
<?if($tomb[refresh_time]>0){?>
  <meta http-equiv="refresh" content="<?=$tomb[refresh_time]; ?>; url=./chat.php?posted=y">
  <?}?>
  <meta name='author' content='Copyright (c) ТехнОкраТ aka Каменский Кирилл, 2006'>
  <meta name="document-state" content="dynamic">
  <link href="./skins/<?=$tomb[skin];?>/chat.css" rel="StyleSheet" type="text/css">
</head>
<body>
  <!-- Определение массивов смайликов -->
  <script language="javascript" type="text/javascript" src="./smiles.js">
  </script>
  <!-- Определение базовых переменных и функций -->
  <script language="JavaScript" type="text/javascript" src="./skins/<?=$tomb[skin];?>/chat.js">
  </script>
  <div class="tableAdd" style="height:100%; width:100%; overflow:auto">
  	<table id="chatTable">
  	<tr height=10 align=center valign=middle>
  		<td class=archive_link align=center width=50%>
  			<a href="javascript:show_archive(300, 400);">Архив</a>
  		</td>
  		<td class=archive_link align=center width=50%>
  			<a href="javascript:reloader()">Обновить</a>
  		</td>
  	</tr>
  	</table>
  	<table id="chatTable">
      <?
      if (isset($_POST["nick"]) && isset($_POST["message"]) && $_GET["posted"]!="y")
      {
      	$value = $database->write_db($_POST["nick"],$_POST["message"], $_SERVER[REMOTE_ADDR], date("H:i (d.m.y)"));
      } elseif (!isset($_POST['nick']) || !isset($_POST['message'])) {
      	$value = $database->read_db($tomb[database]);
      }
      $min = 0;
      if (!is_array($value)) echo '<FONT color="#FF0000">Повреждена База Данных!</FONT>';
      else $database->print_msgs($min , $tomb[max_view], $value);
      ?>
  	</table>
  </div>
</body>
</html>
