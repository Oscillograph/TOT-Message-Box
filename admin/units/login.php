<style type='text/css'>
#login{
       background-color:#FDF7CA;
       text-align:center;
       border: 0px;
       font-size: 14px;
       color:#000000;
       font-family:Verdana;
}
</style>
<form action='./index.php' method=post>
  <table width=95% valign=top align=center id=login>
    <tr>
      <td colspan=2>Необходимо пройти авторизацию.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width=50% style='text-align:right'>
        Логин:
      </td>
      <td width=50% style='text-align:left'>
        <input type=text size=15 name=login value=''>
      </td>
    </tr>
    <tr>
      <td width=50% style='text-align:right'>
        Пароль:
      </td>
      <td width=50% style='text-align:left'>
        <input type=password size=15 name=password value=''>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan=2 align=center>
        <input type=submit value='Войти'>
      </td>
    </tr>
  </table>
</form>
<script language="javascript" type="text/javascript">
 document.forms[0].login.focus();
</script>
