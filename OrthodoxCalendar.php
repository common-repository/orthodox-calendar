<?php
/*
Plugin Name: Orthodox Calendar
Plugin URI: http://www.holytrinityorthodox.com/calendar/
Description: Orthodox Calendar.
Version: 1.1
Author: David L.
License: GPL2
*/

function Orthodox_Calendar()
{
$js = '<SCRIPT TYPE="text/javascript">
<!--
var currentDay = new Date();

function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == \'string\')
   href=mylink;
else
   href=mylink.href;
var showWin = window.open(href, windowname, \'width=600,height=500,resizable=yes,dependent=yes,scrollbars=yes\');
showWin.focus();
return false;
}

function callCalendar(x) {

var mm=x.getMonth()+1;
var dd=x.getDate();
var yy=x.getFullYear();
var dt=1;
var hh=1;
var ll=4;
var tt=0;
var ss=1;

loadCalendar2(mm,dd,yy,dt,hh,ll,tt,ss);
}

function todayDate() {
var today=new Date();
callCalendar(today);
currentDay = today;
}

function nextdayDate() {
var next = new Date(currentDay.getTime() + 24*60*60*1000);
callCalendar(next);
currentDay = next;
}

function previousDate() {
var previous = new Date(currentDay.getTime() - 24*60*60*1000);
callCalendar(previous);
currentDay = previous;
}

var xmlHttp;
function loadCalendar2(mm, dd, yy, dt, hh, ll, tt, ss)
{
xmlHttp=null;
if (window.XMLHttpRequest)
  {// code for Firefox, Opera, IE7, etc.
  xmlHttp=new XMLHttpRequest();
  }
else if (window.ActiveXObject)
  {// code for IE6, IE5
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
if (xmlHttp!=null)
  {
  var par="' . WP_PLUGIN_URL . '/orthodox-calendar/OrthodoxCalenadrPRX.php";
  par=par+"?month="+mm + "&today="+dd + "&year="+yy + "&dt="+dt + "&header="+hh + "&lives="+ll + "&trp="+tt + "&scripture="+ss;
  par=par+"&sid="+Math.random();

  xmlHttp.onreadystatechange=stateChanged2;

  xmlHttp.open("GET", par,true);
  xmlHttp.send(null);
  }
else
  {
  alert("Your browser does not support XMLHTTP.");
  }
}

function stateChanged2() 
{ 
if (xmlHttp.readyState==4)
 {
   if (xmlHttp.status==200)
    {
 document.getElementById(\'T1\').innerHTML=xmlHttp.responseText 
    }
  else
    {
     document.getElementById(\'T1\').innerHTML="<a href=\"http://www.holytrinityorthodox.com/\">holytrinityorthodox.com</a>";
    }
 } 
}

callCalendar(currentDay);

// timer every 2 hour
setInterval(adjust_to_Today, 2000*60*60);
function adjust_to_Today() {
  today=new Date();	
currentDay = today;
callCalendar(currentDay);
}
//-->
</SCRIPT>';

$buttons = '<div class="ocButtonsBar">
<button onclick="previousDate()" class="ocButton">❰</button>
<button onclick="todayDate()" class="ocButton">▇</button>
<button onclick="nextdayDate()" class="ocButton">❱</button>
</div>
<div id="T1"></div>
';

$title = '<div class="widget"><h2 class="widget-title"> <a href="http://www.holytrinityorthodox.com/calendar/" title="Orthodox Calendar">Orthodox Calendar</a></h2>';

echo $title . $js . $buttons . "</div>";
}

function Orthodox_Calendar_init(){
		register_sidebar_widget('Orthodox Calendar', 'Orthodox_Calendar');
}

function add_Orthodox_Calendar_stylesheet() {
	$myStyleUrl = WP_PLUGIN_URL . '/orthodox-calendar/OrthodoxCalendar.css';
	$myStyleFile = WP_PLUGIN_DIR . '/orthodox-calendar/OrthodoxCalendar.css';
	if ( file_exists($myStyleFile) ) {
		wp_register_style('myStyleSheets', $myStyleUrl);
		wp_enqueue_style( 'myStyleSheets');
	}
}

add_action("plugins_loaded", "Orthodox_Calendar_init");
add_action('wp_print_styles', 'add_Orthodox_Calendar_stylesheet');

?>
