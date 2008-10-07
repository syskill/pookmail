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


include( 'i18l.php' );
include( 'libgatika.php' );

function rss_getHeader( $charset = 'ISO-8859-1' ) {
   $now = time();
   $year = date( "Y" , $now );
   $build = date( "D, j M Y H:i:s T" ,$now );
   $desc = getTxt( 'rss.desc' );

   return <<<EOT
<?xml version="1.0" encoding="$charset" ?>
<rss version="2.0">
   <channel>
      <title>PookMail.com</title>
      <link>http://www.pookmail.com</link>
      <description>$desc</description>
      <copyright>Copyright 2004-$year, PookMail.com</copyright>
      <generator>PookMail 1.0</generator>
      <managingEditor>pookinfo@pookmail.com</managingEditor>
      <webMaster>pookinfo@pookmail.com</webMaster>
      <ttl>10</ttl>\n
EOT;
}

function rss_getItems( $local='' ) {
   $xml = '';
   srand( time() );

   db_connect();
   if ( !db_isConnected() ) { return xml; }
   $mails = db_getMailsOf( $local.'@pookmail.com' , $false );

   while ( $e = array_pop($mails) ) {
      $xml .= "<item>\n";
      $xml .= "<title>".$e['subject']."</title>\n";
      $xml .= "<guid>".$e['subject']."</guid>\n";
      $xml .= "<link>http://www.pookmail.com/mailbox.php?email=".$local."&amp;sid=".md5( rand() )."</link>\n";
      $xml .= "<description>".$e['from']."</description>\n";
      //$xml .= "<pubDate>".date("D, j M Y H:i:s Z" , $e['date'])."</pubDate>\n";
      $xml .= "<pubDate>".date("r" , $e['date'])."</pubDate>\n";
      $xml .= "</item>\n";
   }

   db_close();

   return $xml;
}

function rss_getFooter() {
   return "</channel>\n</rss>";
}
?>
