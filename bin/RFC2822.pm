#
# Copyright 2008 PookMail.com (tm).
#
# Licensed under the GNU GENERAL PUBLIC LICENSE, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

package RFC2822;

use strict;
use Mail::Message;

sub _findTextOrHTMLPart {
   my ( $obj ) = @_;
   my $msg;

   if ( !$obj->isMultipart ) {
      $msg = $obj->body->decoded();
      $msg =~ s/(<[^<]+>)//g if ($obj->head->get('Content-Type') && lc($obj->head->get('Content-Type')) == "text/html");
      $msg =~ s/$(\s*\n)+/\n/g;
      return $msg;
   }
   else {
     for (0..$obj->body->parts) {
        $msg = _findTextOrHTMLPart( $obj->body->part($_) );
        return $msg if $msg;
     } 
   }
   return "PookMail was not able to find the message text!";
}

sub parse {
   my ( $rfc2822 ) = @_;
   my $obj = Mail::Message->read( $rfc2822 );
   return { "subject" => $obj->subject , "text" => _findTextOrHTMLPart( $obj ) };
}
1;
