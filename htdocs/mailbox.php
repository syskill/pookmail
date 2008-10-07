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
   //$email = recoveryEmail();
   $r = processCommand( $_GET['cmd'] );
   $email = $r['email'];
   $cmdresult = $r['result'];
   $mails = getUserEmails( $email );
?>

<head>
<meta content="text/html; charset=<?php echo getCharSet(); ?>" http-equiv="content-type" />
<meta name="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<title>PookMail.com</title>
  
<link rel="shortcut icon" href="favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="<?php echo getTxt('rss.desc'); ?>" href="http://www.pookmail.com/rss/<?php $e=explode("@",$email); echo $e[0]; ?>.xml" />

<style type="text/css" media="screen,projection">
<!--
body {
margin: 0;
padding: 0;
background: white;
font: 12px verdana, arial, helvetica;
}
table { width: 700px; border: 0; }
td {
font: 12px verdana, arial, helvetica;
text-align: left; 
}
a {
font: bolder 11px verdana, arial, helvetica;
color: #000;  
text-decoration: none;
border-bottom: 1px dotted #000;
}
a:hover { color: #fff; background: #000; }
h1 {
font-weight: bolder;
font-size: 150%;
margin: 1.3em 0 0 0.3em;
}
h2 { margin-bottom: 0; }
h3 { margin: 0 0 0.3em; }
div.magiceyes {
background: white;
width: 300px;
text-align: center;
color: red;
font: bolder 150% courier;
border: 2px solid red;
}
div.magiceyes hr {
border: 1px solid red;
margin-top: 0;
}
div.magiceyes p {
padding: 0.2em;
text-align: left;
color: black;
font: bolder 12px verdana, arial, helvetica;
}
div#result{
background: #fad163;
font: bolder 12px verdana, arial, helvetica;
text-align: center;
padding: 0.2em;
margin: 1.5em;
}
div#welcome { width: 630px; margin: 0 0 0 3em; }
p#rss { margin:0; }
p#nummails { text-align: right;} 
td#title { vertical-align: bottom; background: #ccc; }
td#logout { text-align: right; }
td#copyright { text-align: center; background: #ccc; }
a.delete {
color: red;  
border-bottom: 1px dotted red;
}
a.delete:hover { color: #fff; background: red; }
div.claro , div.oscuro {
padding: 0.3em;
background: #ddd;
margin-bottom: 2em;
}
div.oscuro { background: #aaa; }
div.cmd {
float: right;
vertical-align: middle;
color black;
}
.rss {
font: normal bold 10px verdana, arial, helvetica;
color: #fff;
background: #f60;
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
h1 { direction: ltr; }
h2 , a ,div.oscuro,div.claro,p#rss,td#title { direction: rtl; text-align: right; }
p#nummails, td#logout { text-align: left; direction: rtl; }
div.cmd { float: left; direction: rtl; }
table { width: 700px; border: 0; overflow: scroll;}
td {
font: 12px verdana, arial, helvetica;
text-align: left;
overflow: hidden;*
}
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
</head>

<body>
<center>
<table cellspacing="0">

<tr>
<td id="title">
<h1>P<font color="red">o</font><font color="blue">o</font>kMail.com&#8482;</h1>
</td>
</tr>

<tr><td id="logout"><a href="/"><?php echo getLabel('logout') ?></a></td></tr>

<tr><td>

<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<div id="welcome">

<h2><?php echo getLabel('welcome') ?>&nbsp;<?php echo $email?></h2>

<?php if ( $cmdresult != '' ) { ?>
<div id="result"><?php echo $cmdresult; ?></div>
<?php } ?>

<?php
   if ( trim($email) != '@pookmail.com') {
?>
<p id="rss"><span class="rss" title="RSS Version 2.0">RSS 2.0</span>
<a href="/rss/<?php $_e = explode("@",$email); echo $_e[0]; ?>.xml" title="Really Symple Syndication (RSS)">
<?php echo getTxt('rsssubscription'); ?>
</a></p>
<?php
   } //end if
?>

<p id="nummails">
<?php echo getLabel('have') ?>&nbsp;<b><?php echo count($mails) ?></b>&nbsp;<?php echo getLabel('mails') ?>
</p>

<!-- RESULT LIST START -->
<?php
   $tbg = array( 'claro' , 'oscuro' );
   $i = -1;
   //while ( $e = @mysql_fetch_row($res) ) {
   while ( $e = array_pop($mails) ) {
      $i++;
?>

<!-- RESULT ITEM START -->

<div class="<?php echo $tbg[$i%2] ?>">
<h3><?php echo $e['subject'] ?></h3>

<?php echo $e['from'] ?>

<p />
<div class="cmd">
<?php 
//  if ( $email != 'esinventada@pookmail.com' && $email != 'dontbotherme@pookmail.com' ) {
  if ( !isInternalAccount($email) ) {
?>
<a title="<?php echo getLabel('reply'); ?>" href="<?php echo '/reply.php?id='. $e['id'] ?>"><?php echo getLabel('reply'); ?></a>
:
<a title="<?php echo getHelp('saveMail') ?>" href="<?php echo '/mailbox/'. $e['id'] . '.eml' ?>"><?php echo strtolower( getLabel('save') ) ?></a>
:
<a title="<?php echo getHelp('viewMail') ?>" href="<?php echo '/mailbox/'. $e['id'] . '.eml?mode=view' ?>"><?php echo strtolower( getLabel('viewRawmail') ) ?></a>
:
<a title="<?php echo getHelp('deleteMail') ?>" class="delete" href="<?php echo '/mailbox.php?cmd=delete&id='. $e['id'] ?>"><?php echo strtoupper( getLabel('delete') ) ?></a>
<?php
  } // end if proteccion
?>
</div>
<b><?php echo getLabel('date') ?>:</b> <?php echo date("D, M j Y H:i:s T" , $e['date']) ?>

<hr />
<?php 
if ( "yes" == $e['encrypted'] ) {
   echo getEncryptHTMLWarning( $e );
} else {
   echo nl2br($e['body']);
}
?>
</div>
<!-- RESULT ITEM END -->

<?php
   } //end while
//   @mysql_close($mysql);
?>

<!-- RESULT LIST END -->

</div>

<!-- RESULT LIST END -->
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
