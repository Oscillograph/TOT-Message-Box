<?
/*====================================================
������ Smiler v0.1
---
� ���������� ��������� �������: ���������
������������ ������ ��� ����� ������� ToMBAdmin
======================================================*/

// �������� ����������� ������������
if (isset($logged)&&$logged==true){
  if ($_SERVER[REQUEST_METHOD]=='POST'){
    // ���� ���������� ������ � ������� $sm_code � $sm_url
    // ��� ������ $sm[], ������� ����� ������� ���� code:string, url:string, selected:boolean
    // $sm[code] ; $sm[url] ; $sm[selected]
    // ����� - ���������� ������� $sm - "������ � ����" � �������������
    $sm_code = array();
    for ($k = 0; isset($_POST['sm_code'.$k]); $k++){ // ���� ����� ���������
      $nextEl = count($sm_code);
      $sm_code[$nextEl] = $_POST['sm_code'.$k];
    }
    $sm_url = array();
    for ($k = 0; isset($_POST['sm_url'.$k]); $k++){ // ���� ������� ���������
      $nextEl = count($sm_url);
      $sm_url[$nextEl] = $_POST['sm_url'.$k];
    }
    $sel = array();
    for ($k = 0; $k < count($sm_code); $k++){ // ���� ��������� ���������
      if (isset($_POST['sel'.$k])){
        $nextEl = count($sel);
        $sel[$nextEl] = $k;
      }
    }
    $sm = array();
    $step = 0; // ��������� ������������� ������� �������� ������� ��������� (�� �������� ����� � ������� ��������
    $s = 0; // ������� ���������� ������� �� ��������
    $k = 0; // ������� ������� ������� $sm ,  ���� ����� ������������ ����� �������� ( [0] - ��� ������, [1] - ����� ��������)
    for ($k = 0; $k < count($sm_code) && $step < count($sm_code); $k++){
      // �������� ������������ �� �������� "����� ���� ����� ��������� - ������� +1" ������� ��������� �� ��������� ������������� ������� �� �������� ����� � �������
      if (isset($sel[$s])){
        if ($step == $sel[$s]){
          $step++;
          if (isset($sel[$s+1])){
            $s++;
          }
        } else {
            $sm[$k] = array($sm_code[$step], $sm_url[$step]);
            $step++;
        }
      } else {
          $sm[$k] = array($sm_code[$step], $sm_url[$step]);
          $step++;
      }
    }
    $out = 'var sm_code = new Array(); var sm_url = new Array();'."\n"; // ������ ���������� ������ ���������.
    for ($k = 0; isset($sm[$k]); $k++){ // �������� ������������ � ������ ��������� ������ � ����� smiles.js
      $sm[$k][0] = str_replace("'", '&#39;', $sm[$k][0]);
      $sm[$k][0] = str_replace('"', '&#34;', $sm[$k][0]);
      $sm[$k][0] = str_replace('>', '&gt;',  $sm[$k][0]);
      $sm[$k][0] = str_replace('<', '&lt;',  $sm[$k][0]);
      $sm[$k][0] = str_replace('\\', '&#92;',$sm[$k][0]);
      /*'*///��� ������ ������ �� ������. ��� �����, ����� � ��������� ���������� ��������� ������������ ��������� ����
      
      $sm[$k][1] = str_replace("'", '&#39;', $sm[$k][1]);
      $sm[$k][1] = str_replace('"', '&#34;', $sm[$k][1]);
      $sm[$k][1] = str_replace('>', '&gt;',  $sm[$k][1]);
      $sm[$k][1] = str_replace('<', '&lt;',  $sm[$k][1]);
      $sm[$k][1] = str_replace('\\', '&#92;',$sm[$k][1]);
      /*'*///��� ������ ������ �� ������. ��� �����, ����� � ��������� ���������� ��������� ������������ ��������� ����
    
      $out.= 'sm_code['.$k.'] = "'.$sm[$k][0].'"; sm_url['.$k.'] = "'.$sm[$k][1].'";'."\n";
    }
    // ���������� �����, ���� ������ ������� �����
    write_file('../smiles.js', $out);
    echo 'sel: '.count($sel).'; smiles: '.count($sm).'; codes: '.count($sm_code).'; urls: '.count($sm_url) ;
  }
  // ����������� ��������, ���� ������������ �����������
?>

<form action="./?c=smiles" method="POST" name="formid" id="formid">
<div style="height:400px; overflow:auto;" align="CENTER">
<table width="50%" align=center id='table' name='table'>
  <tr height=20 valign=middle>
    <td colspan="4"><span style="color:#FF0000; font-size:12px">��������! ��� �������� �������������� ������ ��� <b>Mozilla FireFox</b> � <b>Opera</b> (Gecko-��������)</span></td>
  </tr>
  <tr height=20 valign=middle>
    <td align="CENTER">�����</td>
    <td align="center">���</td>
    <td align="center">URL-����� ��������</td>
    <td align="center">�������</td>
  </tr>
<!--</table>
<table width="50%" align=center id='table'>
  <tr height=20 valign=middle>-->
<script src='../smiles.js' type='text/javascript'></script>
<script language="javascript" type='text/javascript'>
function deleteSm(el){
  if(confirm('�� ������������� ������ ������� ���� �������?\n��� ����������� ��������.')){
    if(!document.getElementById('sel'+el.getAttribute('selection')).checked){
      el.parentNode.parentNode.style.display='none';
      document.getElementById('sel'+el.getAttribute('selection')).checked=true;
      if (document.getElementById('sel'+el.getAttribute('selection')).checked){
        alert(el+' Deleted !');
      }
     // el.form.elements(el-1).checked=true;
    }
//    el.parentNode.parentNode.style.display="none";
//    el.parentNode.parentNode.firstChild.nextSibling.getElementById('sel'+el.getAttribute('selection')).checked=true;
  }
}
var k=0;
for (i=0; i<sm_url.length && i<sm_code.length; i++){
	document.write('<tr height=30 valign=middle>');

  if (sm_url[i].substr(0,2)!='./'){
  	document.write('<td align=center>');
  	document.write('<img src="'+sm_url[i]+'">');
    document.write('<'+'/td>');
  } else {
    document.write('<td align=center>');
    document.write('<img src=".'+sm_url[i]+'">');
    document.write('<'+'/td>');
  }

  document.write('<td align="CENTER">');
  document.write('<input type="TEXT" size="8" maxlength="80" name="sm_code'+i+'" value="'+sm_code[i]+'">');
	document.write('<'+'/td>');

  document.write('<td align="CENTER">');
  document.write('<input type="TEXT" size="30" maxlength="80" name="sm_url'+i+'" value="'+sm_url[i]+'">');
	document.write('<'+'/td>');
	
  document.write('<td align="CENTER">');
  document.write('<input type="CheckBox" value="1" name="sel'+i+'" style="display:block;" id="sel'+i+'">');
//  document.write('<input type="BUTTON" value="X" onClick="deleteSm(this)" selection="'+i+'" style="width:40px">');
	document.write('<'+'/td>');

	document.write('<'+'/tr>');
}
function addSmile(){
  if(navigator.userAgent.indexOf('MSIE')<0){
    tab = document.getElementById('table');

    tr1 = document.createElement('tr');
    tr1.style.height='30px';
    //tr1.style.display='block';
    tr1.style.verticalAlign='middle';
    tab.appendChild(tr1);

    td1 = document.createElement('td');
    td1.style.textAlign='center';
    td1.innerHTML='';
    tr1.appendChild(td1);

    td2 = document.createElement('td');
    td2.style.textAlign='center';
    td2.innerHTML='<input type="TEXT" size="8" maxlength="80" name="sm_code'+i+'" value=" ">';
    tr1.appendChild(td2);

    td3 = document.createElement('td');
    td3.style.textAlign='center';
    td3.innerHTML='<input type="TEXT" size="30" maxlength="80" name="sm_url'+i+'" value=" ">';
    tr1.appendChild(td3);

    td4 = document.createElement('td');
    td4.style.textAlign='center';
    td4.innerHTML='<input type="CheckBox" value="1" name="sel'+i+'" style="display:block;" id="sel'+i+'">';
    tr1.appendChild(td4);

    tr1.firstChild.nextSibling.firstChild.focus();
    i++;
  } else {
    alert ('���� !!!');
    tab = document.getElementById('table');
    //el = table.appendChild(document.createElement('tr'));
    //el.style.height='30px';
    //el.style.verticalAlign='middle';
    tab.innerHTML+='<tr height="30" valign="MIDDLE"><td align=center><'+'/td><td align="CENTER"><input type="TEXT" size="8" maxlength="80" name="sm_code'+i+'" value=" " id="sm_code'+i+'"><'+'/td><td align="CENTER"><input type="TEXT" size="30" maxlength="80" name="sm_url'+i+'" value=" "><'+'/td><td align="CENTER"><input type="CheckBox" value="1" name="sel'+i+'" style="display:block;" id="sel'+i+'"><'+'/td><'+'/tr>';
    document.getElementById('sm_code'+i).focus();
    i++;
  }
}
</script>

</table>
</div>
<br>
<div align="CENTER">
<input type="SUBMIT" value="������ ���������">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="BUTTON" onclick="addSmile()" value="�������� �������">
</div>
</form>

<?}?>
