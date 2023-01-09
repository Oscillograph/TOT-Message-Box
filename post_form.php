<? include ('./config.php');?>
<script language="JavaScript" type="text/javascript">
var fileName = 'post_form.php';
function subm(f){
   if (f.nick.value.length>3 && f.message.value.length>3 && f.message.value!='message' && f.nick.value!='nick'){
     f.submit();
     f.message.value=' ';
   } else {
     alert('Не все поля заполнены!');
   }
   return false;
}
function show_smiles(){ // показ смайликов
	if (document.post_form.message.value=='message') { document.post_form.message.value=' '; }
	var sm = window.open('./viewsmiles.htm', '', 'scrollbars=1, resizable=0, width=300, height=350, left=100, top=100');}
function show_help(w,h){ // показать Справку чата
	var help = window.open('./viewhelp.htm', '', 'scrollbars=1, resizable=1, width='+w+', height='+h+', left=100, top=100');}
</script>

<html>
  <head>
    <META content="text/html; charset=windows-1251" http-equiv=Content-Type>
    <meta name='author' content='Copyright (c) ТехнОкраТ aka Каменский Кирилл, 2006'>
    <title>Tot Message Box Posting Form</title>
    <link href="./skins/<?=$tomb[skin];?>/chat.css" rel="StyleSheet" type="text/css">
  </head>
  <body>
    <table class="form"><tr height=30><td>
      <form action="chat.php" target="chat" method="post" name="post_form" id="post_form" onsubmit="/*this.submit();this.message.value='';*/return subm(this);">
      <input type=text maxlength="20" class="nick" name="nick" id="nick" size=10 value="nick" onFocus="if(this.value=='nick') this.value='';" onBlur="if (this.value.length<2){this.value=this.className;}">
      <input type=text maxlength="<?=$tomb[max_str];?>" class="message" name="message" id="message" size="25" value="message" onFocus="if(this.value=='message') this.value='';" onBlur="if (this.value.length<1){this.value=this.className;}">
      <input type=submit value="OK" class="submit"><br>
        <div align=center>
        <a href="javascript:show_smiles();">Показать смайлики</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:show_help(300,400);">Помощь</a>
        </div>
      </form>
    </td></tr>
    </table>
    <script language="JavaScript" type="text/javascript">
    <!--
    // FastBB :: автоматическое добавление ника авторизованного участника в поле ввода
    var nick = document.post_form.nick.value;
    if (null != window.opener){
     if (null != window.opener.nick){
        if(window.opener.nick.length>=2){ nick = window.opener.nick;
        }
     } else { nick = 'nick';}
    } else if(null != window.parent) {
     if(null != window.parent.nick){
       if(window.parent.nick.length>=2){ nick = window.parent.nick;
       }
     } else { nick = 'nick';}
    } else { nick = 'nick';}
    //-->
    </script>
  </body>
</html>
