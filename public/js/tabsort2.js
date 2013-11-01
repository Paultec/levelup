/* Simple Table Sorter v2.0 (+ JS Data Filter)
   http://ir2.ru/js_data_filter.aspx 
@require http://ir2.ru/ir2.js 19.08.2010 
@require http://ir2.ru/tabsort.css 23.08.2010 
*/
/* Использование: 

требуются правила CSS: 
.i {font-style:italic;} 
.num {width:3em;}
.str {width:5em;}
.disnone {display:none;}
.disnone_child .disnone_if {display:none;}
.abstopleft {position:absolute; margin: 1em; padding:.2em 1em; border:2px solid red; color: #360; background-color: #ffc; font-size:2em; }

I Сортировщик

1) подключить (через эл-т HEAD) к странице два скрипта 
 (библиотеку http://ir2.ru/ir2.js и этот);
2) сортируемым таблицам (тэгам TABLE) добавить class='sortable' 
 (можно через пробел: class='big superborder sortable');
3) в строке заголовка (при щелчке по которому происходит сортировка) 
 должны быть элементы TH (а не TD);
4) вводится 3 типа данных (str не вводится - он по умолчанию) 
 для сотрировки: num|datru|daten, их следует вписывать в ячейку 
 заголовка как атрибут: <th axis="num">;
5) пользователь может сам определять тип сортировки:
 щелчок с удержанным Shift - Number,
 щелчок с удержанным Ctrl - Date (RU),
 щелчок с удержанным Ctrl+Alt - Date (EN)
6) можно при сортировке добавлять к заголовкам ячеек 
title "Отсортировано по...", если указать в в секции 
"настройки" use_title = true;
7) можно сохранять состояние сортировки для каждой 
таблицы (в cookie), для этого в секции "настройки"
нужно указать use_cookie = true;
8) удалить куки для данной таблицы (сбросить сохранённое
состояние сортировки) можно щелчком по заголовку
с удержанными клавишами Ctrl+Alt+Shift.

II Фильтры

1) для подключения модуля фильтров по значениям колонок таблицы
с явно указанным типом сортировки (axis)
в секции "Настройки" назначить use_inputs = true;
2) для подключения модуля фильтров ко всем заголовкам сортируемых
таблиц без разбора в секции "Настройки" назначить 
use_inputs = true
inputs_force = true;
3) для удаления сообщения с количеством результатов нажать Escape;
4) для поиска в середине полей (строковый тип) добавлять перед
искомой фразой (буквой) пробел.
*/

 /* использовать отбор строк (фильтры) */
var use_inputs = true
 /* использовать фильтры без axis (тип String) */
var inputs_force = true
/* настройки конец */

function scells(row) {
	var sarr=[], cells=row.cells;
	for(var i=0; i<cells.length; i++){
		var c=striptags(cells[i].innerHTML).toLowerCase();
		sarr[i]=c;
	}
	return sarr;
}

addLoadEvent(preptabs);
function preptabs(){ 
 window.verse=false;
 var head,  
  input="<br><input class='str' onkeyup='data_filter(this, 3)'  placeholder='Сортировка'>"
 if (use_inputs) {
  window.result=document.createElement("SPAN")
  result.id="num_res"
  result.className="abstopleft"
  document.body.appendChild(result)
 }
 var tex=document.getElementsByTagName("TABLE");
 for (var el=0; el<tex.length; el++) { /*Поиск таблиц и назначение onclick*/
  var elem=tex[el];
  if (1==elem.nodeType && "TABLE"==elem.tagName && / *sortable\b/i.test(elem.className)) {
   elem.sorted=NaN;
   elem.rarr=[el];   
   head=elem.rows[0]
     
/* подготовка отбора элементов */
   if (use_inputs) {
    var c, isaxis=false
    for (var k=0; k<head.cells.length; k++) {
     c=head.cells[k]
     if (c.axis) {
      c.innerHTML += ("num"==c.axis) ? inputs : input
     }
     else if (inputs_force) c.innerHTML += input
    }
   }
  }
 }
}

/******************** JS Data Filter *******************/

function data_filter(obj, n) {
 var invis_class="disnone_if", q, q_int, qr, qrx, row, 
  val, val_int, c=obj.parentNode, counter=0
  pflag=false, t=findParent(obj, "TABLE"), cid=c.cellIndex,
  fields=c && c.getElementsByTagName("INPUT"),
  field1=fields && fields[0], val1=field1 && field1.value, val1_int=parseInt(val1),
  field2=fields && fields[1], val2=field2 && field2.value, val2_int=parseInt(val2)
 window.result=document.getElementById("num_res")
 result.style.top=getTopLeft(c).top-100
 result.style.left=getTopLeft(c).left+10
 if (!val1 && !val2) {
  delclass(t, "disnone_child")
  return
 }
 if (obj.axis && obj.axis==obj.value && !field2) return
 if (window.pworking) return
 obj.axis=obj.value
 q=obj.value.toLocaleLowerCase()
 q_int=parseInt(q)
 qr=q.substr(1)
 qrx="/^"+qr+"/"
 window.pworking=true
 for (var i=1; i<t.rows.length; i++) {
  row=t.rows[i]
  val=striptags(row.cells[cid].innerHTML).toLocaleLowerCase()
  val_int=parseInt(val)
  switch (n) {
   case 1:
    if ((isNaN(q_int) || val_int>=q_int) && (isNaN(val2_int) || val_int<=val2_int)) {
     delclass(row, invis_class)
     counter++
     pflag = true
    }
    else addclass(row, invis_class)
   break
   case 2:
    if ((isNaN(q_int) || val_int<=q_int) && (isNaN(val1_int) || val_int>=val1_int)) {
     delclass(row, invis_class)
     counter++
     pflag = true
    }
    else addclass(row, invis_class)
   break
   default:
    if (0==q.indexOf(" ")) {
     if (val.indexOf(qr)>-1) {
      delclass(row, invis_class)
      counter++
      pflag = true
     }
     else addclass(row, invis_class)
    }
    else {
     if (0==val.indexOf(q)) {
      delclass(row, invis_class)
      counter++
      pflag = true
     }
     else addclass(row, invis_class)
    }
   break
  }
 }
 result.innerHTML=counter
 if (pflag) {
  delclass(result, "disnone")
  obj.style.color="#000"
  addclass(t, "disnone_child")
 }
 else {
  obj.style.color="#c00"
  delclass(t, "disnone_child")
 }
 window.pworking=false
}