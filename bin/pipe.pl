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

sub err_exit($$) {
   my ($status, $msg) = @_;
   syslog('err', $msg);
   warn $msg;
   exit $status;
}

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
err_exit(65, "Couldn't parse message: $@") if $@;
eval { DDBB::insertMail($recipient, $sender, $msg->{subject}, $msg->{text}, $data) };
err_exit(75, "Couldn't insert message into database: $@") if $@;
syslog('info', "Message inserted into database");
exit 0;
