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

  $mimeType = 'message/rfc822';
  $mid  = $_GET['id'];
  $mode = $_GET['mode'];

  $header = $footer = "";
  if ( $mode == "view" ) { $mimeType = 'text/plain'; }

  $raw = getRAWEmail();

  header("Content-Type: " . $mimeType );

  echo $header;

  echo $raw;

  echo $footer;
?>
