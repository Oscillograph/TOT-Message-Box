//---открытие окон чата
function show_archive(w,h){ // архив сообщений
	window.open('./archive.php', '', 'scrollbars=0, resizable=1, width='+w+', height='+h+', left=100, top=100');}
//---вспомогательные функции
function isForm(){//проверка существования формы отправки сообщения
	if (fileName=='chat.php'){	if (window.parent.frames){
		if (window.parent.frames.post_form){	if (window.parent.frames.post_form.document){
			if (window.parent.frames.post_form.document.post_form){	return true;
			} else { return false; }	} else { return false; }
		} else { return false; }	} else { return false; }
	} else { return false;}}
function addNick(el){//добавление выбранного ника в поле ввода сообщения
 if (isForm()){
  if (mess.value != 'message'){	mess.value += el.innerHTML;}
  else { mess.value = el.innerHTML;}}}
function reloader(){//Обновление фрейма сообщений
  if(document.location.href.indexOf('?posted=y')>=0){
    document.location.reload(true);}
  else{location.replace('chat.php?posted=y');}}
//---переменные
var lightCounter = 0;
if (isForm()){
var mess = window.parent.frames.post_form.document.post_form.message;}

//---функции отображения деталей чата
function cm (nick, msg, date ,msgid) { //обработка и отображение сообщения
	if (nick.length>1){
		if ( lightCounter == 0 ){
			document.write ('<tr><td class="light" colspan=2>'); lightCounter = 1;
		} else {
			document.write ('<tr><td class="dark" colspan=2>'); lightCounter = 0;
		}
		if (isCodes==1){
			while (msg.indexOf('[b]')>=0 && msg.indexOf('[/b]')>=0){
				msg = msg.replace('[b]','<b>');
				msg = msg.replace('[/b]','<\/b>');}
			while (msg.indexOf('[u]')>=0 && msg.indexOf('[/u]')>=0){
				msg = msg.replace('[u]','<u>');
				msg = msg.replace('[/u]','<\/u>');}
			while (msg.indexOf('[i]')>=0 && msg.indexOf('[/i]')>=0){
				msg = msg.replace('[i]','<i>');
				msg = msg.replace('[/i]','<\/i>');}
		}
		if(smiles==1){
			for (j=0;j<sm_url.length;j++){
				while(msg.indexOf(sm_code[j])>=0){
					msg = msg.replace(sm_code[j],' <img src="'+sm_url[j]+'" border=0> ');
		}}}
		if (isDate==1){ document.write('<span class=date style="font-size:10; float:right">'+date+'<'+'/span><br>'); }
		document.write ('<span class="nick" onClick="addNick(this)">'+ nick + ':<' + '/span> ');
		document.write (msg);
		document.write('<'+'/td><'+'/tr>');
}}
