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


  include( 'include.php' );
  trace( 'about' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta content="text/html; charset=<?php echo getCharSet(); ?>" http-equiv="content-type" />
<title>PookMail.com</title>
  
<style type="text/css">
<!--
body {
margin: 0;
padding: 0;
background-color: #fff;
font: 10px verdana, arial, helvetica;
}

table { border-collapse: collapse; }

td {
font: 12px verdana, arial, helvetica;
border-width:0;
background-color: white;
text-align: left; 
}

td.title { vertical-align: bottom; background-color: #ccc; }
td#home { text-align: right; }
td#copyright { 
text-align: center; 
vertical-align: bottom;
background-color: #ccc;
}

p { font: 12px verdana, arial, helvetica; }

h1 {
font-weight: bolder;
font-size: 150%;
margin: 1em 0 0;
}

h1#title {
font-weight: bolder;
font-size: 180%;
margin: 1.3em 0 0 0;
}

a#blog { font: 10pt verdana, arial, helvetica; color: #000; }
a { font: 8pt verdana, arial, helvetica; color: #000; }
a:hover, a#blog:hover { background: black; color: white; }

.rss {
font: 8pt verdana, arial, helvetica;
font-weight: bold;
color: #fff;
background-color: #f60;
border-top: 1px solid #ffc8a4;
border-right: 1px solid #7d3302;
border-bottom: 1px solid #3f1a01;
border-left: 1px solid #ff9a57;
}
//-->
</style>

<?php if ( getLanguageDirection() == "rtl" ) { ?>
<style type="text/css">
<!--
body {
direction: rtl;
margin: 0;
padding: 0;
background: white;
font: 12px verdana, arial, helvetica;
}
h1#title { direction: ltr; }
li, h1, p { text-align: right; direction: rtl; }
td#home { text-align: left; }
table { width: 700px; border: 0; overflow: scroll;}
td {
font: 12px verdana, arial, helvetica;
text-align: left;
overflow: hidden;*
}
//-->
</style>
<?php } ?>

<script type="text/javascript">
<!--
function foo() { return ["pookinfo",["p<font color='red'>o</font><font color='blue'>o</font>kmail","com"].join(".")].join("&#64;"); }
//-->
</script>

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
</head>

<body>

<center>

<table border="0" width="640">

<tr><td class="title"><h1 id="title">P<font color="red">o</font><font color="blue">o</font>kMail.com&#8482;</h1></td></tr>
<tr><td id="home"><a href="/"><?php echo getLabel('back'); ?></a></td></tr>

<tr><td>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<h1><?php echo ucfirst( getLabel('about','PookMail.com') ); ?></h1>
<p />
&raquo; <?php echo getTxt('whatispookmail'); ?>

<h1><?php echo getLabel('feeds'); ?></h1>
<p />
&raquo; <?php echo getTxt('about.feeds'); ?>

<p />
&raquo; <?php echo getTxt('about.feeds.url'); ?>

<p />
&raquo; <?php echo getTxt('about.feeds.aggregator'); ?>:<br />
<ol>
<li><?php echo getTxt('about.feeds.aggregatorStep1'); ?></li>
<li><?php echo getTxt('about.feeds.aggregatorStep2'); ?></li>
</ol>

<h1><?php echo getLabel('furtherHelp'); ?></h1>
<p />
&raquo; <?php echo getTxt('about.visitBlog'); ?>

<p />
&raquo; <?php echo getTxt('about.furtherHelp'); ?>

<br /><br /><br />
</td></tr>

<tr><td id="copyright">Copyright (c) pookmail.com 2004-<?php echo date('Y'); ?></td></tr>

</table>

</center>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-53596-2";
urchinTracker();
</script>
</body>
</html>
