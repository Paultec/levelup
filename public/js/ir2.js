/* function zatychka() */
document.write('<style type="text/css">#unjs {display:none;}</style>')

var hiddclass = "disnone" //для совместимости

var textname="text"


// http://simon.incutio.com/archive/2004/05/26/addLoadEvent
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

//by http://javascript.ru/ui/offset
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
 /* дополнительная красота (в нашем скрипте не нужно)
 str=str.replace(/(\<(br|tr|p|li|dt|dd))/ig,"\n$1"); */
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



function insertAfter(parent, node, referenceNode) {
  parent.insertBefore(node, referenceNode && referenceNode.nextSibling);
}

function cancel(e) {
 e = e || window.event
 if (27==e.keyCode) hidTemp()
}

function checkform(obj){
 var list=obj.elements, el
 for (var i=0; i<list.length; i++) {
  el=list[i]
  if (hasClass(el, "need")) {
   if (!el.value) {
    alert('Обязательный элемент '+el.name)
    return false 
   }
  }
 }
}

function findParent(obj, tag, classn){ /*22:50 29.06.2010*/
//  msg("/findP/"+obj.tagName+"//"+tag+"//"+classn)
 //передавать массив имя-значение (доделать)
 var objtag
 if (typeof(tag) == "object" && null!=tag) {
  while (obj && document.body!=obj.parentNode) {
   obj=obj.parentNode
   if (obj==tag) return obj
  }
  return null
 }
// var log1="//"+obj.tagName+" "+obj.className
 while (obj && document.body!=obj.parentNode) {
  obj=obj.parentNode //не сам объект!!
  objtag=obj && obj.tagName
//  if (!objtag) {obj=obj.parentNode; continue;}
//  msg("/c/"+objtag+"//"+tag)
  if (objtag && tag.toLowerCase()==objtag.toLowerCase()) {
   if (!classn || -1!=obj.className.indexOf(classn)) {
    return obj
   }
  }
//  log1+="//"+objtag+" "+obj.className
//  alert(log1)
 }
 return null
}


//http://www.openjs.com/scripts/dom/class_manipulation.php
function hasClass(obj, c) {
 //http://ir2.ru/javascript-if.aspx
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

function hidd(obj, yes) {
 if (yes) obj.className += " " + hiddclass
 else delclass(obj, hiddclass)
}

function listpop(arr, obj) {
 //удаляются все заданные одинаковые obj из arr
 //возвращается (?) первый найденный
 var ret=null
 for (var j=arr.length-1; j>-1; j--) {
  if (arr[j]==obj) {
   if (!ret) ret=arr.splice(j,1)
   else arr.splice(j,1)
  }
 }
 return ret
}

function listadd(arr, obj) {
/* проверяется уникальность и эл-т obj добавляется в arr */
 var flag=false 
 for (var j=0; j<arr.length; j++) {
  if (arr[j]==obj) {
   flag=true
   break
  }
 }
 if (!flag) rolist.push(g.expobj)
}

function initvar(c) {
 if (!window.d || "object" != typeof window.d) window.d={}
 c = c || window.c
 if (!c) return
 for (var prop in c) {
  var b=c[prop]
  if (0<b.length)
   d[b]=document.getElementById(b)
 }
}

function deselect(obj) {
 obj = obj || document.body
 if (obj.createTextRange) {
  var r = obj.createTextRange()
  r.collapse(false)
  r.select()
 }
 else if (window.getSelection) {
  window.getSelection().collapse(obj, 0)
 }
}