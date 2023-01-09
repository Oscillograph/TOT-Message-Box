### Tot Message Box v2.27beta (ToMB)

СОДЕРЖАНИЕ:<br />
	1. Инструкция по установке<br />
	2. Инструкция по настройке<br />
	3. Что изменилось в версии 2.27beta ?<br />
	4. Описание файлового архива<br />
	5. Краткое описание стилей чата<br />
	6. Краткое описание js-функций чата<br />
	7. Краткое описание РНР-функций чата<br />
	8. F.A.Q. : часто задаваемые вопросы<br />
	9. Контактная информация<br />





### ИНСТРУКЦИЯ ПО УСТАНОВКЕ ЧАТА :
ВНИМАНИЕ !
Перед тем, как устанавливать чат на Ваш сайт, убедитесь, что Ваш сервер поддерживает технологию РНР 4.3.0 и выше.

1. Разархивируйте файлы чата в каталог tomb на Вашем компьютере.
2. С помощью любого FTP-клиента выложите папку tomb (вместе с её содержимым внутри) в корневой каталог Вашего сайта.
3. Выставьте права доступа (CHMOD) на следующие файлы:

 archive.php - 0755 ( или rwxrw-rw-)<br />
 chat.php - 0755 ( или rwxrw-rw- )<br />
 data.php - 0777 ( или rwx-rwx-rwx )<br />
 post_form.php - 0755 ( или rwxrw-rw- )<br />

   Если Вы собираетесь использовать "ToMBAdmin" Для администрирования своего мини-чата ToMB через web-интерфейс, то Проставьте дополнительно права доступа (CHMOD) следующим файлам:

 config.php - 0666 ( или rw-rw-rw- )<br />
 admin/error.log - 0666 ( или rw-rw-rw- )<br />
 admin/index.php - 0755 ( или rwxrw-rw- )<br />
 admin/help.php - 0755 ( или rwxrw-rw- )<br />




### ИНСТРУКЦИЯ ПО НАСТРОЙКЕ ЧАТА :

1. Введите в адресной строке Вашего браузера адрес, по которому находится Ваш мини-чат.<br />
   Например, http://my_site/tomb/admin , где my_site - название Вашего сайта, а tomb - папка, в которую установлен ТоМВ.<br />
   Введите в поля Логин и пароль следующие данные:<br />
   Логин:                    admin<br />
   Пароль:                   123456<br />
   Нажмите "Войти". Если Всё было сделано правильно, Вы увидите панель администрирования ТоМВAdmin.<br />
   По имеющимся ссылкам Вы можете переходить в модули, входящие в комплект поставки утилиты администрирования ТоМВ и там менять какие-либо специфические настройки (в т.ч. модерировать чат)<br />

   (!) Обязательно зайдите по ссылке "Конфигурирование" и смените пароль и логин администратора! Это поможет Вам обезопасить свой мини-чат и, возможно, сайт от угрозы взлома.<br />
   
2. Для добавления Вашего чата в HTML-код любого Вашего проекта добавьте следующие строки :<br />
```
     <iframe src="http://Ваш_сайт/Папка_чата/chat.php" scrolling=no width="Ширина_чата" height="Высота_чата" name=chat></iframe><br>
     <iframe src="http://Ваш_сайт/Папка_чата/post_form.php" scrolling=no width="Ширина_чата" height="Высота_чата" name=post_form></iframe>
```
   Значения ширины и высоты фреймов чата указывать в пикселях.<br />
   Разумеется, эти фреймы можно вставлять в таблицы, отделять их друг от друга; можно вставлять только один фрейм а можно и создавать отдельные шаблоны, читающие информацию из файлов чата.<br />
   Важно, чтобы Вы помнили о назначении файлов чата:<br />

 chat.php                   --- Показывает отображаемые сообщения чата<br />
 post_form.php              --- Показывает форму отправления сообщения<br />
 archive.php                --- Показывает архив сообщений чата<br />

3. В чате доступны смайлики ( по умолчанию - 24 )<br />
   Вы можете настроить свои смайлики. Для этого настройте массивы sm_code[] и sm_url[] в файле smiles.js<br />
 sm_code[] - массив, содержащий коды вызова смайликов из чата. (Эти коды будут заменены на картинки смайликов)<br />
 sm_url[]  - массив, хранящий адреса картинок смайликов. (Адреса должны соответствовать кодам смайликов из массива sm_code[] )<br />
   Или, если Вы используете интерфейс ToMBAdmin, перейдите по ссылке "Смайлики".<br />








### ЧТО ИЗМЕНИЛОСЬ В ВЕРСИИ 2.27 ?
(или что обновить без переустановки.)
Для обновления версии c 2.2х до 2.27 следует:
1. Обновить в каждом скине файлы chat.js и chat.css<br />
   (Это можно сделать, скачав новые версии шкурок для чата с офиц. сайта производителя ToMB)<br />
2. Удалить все файлы из директории /tomb Вашего сайта, в которой раньше располагался чат, и залить в неё дистрибутив версии 2.27<br />
   (!) Если Вы хотите сохранить сообщения, оставлявшиеся в Вашем чате до текущего апдейта, обновите все файлы, КРОМЕ data.php .<br />

==================
=== Изменения, коснувшиеся чата в версии 2.27 :

1.  Теперь новые окна корректно открываются в Microsoft Internet Explorer 6.0 и выше, а также в Mozilla FireFox 1.5.0.6 и выше.
2.  Сокращены, по возможности, размеры файлов, разработаны и применены менее ресурсоёмкие алгоритмы чата.
3.  В сообщения чата теперь возможно вставлять гиперссылки!
4.  Слегка изменена структура таблиц в файлах archive.php и chat.php . Теперь, если страница будет растягиваться в ширину из-за малого количества пробелов в сообщениях чата, ссылки на архив и обновление фрейма сообщений будут оставаться на месте и не будут "уплывать" вправо (Если, конечно, размер фрейма не будет слишком маленьким в ширину).
5.  Добавлена возможность управлять максимальным размером слова в сообщении (Полезно, когда в чат отправляется какое-нибудь сообщение без пробелов, а фрейм сообщений чата растягивается в ширину)
6.  Закрыта дырка в алгоритме заполнения базы данных чата. Теперь ник и сообщение пользователя обрезаются по длине не только при отображении формы отправки сообщения, но и при получении отправленных данных.
7.  Закрыта дырка в обработке запроса на отправку сообщения в чат. При использовании для отправки поста сторонних форм или такой программы, как InetCrack, некорректно обрабатывался символ перевода строки. В результате на стороне клиента сообщения не показывались, хотя база данных была цела.
8.  Теперь возможно разделять слишком длинные слова на меньшие по размеру. Это сделано для того, чтобы слишком длинные слова не растягивали черезчур в ширину фрейм сообщений.
9.  Если раньше файловый манипулятор по отношению к базе данных чата открывался один раз за обновление страницы (или два раза, если при этом была перед обновлением страницы отправка сообщения), то теперь файловый манипулятор открывается тогда и только тогда, когда необходимо произвести изменения (добавление сообщения), а сама база данных автоматически вставляется в текущий экземпляр chat.php .
10. Теперь форма отправки сообщения не генерируется скриптом на стороне клиента, а поступает статчным HTML-кодом в браузер. Это позволило сократить минимально необходимый для работы чата размер JS-файлов до 2.13 КБ .
11. Вместо перекрывающих друг друга подпрограмм в чате реализован Объектно-ориентированный движок, включающий в себя единый класс $database. Разработка дополнительных библиотек к чату стала гораздо проще и качественнее.

### ОПИСАНИЕ ФАЙЛОВОГО АРХИВА ToMB v2.20-3
admin             : папка модуля ToMBAdmin<br />
__units           : папка, в которой лежат вспомогательные модули, обеспечивающие комфортное управление мини-чатом<br />
____moderation.php : модуль ModeRAT - модерирование чата<br />
____tombconf.php   : модуль Configurator - конфигурирование чата<br />
____preview.php    : модуль Previewer    - превью мини-чата<br />
____login.php      : вход в админ-панель<br />
____logout.php     : выход из админ-панели<br />
____smiles.php     : (В некоторых версиях) модуль Smiler - управление смайликами мини-чата<br />
__source          : папка с ресурсными файлами админ-панели<br />
__im              : папка с изображениями для админ-панели<br />
__helpfiles       : папка с файлами справки, вызываемыми из админ-панели<br />
__error.log       : журнал ошибок, произошедших во время работы админ-панели<br />
__index.php       : главный "рабочий" файл админ-панели<br />
__help.php        : файл справки по админ-панели<br />
skins             : папка, в которой хранятся файлы скинов чата<br />
__original        : скин чата по умолчанию<br />
____chat.css      : файл CSS-форматирования<br />
____chat.js       : файл JS-сценариев (определение функций, переменных)<br />
modules           : папка, в которой будут храниться доп. модули чата<br />
sm                : папка со смайликами<br />
 chat.php         : фрейм сообщений<br />
 post_form.php    : фрейм формы отправки сообщения<br />
 archive.php      : фрейм сообщений архива чата<br />
 viewhelp.js      : файл, показывающий инструкцию к чату<br />
 smiles.js        : файл с массивами sm_code[] и sm_url[] , хранящими информацию о смайликах<br />
 viewsmiles.js    : файл, строящий таблицу со смайликами для ссылки "Показать смайлики"<br />
 index.htm        : страница с примерами использования чата (вводный пример)<br />
 data.php         : База Данных Сообщений<br />
 library1.php     : файл-библиотека функций (Для "бесплатного" хостинга)<br />
 library2.php     : файл-библиотека функций (Для "платного" хостинга)<br />
 config.php       : файл с массивом $tomb[] настроек чата<br />
 .htaccess        : файл с настройками отображения ошибок скрипта. При необходимости - удалить.<br />

### КРАТКОЕ ОПИСАНИЕ СТИЛЕЙ ЧАТА
#chatTable {}                     --- Стиль таблицы сообщениямй<br />
#chatTable TR {}                  --- Стиль строк таблицы сообщений<br />
.tableAdd {}                      --- Стиль расположения таблицы сообщений<br />
.light {}                         --- Стиль "светлый" сообщений чата<br />
.dark {}                          --- Стиль "тёмный" сообщений чата<br />
span.nick {}                      --- Стиль отображения ника<br />
span.date {}                      --- Стиль отображения даты сообщения<br />
body {}                           --- Стиль отображения тела документа (для всех фреймов)<br />
table.form {}                     --- Стиль отображения таблицы с формой отправки сообщения<br />
input.nick {}                     --- Стиль поля ввода ника<br />
input.message {}                  --- Стиль поля ввода сообщения<br />
input.submit {}                   --- Стиль кнопки отправления сообщения<br />
a:link, a:visited, a:active {}    --- Стиль всех ссылок в чате<br />
.archive_link a:hover {}          --- Стиль ссылки "Архив" и всех, находящихся в соответствующей строке<br />
.archive_link {}                  --- Стиль Строки с ссылками "Архив" и "Обновить"<br />
#msglink:hover {}                 --- Стиль гиперссылки в сообщении (указатель над ссылкой)<br />
#msglink:link {}                  --- Стиль гиперссылки в сообщении (непосещённая ссылка)<br />
#msglink:visited {}               --- Стиль гиперссылки в сообщении (посещённая ссылка)<br />
#msglink:active {}                --- Стиль гиперссылки в сообщении (текущая ссылка)<br />


### КРАТКОЕ ОПИСАНИЕ JS-ФУНКЦИЙ ЧАТА
show_archive()                    --- Отображение нового окна с архивом сообщений<br />
show_smiles ()                    --- Отображение нового окна со смайликами<br />
show_help()                       --- Отображение нового окна с инструкцией пользователю<br />
isForm()                          --- Проверяет, существует ли в окне-родителе фрейма ссылка на фрейм с формой отправки сообщения в чат<br />
addNick()                         --- Добавляет в форму отправки сообщения (если она есть) ник пользователя, на который кликнул посетитель чата во фрейме сообщений<br />
cm()                              --- Отображение сообщения<br />


### КРАТКОЕ ОПИСАНИЕ РНР-ФУНКЦИЙ ЧАТА
$database                        --- Класс, представляющий собой объект Базы Данных чата<br />
$database->read_db()             --- Чтение сообщений из Базы Данных (Возвращается массив $data)<br />
$database->write_db()            --- Запись сообщений в Базу Данных  (Вовращает изменённый массив $data с текущим состоянием БД)<br />
$database->lock_file()           --- Заимствованная функция блокировки файлов из скрипта ExBB ( http://exbb.net )<br />
$database->print_msgs()          --- Отвечает за отображение сообщений чата, расположенных в множестве [min;max].<br />
$database->init()                --- Создание экземпляра Базы Данных. На входе принимает массив имеющегося экземпляра, количество элементов для создаваемого экземпляра и адрес файла БД (если последний не указан - метод возвращает сериализованный массив БД)<br />

				     Пример использования из archive.php :<br />

    $value = $database->read_db($tomb[database]);<br />
    $min = $tomb[max_view]-1;<br />
    $database->print_msgs($min, $tomb[max_total], $value);<br />

### F.A.Q. : ЧАСТО ЗАДАВАЕМЫЕ ВОПРОСЫ

  1. Я забыл пароль от админ-панели. Как получить к ней доступ?<br />
     - Админ-панель получает информацю о логине и пароле администратора из файла config.php , расположенного в корневой директории чата. Просто откройте этот файл для чтения и посмотрите пароль.<br />
  2. В чём различия у библиотек для "платного" и "бесплатного" хостинга?<br />
     - Различие состоит в алгоритме работы. Если "бесплатный" хостинг зачастую позволяет кому-то ид своих клиентов догадаться о структуре каталогов на сервере, а значит, получить к ним доступ, то "платный" хостинг разрешает своему клиенту самому решать, как будет выглядеть структура каталогов на сервере.<br />
       Разумеется, эти библиотеки не позволяют получать привилегии того или иного хостинга, но работают в соответствии с представлениями автора о системе безопасности и степени повышения производительности.<br />
       Так, библиотека для "бесплатного" хостинга разрешает хранить Базу Данных в виде сериализованного массива, а сам массив используется в чате только после того, как считан, обработан и проверен на целостность.<br />
       Библиотека для "платного" хостинга же вставляет экземпляр Базы Данных прямо в код приложения, что существенно снижает затраты ресурсов на работу с Базой Данных, но минуется такой важный процесс, как проверка массива на целостность. Это значит, что вместо Базы Данных может быть вставлен любой произвольный код, возможно, дающий стороннему человеку контроль над сервером.<br />
  3. Чат выдаёт ошибку "База Данных Повреждена". Что мне делать?<br />
     - Зайдите в панель администрирования чата и выберите меню "модерирование". Скрипт автоматически определит целостность Базы Данных, и если она повреждена, выдаст об этом сообщение внизу страницы. Выделите все "пустые" сообщения, которые показывает Вам панель модерирования и нажмите "удалить выделенное". Скрипт автоматически создаст новую, пустую Базу Данных для чата.<br />
       По крайней мере, в большинстве случаев этот метод может помочь.<br />