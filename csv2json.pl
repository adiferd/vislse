#!/usr/bin/perl

use strict;
use warnings;
use Scalar::Util qw(looks_like_number);

my $in = $ARGV[0] or die "Need to get CSV file on the command line\n";
my $out = "earthquake.json";
my $cnt = 0;

open (my $fin, '<', $in) or die "Could not open '$in' $!\n";
open (my $fout, '>', $out) or die "Could not open '$out' $!\n";

# read header
my $header = <$fin>;

chomp $header;
my @headers = split ";", $header;

my $clen = scalar (@headers) - 1;

print $fout "[";

while (my $line = <$fin>) {
	if ($cnt != 0) {
		print $fout ",";
	} else {
		$cnt++;
	}

	chomp $line;

	my @fields = split ";", $line;

	# trim whitespace
	s{^\s+|\s+$}{}g foreach @fields;

	print $fout "{\n";
	for my $i (0 .. $clen) {
		if ($i > 0) {
			print $fout ",";
		}

		print $fout "\t\"", $headers[ $i ] ,"\":";

		if (looks_like_number($fields[ $i ])) {
			print $fout $fields[ $i ];
		} else {
			print $fout "\"", $fields[ $i ] ,"\"";
		}

		print $fout "\n";
	}
	print $fout "}";
}

print $fout "]";

close $fout;
close $fin;
