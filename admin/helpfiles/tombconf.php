<?
/*====================================================
������ Configurator v0.2
---
� ���������� ��������� �������: ���������
������������ ������ ��� ����� ������� ToMBAdmin
======================================================*/

if(isset($logged)&&$logged==true){
  if($_SERVER[REQUEST_METHOD]=='POST'){
    // ������ ��������
    include ('.'.$tomb[library]); // �������� ���������� ��� ������ � �������� $database
    // ��������� ������� ���������� ������
    // ���������� ���������� ������� (�� ������� != )
    if ($tomb[database]!= $_POST[database] && is_string($_POST[database])) {
       $tomb[database] = $_POST[database];
    }
    if ($tomb[max_word]!= (integer)$_POST[max_word]) {
       $tomb[max_word] = (integer)$_POST[max_word];
    }
    if ($tomb[max_view]!= (integer)$_POST[max_view]) {
       $tomb[max_view] = (integer)$_POST[max_view];
    }
    if ($tomb[max_total]!= (integer)$_POST[max_total]) {
       $tomb[max_total] = (integer)$_POST[max_total];
       $database->init($database->read_db('.'.$tomb[database]), $tomb[max_total], '.'.$tomb[database]); // ������, ��������� � ���������� ����� ��������� ��
    }
    if ($tomb[refresh_time]!= (integer)$_POST[refresh_time]) {
       $tomb[refresh_time] = (integer)$_POST[refresh_time];
    }
    if ($tomb[max_str]!= (integer)$_POST[max_str]) {
       $tomb[max_str] = (integer)$_POST[max_str];
    }
    if ($tomb[skin]!= $_POST[skin]) {
       $tomb[skin] = $_POST[skin];
    }
    if ($tomb[smiles] != $_POST[smiles]){
       $tomb[smiles] = $_POST[smiles]==1 ? 1:0;
    }
    if ($tomb[show_codes] != $_POST[show_codes]){
       $tomb[show_codes] = $_POST[show_codes]==1 ? 1:0;
    }
    if ($tomb[show_url] != $_POST[show_url]){
       $tomb[show_url] = $_POST[show_url]==1 ? 1:0;
    }
    if ($tomb[show_date] != $_POST[show_date]){
       $tomb[show_date] = $_POST[show_date]==1 ? 1:0;
    }
    if ($tomb[library] != $_POST[library] && file_exists('.'.$_POST[library])){
       $tomb[library] = $_POST[library];
       $data = $database->read_db('.'.$tomb[database]);
       unset($database); // �������� ��������� �� � ������� ������ ������ ���������
       include ('.'.$tomb[library]);
       $database->init($data, $tomb[max_total], '.'.$tomb[database]); // ������, ��������� � ���������� ����� ��������� ��
    } elseif (!file_exists('.'.$_POST[library])){
       adderror('�� ������� ���������� ".'.$_POST[library].'".','');
    }
    if ($tomb[user] != $_POST[user]){
       $tomb[user] = $_POST[user];
    }
    if ($tomb[pass] != $_POST[pass]){
       $tomb[pass] = $_POST[pass];
    }
    $int = 0;
    reset($tomb);
    while(list($index,$data) = each($tomb)) { // �������� ������������ ������� �� �� HTML-�����������
      $tomb[$index] = str_replace("'", '&#39;', $tomb[$index]);
      $tomb[$index] = str_replace('\\', '&#92;', $tomb[$index]);
      $tomb[$index] = str_replace('"', '&#34;', $tomb[$index]);
    }

    /*"*///��� ������ ������ �� ������. ��� �����, ����� � ��������� ���������� ��������� ������������ ��������� ����

    // ���������� ��������� � ����� (!�������!) ����������� �������� ������� ������ ���� ���������
    $out = "<?\n";
    reset($tomb);
    while(list($index,$data) = each($tomb)) {
      $out .= '$tomb['.$index.']='."'".$data."';\n";
    }
    $out .= '?>';
    if (is_writeable('../config.php')) {
      write_file('../config.php',$out);
    } else {
      adderror('��� ���� �� ������ � ���� ������������. ���������, ��� �� ���� config.php ����������� ����� ������� (CHMOD) 666','');
    }
  }
?>
<form action="./?c=tombconf" method="POST" target="_self">
  <table bgcolor=#FDF7CA width=90%>

  <tr><td colspan=2>������ ToMB: <b><?=$tomb[version];?></b></td></tr>

  <tr><td>����� �������������� : </td><td> <input type=text name=user maxchar=80 size=10 value="<?=$tomb[user];?>"></td></tr>
  <tr><td>������ ��������������: </td><td> <input type=text name=pass maxchar=80 size=10 value="<?=$tomb[pass];?>"></td></tr>

  <tr><td>���� ������: </td><td> <input type=text name=database maxchar=80 size=10 value="<?=$tomb[database];?>"></td></tr>
  <tr><td>������������ ���������� ���������: </td><td> <input type=text name=max_total maxchar=80 size=10 value="<?=$tomb[max_total];?>"></td></tr>
  <tr><td>������������ ����� ���������: </td><td> <input type=text name=max_str maxchar=80 size=10 value="<?=$tomb[max_str];?>"></td></tr>
  <tr><td>������������ ����� ����� � ���������: </td><td> <input type=text name=max_word maxchar=80 size=10 value="<?=$tomb[max_word];?>"></td></tr>
  <tr><td>���������� ���������: </td><td> <input type=text name=max_view maxchar=80 size=10 value="<?=$tomb[max_view];?>"></td></tr>
  <tr><td>���������� ������� � ����������� (� ���.):<br><span style="font-size:12px">(������� 0, ����� ��������� ��������������)</span> </td><td> <input type=text name=refresh_time maxchar=80 size=10 value="<?=$tomb[refresh_time];?>"></td></tr>
  <tr><td>������������ �����: </td><td> <input type=text name=skin maxchar=80 size=10 value="<?=$tomb[skin];?>"></td></tr>
  <tr><td>������������ ���������� �����������: </td><td> <input type=text name=library maxchar=80 size=10 value="<?=$tomb[library];?>"></td></tr>
  <tr><td>������������ ��������: </td><td><input type="CHECKBOX" value="1" name="smiles" <? if($tomb[smiles]==1) echo 'checked'; ?>></td></tr>
  <tr><td>������������ BB-���� : </td><td><input type="CHECKBOX" value="1" name="show_codes" <? if($tomb[show_codes]==1) echo 'checked'; ?>></td></tr>
  <tr><td>������������ ����������� � ����������: </td><td><input type="CHECKBOX" value="1" name="show_url" <? if($tomb[show_url]==1) echo 'checked'; ?>></td></tr>
  <tr><td>���������� ���� �������� ���������: </td><td><input type="CHECKBOX" value="1" name="show_date" <? if($tomb[show_date]==1) echo 'checked'; ?>></td></tr>

  <tr><td colspan="2"><input type=submit value="������ ���������"></td></tr>
  <tr><td></td><td></td></tr>
  </table>
</form>
<?}?>
