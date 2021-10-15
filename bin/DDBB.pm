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
use DBI qw(:sql_types);
use Digest::MD5 qw(md5 md5_hex md5_base64);

use Configure;

my $CFG = $Configure::CFG;

sub connectToDB {
   my $dbh = DBI->connect("DBI:".$CFG->{db}->{connstr}, $CFG->{db}->{user}, $CFG->{db}->{pass}, {'RaiseError' => 1});
   return $dbh;
}

sub insertMail {
   my ( $to , $from , $subject , $text , $rfc2822 ) = @_;

   my $dbh = connectToDB();

   my $sth = $dbh->prepare("insert into mail (sender,rcpt,rcpt_md5,subject,data,raw,filename_md5,timestamp,status,processed) values ( ?,?,?,?,?,?,?,?,'READY','PLAIN' )");
   $sth->bind_param(1, $from);
   $sth->bind_param(2, $to);
   $sth->bind_param(3, md5_hex($to));
   $sth->bind_param(4, $subject);
   $sth->bind_param(5, $text, SQL_LONGVARCHAR);
   $sth->bind_param(6, $rfc2822, SQL_LONGVARCHAR);
   $sth->bind_param(7, md5_hex($rfc2822));
   $sth->bind_param(8, time(), SQL_INTEGER);

   $sth->execute();

   $dbh->disconnect();
}

sub removeExpiredEmails {
   my $dbh = connectToDB();

   my $sth = $dbh->prepare("delete from mail where timestamp < ? and status='READY'");
   $sth->bind_param(1, time() - $CFG->{expire}, SQL_INTEGER);

   $sth->execute();

   $dbh->disconnect();
}


1;

# test
#DDBB::insertMail( "xela\@pookmail.com" , "kk\@kk.com" , "Hola Carcola" );
