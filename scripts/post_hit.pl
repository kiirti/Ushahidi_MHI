#!/usr/bin/perl -w
#
use strict;
use Net::Amazon::MechanicalTurk;

# Read the question spec
my $question_file = $ARGV[0];
my $clip_url = $ARGV[1];
my $service_url = $ARGV[2];
my $aws_ak = $ARGV[3];
my $aws_sk = $ARGV[4];

# Create a new MechTurk client
my $mturk = Net::Amazon::MechanicalTurk->new(
    accessKey      => $aws_ak,
    secretKey      => $aws_sk,
    serviceUrl     => $service_url,
);

my $question = "";
{
    local( $/, *FH ) ;
    open( FH, $question_file ) or die $!;
    $question = <FH>
}

# Update the arguments
$question =~ s/\$\{clip_url\}/$clip_url/;

my $result = $mturk->CreateHIT(
    Title       => 'Transcribe an incident report',
    Description => 'Transcribe the audio file into a report for Kiirti',
    Keywords    => 'kiirti',
    Reward => {
        CurrencyCode => 'USD',
        Amount       => 0.00
    },
    RequesterAnnotation         => 'Test Kiirti Hit',
    AssignmentDurationInSeconds => 60 * 60,
    AutoApprovalDelayInSeconds  => 60 * 60 * 10,
    MaxAssignments              => 1,
    LifetimeInSeconds           => 60 * 60,
    Question                    => $question
);

printf "%s,%s\n", $result->{HITId}[0], $result->{HITTypeId}[0];
