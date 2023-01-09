<?
  session_start();
  include ('./source/lib.php');
  include ('./source/help_headers.htm');
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
      <?include('./source/help_leftbar.htm');?>
      </td>
      <td width=650>
        <?
             if(count($_GET)>0){
               if(isset($_GET['c'])){
                  switch($_GET['c']){
                     case 'moderation': include('./helpfiles/moderation.php');break;
                     case 'smiles': include('./helpfiles/smiles.php');break;
                     case 'preview': include('./helpfiles/preview.php');break;
                     case 'tombconf': include('./helpfiles/tombconf.php');break;
                     case 'readme': echo '<textarea cols=74 rows=28>';include('../readme.txt');echo '</textarea>';break;
                     default : include('./source/404.htm');
                  }
               } else {
                 include('./source/404.htm');
               }
             }
  if (count($error)>0){ viewerror(); }
        ?>
      </td>
    </tr>
  </table>
  </body>
</html>