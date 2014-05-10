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


include( 'config.php' );

$__dbh = null;


function db_isConnected() {
   global $__dbh;
   return !( $__dbh == null );
}

function db_connect() {
   global $__dbh , $config;

   $__dbh = new PDO( $config['db_dsn'] , $config['db_user'] , $config['db_pwd']);
   $__dbh->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_SILENT );
}

function db_close() {
   global $__dbh;
   $__dbh = null;
}

function db_getMailsOf( $email , $body = 'false' ) {
   global $__dbh;

   if ( !db_isConnected() ) { db_connect(); }
   if ( !db_isConnected() ) { return null; }

   $stmt = $__dbh->prepare("SELECT * FROM mail WHERE rcpt_md5=? and status='READY' ORDER BY timestamp desc limit 10");
   $stmt->bindParam(1, md5($email), PDO::PARAM_STR, 32);
   $stmt->execute();

   $mails = array();
   while ( $e = $stmt->fetch() ) {
      $item = array();

      $item['id']      = $e[8];
      $item['subject'] = $e[4];
      $item['from']    = $e[1];
      $item['date']    = $e[6];

      $item['encrypted'] = 'no';
      //if ( 'ENCRYPT' == $e[11] ) { $item['encrypted']  = 'yes'; }
      if ( 'PLAIN' != $e[11] ) { 
	 $enc = explode( ':' , $e[11] );
	 if ( 'PGP' == $enc[0] ) {
            $item['encrypted']  = 'yes'; 
	    $item['is_hosted'] = 'no';
	    if ( 'is_hosted' == $enc[1] ) { $item['is_hosted'] = 'yes'; }
	 }
      }

      if ( $body ) { $item['body'] = $e[5]; }

      array_push( $mails , $item );
   }

   return array_reverse( $mails );
}

function db_getRAWEmailByID( $mid ) {
   global $__dbh;

   if ( $mid == "" || is_null($mid) ) { return null; }

   // porsi las moscas .... hay q mejorar esta proteccion ...
   $mid = trim($mid);
   if ( strlen($mid) != 32 ) { return null; }

   if ( !db_isConnected() ) { db_connect(); }
   if ( !db_isConnected() ) { return null; }

   $stmt = $__dbh->prepare('SELECT raw FROM mail WHERE filename_md5 = ?');
   $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
   $stmt->execute();

   if ( $e = $stmt->fetch() ) { return $e; }

   return null;
}

function db_deleteEmail( $mid ) {
   global $__dbh;

   $res = 0;

   if ( $mid == "" || is_null($mid) ) { return 0; }

   // los mails de ejemplo no se pueden borrar
   if ( $mid == "1a9e667ca4cb609d7199d3053608abb3" ) { return 0; }
   if ( $mid == "cd258d86cb192e469570e9e1506e08cb" ) { return 0; }

   // porsi las moscas .... hay q mejorar esta proteccion ...
   $mid = trim($mid);
   if ( strlen($mid) != 32 ) { return 0; }

   if ( !db_isConnected() ) { db_connect(); }
   if ( !db_isConnected() ) { return 0; }
   $stmt = $__dbh->prepare('DELETE FROM mail WHERE filename_md5 = ?');
   $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
   $res = $stmt->execute();

   return $res;
}

function db_getEmailByID( $mid ) {
   global $__dbh;

   if ( $mid == "" || is_null($mid) ) { return null; }
   // porsi las moscas .... hay q mejorar esta proteccion ...
   $mid = trim($mid);
   //if ( strlen($mid) != 32 ) { $mid = "no existe fijo"; }
   if ( strlen($mid) != 32 ) { return null; }

   if ( !db_isConnected() ) { db_connect(); }
   if ( !db_isConnected() ) { return null; }

   $stmt = $__dbh->prepare('select * FROM mail WHERE filename_md5 = ?');
   $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
   //     echo $stmt->queryString . "<br>";
   $stmt->execute();

   $item = null;
   if ($e = $stmt->fetch()) {
      $item = array();
      $item['id']      = $e[8];
      $item['to']      = $e[3];
      $item['subject'] = $e[4];
      $item['from']    = $e[1];
      $item['date']    = $e[6];
      $item['body']    = $e[5];

      $item['encrypted'] = 'no';
      //if ( 'ENCRYPT' == $e[11] ) { $item['encrypted']  = 'yes'; }
      if ( 'PLAIN' != $e[11] ) { 
	 $enc = explode( ':' , $e[11] );
	 if ( 'PGP' == $enc[0] ) {
            $item['encrypted']  = 'yes'; 
	    $item['is_hosted'] = 'no';
	    if ( 'is_hosted' == $enc[1] ) { $item['is_hosted'] = 'yes'; }
	 }
      }
   }

   return $item;
}

function db_getEmailAddressByID( $mid ) {
   global $__dbh;

   $email = "";

   if ( $mid == "" || is_null($mid) ) { return $email; }
   // porsi las moscas .... hay q mejorar esta proteccion ...
   $mid = trim($mid);
   //if ( strlen($mid) != 32 ) { $mid = "no existe fijo"; }
   if ( strlen($mid) != 32 ) { return $email; }

   if ( !db_isConnected() ) { db_connect(); }
   if ( !db_isConnected() ) { return $email; }

   $stmt = $__dbh->prepare('select rcpt FROM mail WHERE filename_md5 = ?');
   $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
   //     echo $stmt->queryString . "<br>";
   $stmt->execute();

   if ($e = $stmt->fetch()) {
      $email = $e[0];
      //     echo "EMAIL: ". $email ."]";
   }

   return $email;
}

function getEncryptHTMLWarning( $o ) {
   if ( is_null($o) ) { return ""; }

   if ( $o['is_hosted'] == 'yes' ) {
      $footer = <<<EOT
In order to retrieve the original message you must provide a valid <u>passphrase</u>:
</p>

<p>
<form action='#' method='post'>
<input type="password" />&nbsp;<input type="submit" value="UNLOCK" />
</form>
</p>
EOT;
   } else {
      $footer = <<<EOT
In order to retrieve the original message you must click on 'save' link and decrypt it with PGP.
EOT;
   }


return <<<EOT
<center>
<div class="magiceyes">
MAGIC EYES ONLY
<hr>
<p>
This message has been encrypted. $footer
</div>
</center>
EOT;
}

function isInternalAccount( $e ) {
   $all = "esinventada@ dontbotherme@ naopertube@ nonscocciare@";
   $local = explode( "@" , $e );
   $p = strpos ( $all , $local[0]."@" );
   return ($p != false);
}

function trace ( $str ) {
  global $config;

  $fd = @fopen( $config['logfile'] , "a" );

  if ( is_null($fd) ) { return; }

  $trace = "[" . date("d/m/Y:G:i:s O") . "]"
          . " - " . $_SERVER['REMOTE_ADDR']
          . " - " . $_SERVER['HTTP_ACCEPT_LANGUAGE']
          . " - [" . $_SERVER['HTTP_USER_AGENT'] . "]"
	  . " - " . $str. "\n";
  @fwrite( $fd , $trace);
  @fclose( $fd );
}

function processCommand( $cmd ) {
   $res = "";
   $email = recoveryUserEmail();

   switch( $cmd ) {
   case 'bounce' : $res = bounceEmail(); break;
   case 'delete' : $res = deleteEmail(); break;
   }
   return array( "email" => $email , "result" => $res );
}

function recoveryUserEmail() {
   global $config;

   $email = $_POST['email'];
   if ( $email == "" ) { $email = $_GET['email']; }
   if ( $email != "" ) { return $email . "@" . $config['domain']; }

   return db_getEmailAddressByID( $_GET['id'] );
}

function deleteEmail() {
   if ( db_deleteEmail( $_GET['id'] ) > 0 ) { return getTxt( 'deleteOK' ); }
   return getTxt( 'deleteKO' );
}

function bounceEmail() {
  return ":OK:";
}

function getUserEmails( $email ) {
   if ( isInternalAccount($email) ) { return getDontBotherMeEmail(); }

   return db_getMailsOf( $email , true );
}

function getDontBotherMeEmail() {
   global $config;

   $mail = array(
              "id" => "221" 
	     ,"subject" => getTxt( 'dbm.subject' )
	     ,"from" => "PookInfo <pookinfo@".$config['domain'].">"
	     ,"date" => mktime()
	     ,"encrypted" => "no"
	     ,"body" => getTxt( 'dbm.body' )
           );

   return array( $mail ); 
}

function getEmailByID() {
   $mid = $_GET['id'];
   if ( !isset($mid) ) { $mid = $_POST['id']; }

   return db_getEmailByID( $mid );
}

function getRAWEmail() {
   $email = db_getRAWEmailByID( $_GET['id'] );

   if ( is_null($email) ) { return ""; }
   if ( is_null($email[0]) ) { return ""; }

   return $email[0];
}

function printBody( $b ) {
   $str = preg_replace( '/>/'  , "&gt;" , $b );
   $str = preg_replace( '/</'  , "&lt;" , $str );
   return "\n&gt; ".preg_replace( '/\n/' , "\n&gt; " , $str   );
}
?>
