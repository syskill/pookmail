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

  function isAjax() {
     return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
     $_SERVER ['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest';
  }
   
  $fd = fopen( '../logs/mail.log' , "a" );
  if ( isset($fd) ) {
    @fwrite( $fd , date("d/m/Y:G:i:s O") . "\n" );
    @fclose( $fd );
  }

  $pid = 2701;
  session_start();

  if ( !isAjax() ) {
    echo "Invalid request ... are you a spammer?";
    die();
  }

  if ( $_POST["lod"] != $_SESSION['phrase'.$pid] ) {
    echo( "Oooops! You have entered a invalid code!" );
    die();
  }

  $e = getEmailByID();
  if ( !isset($e) ) { echo( "Oooops! Original email doesn't exist" ); die(); };

  $r = mail( $e["from"], "RE: ".$e["subject"] , $_POST["body"] , "From: ".$e["to"]."\r\n" );
  if ( $r <> true ) {
    echo( "Your email cannot be sent!" );
    die();
  }

  echo( "You email has been sent" );

?>
