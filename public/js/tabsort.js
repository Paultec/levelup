function addLoadEvent(func) {
 var oldonload = window.onload;
 if (typeof window.onload != 'function') {
  window.onload = func;
 }
 else {
  window.onload = function() {
   oldonload();
   func();
  }
 }
}

function getTopLeft(elem) {
 var top=0, left=0
 while(elem) {
  top = top + parseInt(elem.offsetTop)
  left = left + parseInt(elem.offsetLeft)
  elem = elem.offsetParent
 }
 return {top:top, left:left}
}

function stripTags(str) {
 str=str.replace(/\<[^\<\>]+\>/ig,"");
 return str;
}

function striptags(str) {
 return stripTags(str)
}

function trim(str) {
 var newstr = str.replace(/\&nbsp\;/g,"\0010");
 newstr = str.replace(/^\s+|\s+$/,"");
 return newstr;
}

function findParent(obj, tag, classn){
 var objtag
 if (typeof(tag) == "object" && null!=tag) {
  while (obj && document.body!=obj.parentNode) {
   obj=obj.parentNode
   if (obj==tag) return obj
  }
  return null
 }

 while (obj && document.body!=obj.parentNode) {
  obj=obj.parentNode
  objtag=obj && obj.tagName
  if (objtag && tag.toLowerCase()==objtag.toLowerCase()) {
   if (!classn || -1!=obj.className.indexOf(classn)) {
    return obj
   }
  }
 }
 return null
}

function hasClass(obj, c) {
 if (!c || !obj) return false
 var re = new RegExp('(\\s+|^)' + c + '(\\s+|$)', 'g')
 if (typeof obj == "string") obj = {className: obj}
 return (re.test(obj.className)) ? re : false
}

function delClass(obj, c) {
 if (!obj) return
 if (typeof obj == "string") obj = {className: obj, gen: true}
 var oc = obj.className, re = hasClass(oc, c)
 if (re) obj.className = oc.replace(re, " ")
 if (obj.gen) return obj.className
}

function addClass(obj, c) {
 if (!obj) return
 if (typeof obj == "string") obj = {className: obj, gen: true}
 oc = obj.className
 if (!oc || !hasClass(oc, c)) obj.className += " " + c
 if (obj.gen) return obj.className
}

function replaceClass(obj, c) {
 if (!c.length) return
 if (typeof obj == "string") obj = {className: obj, gen: true}
 var oc1 = obj.className
 if (!oc1) obj.className = c[0]
 else {
  var  oc2 = delClass(oc1, c[1])
  oc2 = addClass(oc2, c[0])
  if (oc2 != oc1) obj.className = oc2
 }
 if (obj.gen) return obj.className
}

function addclass(obj, c) {addClass(obj, c)}
function delclass(obj, c) {delClass(obj, c)}


 /* использовать отбор строк (фильтры) */
var use_inputs = true
 /* использовать фильтры без axis (тип String) */
var inputs_force = true
/* настройки конец */


addLoadEvent(preptabs);
function preptabs(){ 
 window.verse=false;
 var head,  
  input="<br><input class='str' onkeyup='data_filter(this, 3)'  placeholder='Фильтр'>"
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