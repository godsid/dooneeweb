#!/usr/bin/perl -w
use Digest::HMAC_SHA1 qw(hmac_sha1_hex);
print "content-type: text/html\n\n";
my $hmac_data = "hello";
my $transaction_key="746D7SCHAIQ0QUZ0MRJWU0PQ3AD7PJ8B";
my $output = hmac_sha1_hex($hmac_data, $transaction_key);
print $output;