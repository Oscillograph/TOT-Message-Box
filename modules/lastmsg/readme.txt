+-------------------------------------------------------------+
| Mодуль LastMessages v0.1                                    |
| Распространяется как дополнительный модуль к мини-чату ToMB |
+-------------------------------------------------------------+
|                                                             |
| Для использования добавьте в HTML-код Вашей страницы        |
| строки                                                      |
|                                                             |
| <script type='text/javascript'                              |
| src='http://ваш_сайт/папка_чата/modules/lastmsg/index.php'> |
| </script>                                                   |
|                                                             |
| Скрипт вернёт 4 JavaScript-массива, хранящих соответственно |
| IP автора сообщения, дату отправки сообщения, ник автора и  |
| собственно сообщение: ip, date, nick, msg                   |
|                                                             |
| Простейший JavaScript-сценарий, использующий эти массивы для|
| отображения на странице:                                    |
|                                                             |
| <script type='text/javascript'>                             |
| for (i=0; i<ip.length; i++){                                |
|   document.write('<b>'+nick[i]+'<'+'/b>: '+msg[i]+' ('+     |
|                       date[i]+')'+' <i>'+ip[i]+'<'+         |
|                       '/i><br>');                           |
| }                                                           |
| </script>                                                   |
|                                                             |
| Чтобы изменить количество выводимых сообщений (по умолчанию |
| 2), измените в файле script.php этого модуля значение       |
| переменной $view .                                          |
|                                                             |
+-------------------------------------------------------------+
