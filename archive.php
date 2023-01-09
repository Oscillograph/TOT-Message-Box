<?
include ('./config.php');
include ($tomb[library]);
?>
<script type="text/javascript">
var max_msg = "<?=$tomb[max_view] ; ?>";
var max_str = "<?=$tomb[max_str] ; ?>";
var smiles = <?=$tomb[smiles] ; ?>;
var refresh_time = <?=$tomb[refresh_time] ; ?>;
var isDate = <?=$tomb[show_date] ; ?>;
var isUrl = <?=$tomb[show_url] ; ?>;
var isCodes = <?=$tomb[show_codes] ; ?>;
fileName='archive.php';
</script>
<html>
<head>
  <title>Архив сообщений чата</title>
  <META content="text/html; charset=windows-1251" http-equiv=Content-Type>
<?if($tomb[refresh_time]>0){?>
  <meta http-equiv="refresh" content="<?=$tomb[refresh_time]; ?>; url=./archive.php">
  <?}?>
  <meta name='author' content='Copyright (c) ТехнОкраТ aka Каменский Кирилл Алексеевич, 2006'>
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
			<a href="javascript:window.close();">Закрыть</a>
		</td>
		<td class=archive_link align=center width=50%>
			<a href="javascript:document.location.reload(true);">Обновить</a>
		</td>
	</tr>
	</table>
	<table id="chatTable">
    <?
    $value = $database->read_db($tomb[database]);
    $min = $tomb[max_view]-1;
    $database->print_msgs($min, $tomb[max_total], $value);
    ?>
	</table>
</div>
</body>
</html>
