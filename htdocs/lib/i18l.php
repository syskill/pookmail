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


   $langs = array();

   include( 'lang/all.inc' );
   
   $skin_global = $langs["en_us"];
   $skin = null;

   function initSkin () {
      global $skin, $skin_global, $langs;

      $lang = null;
      if ( !is_null($lang = __retrieveLangFromQS()) ) {
         $skin = $langs[$lang];
	 __updateCookieLanguage( $lang );
	 return;
      }
      if ( !is_null($lang = __retrieveLangFromCookie()) ) {
         $skin = $langs[$lang];
	 __updateCookieLanguage( $lang );
	 return;
      }
      if ( !is_null($lang = __retrieveLangFromHDRAcceptLanguage()) ) {
         $skin = $langs[$lang];
	 return;
      }
      $skin = $skin_global;
   }

   function __retrieveLangFromQS() {
      global $langs;

      $lan = $_GET['lan'];
      if ( !is_null($lan) && !is_null($langs[$lan]) ) { return $lan; }
      return null;
   }

   function __retrieveLangFromCookie() {
      global $langs;

      $lan = $_COOKIE["lan"];
      if ( !is_null($lan) && !is_null($langs[$lan]) ) { return $lan; }
      return null;
   }

   function __retrieveLangFromHDRAcceptLanguage() {
      $lan = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
      if ( preg_match("/^be/" , $lan) ) { return "be_by"; }
      if ( preg_match("/^ca/" , $lan) ) { return "ca";    }
      if ( preg_match("/^cs/" , $lan) ) { return "cs";    }
      if ( preg_match("/^da/" , $lan) ) { return "da";    }
      if ( preg_match("/^el/" , $lan) ) { return "el";    }
      if ( preg_match("/^en/" , $lan) ) { return "en_us"; }
      if ( preg_match("/^es/" , $lan) ) { return "es_es"; }
      if ( preg_match("/^fa/" , $lan) ) { return "fa";    }
      if ( preg_match("/^fr/" , $lan) ) { return "fr";    }
      if ( preg_match("/^ge/" , $lan) ) { return "ge";    }
      if ( preg_match("/^gl/" , $lan) ) { return "gl";    }
      if ( preg_match("/^he/" , $lan) ) { return "he";    }
      if ( preg_match("/^hu/" , $lan) ) { return "hu";    }
      if ( preg_match("/^it/" , $lan) ) { return "it";    }
      if ( preg_match("/^ja/" , $lan) ) { return "ja";    }
      if ( preg_match("/^lv/" , $lan) ) { return "lv";    }
      if ( preg_match("/^lb/" , $lan) ) { return "lb";    }
      if ( preg_match("/^nl/" , $lan) ) { return "nl";    }
      if ( preg_match("/^no/" , $lan) ) { return "no";    }
      if ( preg_match("/^pl/" , $lan) ) { return "pl";    }
      if ( preg_match("/^pt/" , $lan) ) { return "pt_br"; }
      if ( preg_match("/^ro/" , $lan) ) { return "ro";    }
      if ( preg_match("/^ru/" , $lan) ) { return "ru";    }
      if ( preg_match("/^sk/" , $lan) ) { return "sk";    }
      if ( preg_match("/^sv/" , $lan) ) { return "sv";    }
      if ( preg_match("/^tr/" , $lan) ) { return "tr";    }
      if ( preg_match("/^vi/" , $lan) ) { return "vi";    }
      if ( preg_match("/^zh/" , $lan) ) { return "zh";    }
      return null;
   }
   function __updateCookieLanguage( $lang ) {
      setcookie( "lan" , $lang , time()+31536000 , "/" );
   }

   function getLang() {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['locale']['lang']) ) { return $skin['locale']['lang'];}
      return $skin_global['locale']['lang'];
   }

   function getLanguageDirection() {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['locale']['direction']) ) { return $skin['locale']['direction'];}
      return "ltr";
   }

   function getCharSet() {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['locale']['charset']) ) { return $skin['locale']['charset'];}
      return $skin_global['locale']['charset'];
   }

   function getLabel( $l , $i ) {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      $label = $skin_global['label'][$l];
      if ( !is_null($skin['label'][$l]) ) { $label = $skin['label'][$l];}

      if ( !is_null($i) ) { $label = ereg_replace( "__PM__" , $i , $label ); }
      return $label;
   }

   function getTxt( $l ) {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['text'][$l]) ) { return $skin['text'][$l];}
      return $skin_global['text'][$l];
   }

   function getHelp( $l ) {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['help'][$l]) ) { return $skin['help'][$l];}
      return $skin_global['help'][$l];
   }
   function getUri( $l ) {
      global $skin , $skin_global;
      if ( is_null($skin) ) { initSkin(); }
      if ( !is_null($skin['uri'][$l]) ) { return $skin['uri'][$l];}
      return $skin_global['uri'][$l];
   }

  initSkin();
?>
