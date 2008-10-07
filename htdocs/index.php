<?php
/*
 *
 * Copyright 2008 PookMail.com (tm).
 *
 * Licensed under the GNU GENERAL PUBLIC LICENSE, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */


  include( 'lib/ui.html.php' );
  trace( 'homepage' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo getLang(); ?>" lang="<?php echo getLang(); ?>">

<head>
<meta http-equiv="content-type" content="text/html; charset=<?php echo getCharSet(); ?>" />
<meta name="description" content="Cuentas de correo de usar y tirar" />
<meta name="description" content="Disposables email accounts" />
<meta name="keywords" content="free, disposable, instant, mail, drop, temporal, e-mail, address, register" />
<meta name="keywords" content="gratis, usar-y-tirar, instantaneo, mail, temporal, e-mail, correo, direccion, registro" />

<title>PookMail.com</title>

<link rel="shortcut icon" href="favicon.ico" />

<style type="text/css">
<!--
body {
margin-top: 10px;
padding: 0;
background: #fff;
font: 10px verdana, arial, helvetica;
}
table { width: 720px; border: 0 dashed red; }
td { border: 0 dashed blue; text-align: left; }
a { 
font: inherit verdana, arial, helvetica;
color: #000;
margin: 0 0.5em;
}
a:hover { background: black; color: white; }
h1 {
margin: 0 0 0.5em;
font: bolder 300% verdana, arial, helvetica;
}
h2 {
margin: 0 0 0.5em;
padding: 0;
font: normal large verdana, arial, helvetica;
text-align: center;
}
h3 {
margin-top:0.2em;
font: bolder 12px verdana, arial, helvetica;
text-align: center;
}
hr { width:11em; }
div#advice {
text-align: center;
margin: 10px 0;
padding: 3px;
background: #ffc;
border-top:1px solid #fc0;
border-bottom:1px solid #fc0;
}
#go { margin-top: 1em; }
div#blog {
margin: 0 0 1em;
padding: 0;
text-align: center;
}
div#blog a {
font: bolder 14px verdana, arial, helvetica;
}
#nav, #nav ul {
padding:0;
margin: 0;
margin-left: 5em;
list-style: none;
}
#nav a { display: block; width: 11em; }
#nav li { float: left; margin-bottom: 0.4em; }
#nav li ul {
position: absolute;
width: 12em;
left: -999em;
background: #eee;
border: 1px solid #000;
font: normal 11px verdana, arial, helvetica;
margin-left: 0;
padding: 1em;
}
#nav li ul a:hover { color: #000; background: #aaa;}
#nav li:hover ul, #nav li.sfhover ul {
left: auto;
padding:0;
}
ul#howto { margin: 0; padding: 0; }
ul#howto li {
list-style: none;
padding-left: 4em;
padding-right: 0;
margin: 1em 0 1.1em;
padding-bottom: 0;
}
li#s1 { background: url('/img/question.jpg') no-repeat top left; }
li#s2 { background: url('/img/wait.jpg') no-repeat top left; height: 35px;}
li#s3 { background: url('/img/mail.jpg') no-repeat top left; }
li#s4 { background: url('/img/24h.jpg') no-repeat top left; height: 35px;}
div#left img { float: left; margin-right: 0.5em; }
div#left p { margin-bottom: 0.2em; }
div#left,div#right {
float: left;
width: 340px;
height: 280px;
text-align: left; 
border: 1px solid #000;
padding: 0.3em;
font: 10px verdana, arial, helvetica;
}
div#right {
border:0 solid #000;
background: #ddd;
float: right;
font: 12px verdana, arial, helvetica;
}
div#emailfield {
padding:1.1em;
margin-top: 0.4em;
border:1px dashed #ddd;
background: #eee;
font: 14px verdana, arial, helvetica;
}
div#mod {
margin-top: 1em;
text-align:left;
font: 12px verdana, arial, helvetica;
padding: 0.3em;
border: 1px dashed black;
background: #eee;
}
div#copyright {
margin-top: 1em;
font: 12px verdana, arial, helvetica;
color: #000;
text-align: center;
}
kbd {
background: #ddd;
padding: 0 0.5em;
border-right: 1px solid black;
border-bottom: 1px solid black;
font: 9px verdana, arial, helvetica;
margin: 0.2em;
}
//-->
</style>

<?php if ( getLanguageDirection() == "rtl" ) { ?>
<style type="text/css" media="screen,print,projection">
<!--
body {
direction: rtl;
margin: 0;
padding: 0;
background: white;
font: 12px verdana, arial, helvetica;
}
p, li { direction: rtl; text-align: right; }
div#mod { direction: rtl; text-align: right; }
h1, ul li { direction: ltr; }
td {
font: 12px verdana, arial, helvetica;
text-align: left;
overflow: hidden;*
}
li#s1 { direction: rtl; }
li#s2 { direction: rtl; }
li#s3 { direction: rtl; }
li#s4 { direction: rtl; }
//-->
</style>
<?php } ?>

<script type="text/javascript"><!--
google_ad_client = "pub-7546585380815123";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text_image";
google_ad_channel = "";
google_color_border = "000000";
google_color_bg = "F0F0F0";
google_color_link = "0000FF";
google_color_text = "000000";
google_color_url = "008000";
//-->
</script>
<script type="text/javascript">
<!--
function init() {
if ( window != window.top) {
document.write('<center><p>Loading <b>P<font color="red">o</font><font color="blue">o</font>kMail.com</b>, please wait ...</p></center>');top.location = "http://www.pookmail.com"; return;
}
document.login.email.focus();
}
function foo() { return ["pookinfo",["p<font color='red'>o</font><font color='blue'>o</font>kmail","com"].join(".")].join("&#64;"); }

// By Patrick Griffiths and Dan Webb
// http://htmldog.com/articles/suckerfish/dropdowns/
sfHover = function() {
var sfEls = document.getElementById("nav").getElementsByTagName("LI");
for (var i=0 ; i < sfEls.length ; i++) {
 sfEls[i].onmouseover=function() { this.className+=" sfhover"; }
 sfEls[i].onmouseout=function() { this.className=this.className.replace(new RegExp(" sfhover\\b"), ""); }
}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//-->
</script>

</head>

<body onload="init()">

<center>
<h1>P<font color="red">o</font><font color="blue">o</font>kMail.com<font size="-1">&#8482;</font></h1>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<form name="login" action="mailbox.php" method="post">

<table cellspacing="0">

<tr>
<td>
<div id="blog">
<a href="http://pookmail.blogspot.com"><?php echo getTxt('visitBlog'); ?></a>
</div>
</td>
</tr>

<tr>
<td>

<?php if ( false ) { ?>
<div id="advice">
PookMail uses <b>Cookies</b> in order to allow you to setup your preferred language. <b><a href="/about.php">Learn more</a></b>
</div>
<?php } ?>

<div id="left">
<h3><?php echo getLabel('howto','PookMail.com'); ?></h3>
<ul id="howto">
<li id="s1"><b><?php echo getLabel('step')." ".getLabel('one') ?></b><br /><?php echo getTxt('howtostep1') ?></li>
<li id="s2"><b><?php echo getLabel('step')." ".getLabel('two') ?></b><br /><?php echo getTxt('howtostep2') ?></li>
<li id="s3"><b><?php echo getLabel('step')." ".getLabel('three') ?></b><br /><?php echo getTxt('howtostep3') ?></li>
<li id="s4"><b><?php echo getLabel('step')." ".getLabel('four') ?></b><br /><?php echo getTxt('howtostep4') ?></li>
</ul>
</div>

<div id="right">
<h2><?php echo getLabel( 'welcometo', '<b>'.getCountryCustomizedPookMail().'</b>' ); ?></h2>
<center>
<a href="/international.php"><?php echo getLabel('changeLang'); ?>&nbsp;&raquo;</a>
&nbsp;&nbsp;&nbsp;
<a href="/about.php"><?php echo ucfirst( getLabel('about','') ); ?>&nbsp;&raquo;</a>
</center>

<div id="emailfield">
<center>
<span dir="ltr"><input name="email" type="text" /><b>@pookmail.com</b></span>
<br />
<input id="go" type="submit" value="<?php echo getLabel('enter'); ?>" />
</center>
</div>

<p />
<?php echo getTxt('whatispookmail') ?>
</div>
</td>
</tr>

<!--
<tr><td>
<div id="mod">
<?php echo getTxt('request4trans'); ?>
</div>
</td></tr>
-->

<tr><td>
<div id="copyright">
Copyright (c) pookmail.com 2004-<?php echo date('Y'); ?>
</div>
</td></tr>
</table>

</form>

</center>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-53596-2";
urchinTracker();
</script>

</body>
</html>
