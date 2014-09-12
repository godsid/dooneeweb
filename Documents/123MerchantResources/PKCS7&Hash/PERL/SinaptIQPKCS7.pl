#!/usr/bin/perl


use FileHandle;
use IPC::Open2;
use strict;
print "Content-type: text/html\n\n";

# private key file to use

my $MY_KEY_FILE = "MerchantPrivate(123).pem";

# public certificate file to use - should match the $cert_id
my $MY_CERT_FILE = "MerchantPublic.pem";

# Paypal's public certificate that they publish on the Profile >
# Website-Certificate page.  Default is to use the sandbox cert.
my $ONETWOTHREE_CERT_FILE = "123Public.pem";

# File that holds extra parameters for the paypal transaction.
my $MY_INPUT_FILE = "input.txt";
my $ENC_PARAM_FILE = "enc.txt";

# path to the openssl binary
#my $OPENSSL = "/usr/bin/openssl";
my $OPENSSL = "C:\\openssl\\bin\\openssl.exe";
#my $OPENSSL = "/usr/local/bin/openssl";

# make sure we can execute the openssl utility
#die "Could not execute $OPENSSL: $!\n" unless -x $OPENSSL;

###############################################################################

# Send arguments into the openssl commands needed to do the sign,
# encrypt, s/mime magic commands.  This works under FreeBSD with
# OpenSSL '0.9.7e 25 Oct 2004' but segfaults with '0.9.7d 17 Mar
# 2004'.  It also works under OpenBSD with OpenSSL '0.9.7c 30 Sep
# 2003'.

my $pid_enc = open2(*READER_ENC, *WRITER_ENC,
		"$OPENSSL smime -encrypt -in ".$MY_INPUT_FILE ." ".$ONETWOTHREE_CERT_FILE)
  || die "Could not run open2 on $OPENSSL: $!\n"; 

# read in the lines from openssl
my @lines_enc = <READER_ENC>;

# close the reader file-handle which probably closes the openssl processes
close(READER_ENC);

# combine them into one variable
my $encrypted = join('', @lines_enc);
###############################################################################

my $pid_dec = open2(*READER_DEC, *WRITER_DEC,
		"$OPENSSL smime -decrypt -in ".$ENC_PARAM_FILE." -recip ".$MY_KEY_FILE)
  || die "Could not run open2 on $OPENSSL: $!\n"; 

# read in the lines from openssl
my @lines_dec = <READER_DEC>;

# close the reader file-handle which probably closes the openssl processes
close(READER_DEC);

# combine them into one variable
my $decrypted = join('', @lines_dec);

# print our html page with the encrypted blob in the middle
print "<br><br>";
print "<b>Encrypted data : </b><br>".$encrypted."<br><br>";
print "<b>Decrypted data : </b><br>".$decrypted."<br>";
