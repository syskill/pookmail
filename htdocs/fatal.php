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
<html>
<head>
<meta content="text/html; charset=<?php echo getCharSet(); ?>" http-equiv="content-type" />
<title>PookMail.com</title>
  
<style type="text/css">
<!--
body {
  margin: 0px;
  padding: 0px;
  background-color: #FFFFFF;
  font: 10pt verdana, arial, helvetica;
}


td.header {
   border-width:0px;
   background-color: #ccc;
   text-align: left;
}

td.footer {
   border-width:0px;
   background-color: #ccc;
   text-align: center;
   font: 10pt verdana, arial, helvetica;
}

td.headerNav {
   background-color: #fff;
   font: 10pt verdana, arial, helvetica;
   text-align: right;   
}

a {
   font-weight: bold;
   color: #000;  
}

-->
</style>

<?php if ( getLanguageDirection() == "rtl" ) { ?>
<style type="text/css">
body { direction: rtl; }
</style>
<?php } ?>
</head>

<body>
<center>
<table border="0" width="700">

<tr><td class="header" valign="bottom"><br /><br />&nbsp;<b>P<font color="red">o</font><font color="blue">o</font>kMail.com</b></td></tr>
<tr><td class="headerNav" valign="bottom"></td></tr>

<tr><td align="center" height="400px">

<b><?php echo getLabel('sorry') ?></b>, <?php echo getHelp('500') ?>.
<p />
<?php echo getLabel('please') ?>, <?php echo getLabel('doclick') ?> <a href="javascript:history.go(-1)"><?php echo getLabel('here') ?></a> <?php echo getLabel('toretry')?>.

</td></tr>

<tr><td class="footer" align="left" valign="bottom">Copyright (c) pookmail.com 2004-<?php echo date('Y'); ?></td></tr>

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
