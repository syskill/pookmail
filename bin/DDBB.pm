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

package DDBB;

use strict;
use DBI();
use Digest::MD5 qw(md5 md5_hex md5_base64);

use Configure;

my $CFG = $Configure::CFG;

sub connectToDB {
   my $dbh = DBI->connect("DBI:mysql:database=".$CFG->{db}->{db}.";mysql_connect_timeout=3;host=".$CFG->{db}->{host},
                          $CFG->{db}->{user}, $CFG->{db}->{pass}, {'RaiseError' => 1});
   return $dbh;
}

sub insertMail {
   my ( $to , $from , $subject , $text , $rfc2822 ) = @_;

   my $dbh = connectToDB();

   my $sql = "insert into mail (sender,rcpt,rcpt_md5,subject,data,raw,filename_md5,timestamp,status,processed) \
           values ( \
           ". $dbh->quote($from) ." , " .$dbh->quote($to) ." , '". md5_hex($to). "', " .$dbh->quote($subject). ", \
           ".$dbh->quote($text). ", ". $dbh->quote($rfc2822) ." , '".md5_hex($rfc2822) ."',".time().",'READY','PLAIN' );";

   #print $sql . "\n";

   $dbh->do( $sql );

   $dbh->disconnect();
}

sub remove24HEmails {
   my $dbh = connectToDB();

   my $sql = "delete from mail where timestamp < " . ( time() - 86400 ) . " and status='READY'";
   print $sql . "\n";

   $dbh->do( $sql );

   $dbh->disconnect();
}


1;

# test
#DDBB::insertMail( "xela\@pookmail.com" , "kk\@kk.com" , "Hola Carcola" );
