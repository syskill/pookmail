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


  include('include.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo getLang(); ?>" lang="<?php echo getLang(); ?>">

<?php
  $e = getEmailByID();
?>

<head>
<meta content="text/html; charset=<?php echo getCharSet(); ?>" http-equiv="content-type" />
<meta name="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<title>PookMail.com</title>

<link rel="shortcut icon" href="favicon.ico" />
<style type="text/css" media="screen,projection">
body {
margin: 0 auto;
padding: 0;
background: #fff;
font: 12px verdana, arial, helvetica;
text-align: center;
width: 700px;
}
table { width: 700px; border: 0; }
a#blog { font: 10pt verdana, arial, helvetica; color: #000; }
a { font: 8pt verdana, arial, helvetica; color: #000; }
a:hover, a#blog:hover { background: black; color: white; }
td {
font: 12px verdana, arial, helvetica;
text-align: left; 
}
h1 {
font-weight: bolder;
font-size: 150%;
margin: 1.3em 0 0 0.3em;
}
h2 { margin-bottom: 0; }
td#home { text-align: right; }
td#copyright { text-align: center; background: #ccc; }
td#title { vertical-align: bottom; background: #ccc; }
div.feedback{
background: #fad163;
font: bolder 12px verdana, arial, helvetica;
text-align: center;
padding: 0.2em;
margin: 1.5em;
}
div.feedbackclear { background: white; }
input { font-size: 10px;}
input:focus { border: 2px solid red;}
input:focus , textarea:focus { border: 2px solid red;}

#page {background: white;width:100%;}

.sendbt { font-weight: bold; }
</style>

<script type="text/javascript" src="/js/proto.js"></script>

<script>
function foo( e ) {
$("result").className = "feedback";
$("result").innerHTML = "Sending mail ... please wait";
new Ajax.Updater( "result" , "coke.php" , {
parameters : Form.serialize( $("oreo") ) ,
method: "post" ,
onFailure : function (r) { alert("Oooops! Something seems to be wrong. Please tray again in few minutes."); }
,onSuccess : function (r) { $("dust").src = "/img/dot.png?pid=2701&s="+Math.random(); }
});
Event.stop(e);
}
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

<div id="page" class="page">

<table cellspacing="0">

<tr>
<td id="title">
<h1>P<font color="red">o</font><font color="blue">o</font>kMail.com&#8482;</h1>
</td>
</tr>

<tr><td><h2><?php echo getLabel('reply.email'); ?></h2></td></tr>

<tr><td>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr>


<tr><td>
<div id="result" class="feedbackclear"></div>
</td></tr>

<tr><td>
<center>

<form id="oreo">
<input type="hidden" name="id" value="<?php echo( $e["id"] ); ?>" />

<div style="padding: 0.5em; padding-bottom: 0.5em; background: #ddd; width: 635px; text-align: left; margin-top: 1em; margin-bottom:0;">


<!-- stamp -->
<div style="float:right; width:129px; height: 62px; background: url(/img/stamp.jpg); margin: 0.5em; font: bold 18px courier; text-align: center;">
<div style="font: bold 18px courier; text-align: center; margin-top: 0.5em; border: 1px dashed black; ">RETURN TO SENDER</div>
</div>
<!-- stamp -->

<input type="button" name="back" value="<?php echo getLabel('discard'); ?>" onclick="javascript:history.back();" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="sendbt" type="submit" name="send" value="<?php echo getLabel('send.email'); ?>" />

<div style="font: italic normal 14px verdana, arial, helvetica; margin: 0.4em;"><?php echo( $e["from"] ); ?> </div>
<div style="font: italic bold 14px verdana, arial, helvetica; margin: 0.4em;"><?php echo getLabel('subject'); ?>: RE: <?php echo( $e["subject"] ); ?></div>
<p />
<textarea name="body" rows="10" cols="76">
<?php echo( printBody($e["body"]) ); ?>
</textarea>
</div>

<div style="background: #aaa; margin-top:0; width: 645px; padding: 0.1em; margin-bottom: 1.5em;">
<img style="padding: 0.2em;" id="dust" name="dustn" src="/img/dot.png?pid=2701" /><br />
<input type="text" name="lod" value="<?php echo getTxt('captcha'); ?>" size="36" onfocus="this.value=''"/><br />
<input class="sendbt" type="submit" name="send" value="<?php echo getLabel('send.email'); ?>" />
</div>

</form>
</center>
</td></tr>
<tr><td id="copyright">Copyright (c) pookmail.com 2004-<?php echo date('Y'); ?></td></tr>
</table>
</div>
<?php
/*
echo "<hr /><pre>";
var_dump(gd_info());
echo "</pre> <hr /> <pre>";
echo( var_dump($e) );
echo "</pre>";
*/
?>
<script type="text/javascript">
Event.observe( $("oreo") , "submit", foo , false );
</script>
</body>
</html>
