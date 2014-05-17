#!/usr/bin/perl -w

use strict;
use File::Basename;
use Sys::Syslog;

use Configure;
use DDBB;
use RFC2822;

my $CFG = $Configure::CFG;
my $ME = basename($0, '.pl');
$ME = 'pookmail-' . $ME unless $ME =~ /pookmail/;
my $VERSION = '0.1 Alpha';

unless (@ARGV == 2) {
   print STDERR "Usage: $0 <mailbox> <sender>\n";
   exit 64;
}

openlog($ME, 'cons,ndelay,pid', 'mail');
syslog('debug', "Pookmail pipe version $VERSION started");

my $recipient = join('@', $ARGV[0], $CFG->{domain});
my $sender = $ARGV[1];
my $data = '';
do {
   local $/;
   $data = <STDIN>;
};
$data =~ s/\r$//gm;
my $nbytes = length($data);

syslog('info', "Message received: from = $sender, to = $recipient, size = $nbytes");

my $msg;
eval { $msg = RFC2822::parse($data) };
if ($@) {
   syslog('err', "Couldn't parse message: $@");
   exit 65;
}
eval { DDBB::insertMail($recipient, $sender, $msg->{subject}, $msg->{text}, $data) };
if ($@) {
   syslog('err', "Couldn't insert message into database: $@");
   exit 75;
}
syslog('info', "Message inserted into database");
exit 0;
