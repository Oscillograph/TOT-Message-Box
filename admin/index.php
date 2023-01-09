<?
  session_start();
  include ('../config.php');
  include ('./source/lib.php');
  include ('./source/auth.php');
  if($logged){
    include ('./source/headers.htm');
?>
  <body>
  <table width=800 bgcolor=#FCF2AF align="center">
    <tr>
      <td valign="MIDDLE" style="text-align:center;" width="800" height="100" colspan="2">
      <a href="http://totservis.yard.ru/" target="_blank">
        <img src="./im/tomblogo.jpg" border=0 align="MIDDLE">
      </a>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign=top>
      <td width=150 valign=top align="CENTER" bgcolor="#FDF7CA">
      <?include('./source/leftbar.htm');?>
      </td>
      <td width=650>
        <?
            if (count($_GET)>0){
               if(isset($_GET['c'])){
                  switch($_GET['c']){
                     case 'logout': include('./units/logout.php');break;
                     case 'moderation': include('./units/moderation.php');break;
                     case 'smiles': include('./units/smiles.php');break;
                     case 'codes': include('./units/codes.php');break;
                     case 'preview': include('./units/preview.php');break;
                     case 'tombconf': include('./units/tombconf.php');break;
                     case 'custom': include('./units/customcodes.php');break;
                     default : include('./source/404.htm');
                  }
               } else {
                 include('./source/404.htm');
               }
             }
  } else {
    include('./units/login.php');
  }
  if (count($error)>0){ viewerror(); }
        ?>
      </td>
    </tr>
  </table>
  </body>
</html>
