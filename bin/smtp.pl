#!/usr/bin/perl -w
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


use strict;
use Carp;
use POSIX qw( setgid setuid getpwnam getgrnam );
use POSIX ":sys_wait_h";
use Net::SMTP::Server;
use Net::SMTP::Server::Client;

use Configure;
use DDBB;
use RFC2822;

my $CFG = $Configure::CFG;

my $client;
my $server;
my $conn;
my $waitedpid = 0;
my $VERSION = '0.1 Alpha';

sub logmsg {
   my ( $str ) = @_;
   print scalar localtime , " - $str\n";
}

sub REAPER {
   my $child;

   while (($waitedpid = waitpid(-1,WNOHANG)) > 0) {
      #logmsg "reaped $waitedpid" . ($? ? " with exit $?" : '') ."\n";
   }
   $waitedpid = -1 if $waitedpid == 0;
   $SIG{CHLD} = \&REAPER;  # loathe sysV
}
$SIG{CHLD} = \&REAPER;

$SIG{ALRM} = sub { logmsg "Timeout!\n"; $conn->close(); exit -2; };
$SIG{TERM} = sub { $server->DESTROY(); };
$SIG{INT}  = sub { $server->DESTROY(); };

$server = new Net::SMTP::Server( $CFG->{smtp}->{ip}, $CFG->{smtp}->{port} ) ||
    croak("Unable to handle client connection: $!\n");

my $pm_uid = getpwnam("pookmail");
my $pm_gid = getgrnam("pookmail");
setuid($pm_uid);
setgid($pm_gid);

logmsg "Server Started. Ver: $VERSION";

$waitedpid = 0;

#while( $conn = $server->accept() ) {

for ( $waitedpid = 0;
          ($conn = $server->accept()) || $waitedpid;
          $waitedpid = 0 , $client=0) {

   next if $waitedpid;

   $client = new Net::SMTP::Server::Client($conn) ||
   	croak("Unable to handle client connection: $!\n");

   spawn( $client );

   $client = 0;
   $conn->close();
   $conn = 0;
   #$waitedpid = 0;

} #end for

sub spawn {
   my ( $client ) = @_;
   my @email;
   my $pid;

   return if !$client;

   if (!defined($pid = fork)) {
      logmsg "PANIC! Cannot fork: $!\n";
      return;
   } elsif ($pid) {
      #logmsg "paspas $pid\n";
      return; # I'm the parent
   }
   # else I'm the child -- go spawn

   alarm( $CFG->{timeout} );
   $client->process || return;
   alarm(0);

   # IF SENDER IS EMPTY THEN DROP MAIL
   if ( length($client->{FROM}) < 6 ) {
      logmsg "Invalid sender email address " . $client->{FROM} ."\n";
      exit;
   }

   # TODO: IF RCPT IS INFO@POOKMAIL.COM DELIVERY TO ALEX...

   $client->{TO}[0] =~ s/[<>]//g;
   $client->{FROM}  =~ s/[<>]//g;
   $client->{MSG}   =~ s///g;

   @email = split( /@/ , $client->{TO}[0] );

   if ( !($email[0] eq "pookmail") && !($email[0] eq "pookinfo") ) {
      my $o = RFC2822::parse( $client->{MSG} );
      DDBB::insertMail( $email[0]."\@pookmail.com" , $client->{FROM} , $o->{subject} , $o->{text} , $client->{MSG} );
   }

   logmsg ($email[0] . " 200 " . length($client->{MSG}) );
   $conn->close();
   exit;
}

logmsg "Shutdown ...";

$server->DESTROY();
exit 0;
