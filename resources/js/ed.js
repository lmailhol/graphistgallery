/*****************************************/
// Name: Javascript Textarea HTML Editor
// Version: 1.3
// Author: Balakrishnan
// Last Modified Date: 25/Jan/2009
// License: Free
// URL: http://www.corpocrat.com
/******************************************/

// Modified by Luca Mailhol to suit the Markdown Language

var textarea;
var content;
document.write("<link href=\"editor/styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function edToolbar(obj) {
   
	document.write("<img class=\"button\" src=\"../img/bold.png\" name=\"btnBold\" title=\"Bold\" onClick=\"doAddTags('*','*','" + obj + "')\">");
    document.write("<img class=\"button\" src=\"../img/italic.png\" name=\"btnItalic\" title=\"Italic\" onClick=\"doAddTags('_','_','" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../img/link.png\" name=\"btnLink\" title=\"Insert Link\" onClick=\"doURL('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../img/image.png\" name=\"btnPicture\" title=\"Insert Picture\" onClick=\"doImage('" + obj + "')\">");
	document.write("<img class=\"button\" src=\"../img/unordered.png\" name=\"btnList\" title=\"Unordered List\" onClick=\"doList('" + obj + "')\">");
  	document.write("<img class=\"button\" src=\"../img/code.png\" name=\"btnCode\" title=\"Code\" onClick=\"doAddTags('<code>','</code>','" + obj + "')\">");
    document.write("<br/>");
	//document.write("<textarea id=\""+ obj +"\" name = \"" + obj + "\" cols=\"" + width + "\" rows=\"" + height + "\"></textarea>");
}

function doAddTags(tag1,tag2,obj)
{
textarea = document.getElementById(obj);
// Code for IE
if (document.selection)
{
textarea.focus();
var sel = document.selection.createRange();
//alert(sel.text);
sel.text = tag1 + sel.text + tag2;
}
   else
    { // Code for Mozilla Firefox
var len = textarea.value.length;
var start = textarea.selectionStart;
var end = textarea.selectionEnd;

var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

        var sel = textarea.value.substring(start, end);
//alert(sel);
var rep = tag1 + sel + tag2;
        textarea.value = textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);

textarea.scrollTop = scrollTop;
textarea.scrollLeft = scrollLeft;
}
}



function doImage(obj) {
textarea = document.getElementById(obj);
var url = prompt('Enter the Image URL:','http://');
var alt = prompt('Enter the Image Alt:','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;
if (url != '' && url != null) {
	if (document.selection) {
				textarea.focus();
				var sel = document.selection.createRange();
				sel.text = '[' + alt + '](' + url + ')';
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		var rep = '[' + alt + '](' + url + ')';
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
 }
}

function doURL(obj)
{
var sel;
textarea = document.getElementById(obj);
var url = prompt('Enter the URL:','http://');
var title = prompt('Enter the Title:','Title');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

if (url != '' && url != null) {

	if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				
				if(sel.text==""){
					sel.text = '(' + url + ')';
					} else {
					sel.text = '[' + title + '](' + url + ')';
					}
				//alert(sel.text);
				
			}
   else 
    {
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		
		var sel = textarea.value.substring(start, end);
		
		if(sel==""){
		sel=url; 
		} else
		{
        var sel = textarea.value.substring(start, end);
		}
	    //alert(sel);
		
		
		var rep = '[' + title + '](' + url + ')';;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
	}
 }
}

function doList(obj){
textarea = document.getElementById(obj);

// Code for IE
		if (document.selection) 
			{
				textarea.focus();
				var sel = document.selection.createRange();
				var list = sel.text.split('\n');
		
				for(i=0;i<list.length;i++) 
				{
				list[i] = '*' + list[i];
				}
				//alert(list.join("\n"));
				sel.text = list.join("\n");
				
			} else
			// Code for Firefox
			{

		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		var i;
		
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;

		
        var sel = textarea.value.substring(start, end);
	    //alert(sel);
		
		var list = sel.split('\n');
		
		for(i=0;i<list.length;i++) 
		{
		list[i] = '*' + list[i];
		}
		//alert(list.join("<br>"));
        
		
		var rep = list.join("\n");
		textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
 }
}
