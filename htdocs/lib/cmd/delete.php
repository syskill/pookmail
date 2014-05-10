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


function getEmailUser( $dbh , $mid ) {
  $email = "";

  if ( is_null($dbh) ) { return $email; }

  if ( $mid == "" || is_null($mid) ) { return $email; }
    

  // porsi las moscas .... hay q mejorar esta proteccion ...
  $mid = trim($mid);
  if ( strlen($mid) != 32 ) { $mid = "no existe fijo"; }

  $stmt = $dbh->prepare("select rcpt FROM mail WHERE filename_md5 = ?");
  $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
//     echo $stmt->queryString . "<br>";
  $stmt->execute();

  if ($e = $stmt->fetch()) {
     $email = $e[0];
//     echo "EMAIL: ". $email ."]";
  }

  return $email;
}

function deleteEmail ( $dbh , $mid ) {
  $res = 0;

  if ( is_null($dbh) ) { return 0; }

  if ( $mid == "" || is_null($mid) ) { return 0; }

  // los mails de ejemplo no se pueden borrar
  if ( $mid == "1a9e667ca4cb609d7199d3053608abb3" ) { return 0; }
  if ( $mid == "cd258d86cb192e469570e9e1506e08cb" ) { return 0; }
  
  // porsi las moscas .... hay q mejorar esta proteccion ...
  $mid = trim($mid);
  if ( strlen($mid) != 32 ) { return 0; }

  $stmt = $dbh->prepare("DELETE FROM mail WHERE filename_md5 = ?");
  $stmt->bindParam(1, $mid, PDO::PARAM_STR, 32);
  $res = $stmt->execute();

  return $res;
}
?>
