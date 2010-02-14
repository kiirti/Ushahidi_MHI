#!/usr/bin/perl -w
#
use strict;
use Net::Amazon::MechanicalTurk;
use Data::Dumper;

# Read the question spec
my $question_file = $ARGV[0];
my $clip_url = $ARGV[1];
my $service_url = $ARGV[2];
my $aws_ak = $ARGV[3];
my $aws_sk = $ARGV[4];
my $hit_type = $ARGV[5];
my $language = $ARGV[6];
my $instances = $ARGV[7];

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
my $addr = $clip_url."address.mp3";
my $date = $clip_url."date.mp3";
my $email = $clip_url."email.mp3";
my $location = $clip_url."location.mp3";
my $name = $clip_url."name.mp3";
my $problem = $clip_url."problem.mp3";
my $phone = $clip_url."phone.mp3";
$question =~ s/\$\{address\}/$addr/;
$question =~ s/\$\{date\}/$date/;
$question =~ s/\$\{email\}/$email/;
$question =~ s/\$\{location\}/$location/;
$question =~ s/\$\{name\}/$name/;
$question =~ s/\$\{problem\}/$problem/;
$question =~ s/\$\{phone\}/$phone/;
$question =~ s/\$\{language\}/$language/;

## setup the right instances.
my @instances = split(/,,,/, $instances);
my $sections = "";

foreach my $instance (@instances){
  my ($name, $desc) = split(/\|\|\|/, $instance);
  $sections .= "
<Selection>
  <SelectionIdentifier>$name</SelectionIdentifier>
  <Text>$desc</Text>
</Selection>
";
}
$question =~ s/\$\{instances\}/$sections/;

my $result = $mturk->CreateHIT(
    Title       => 'Transcribe an incident report',
    HITTypeId   => $hit_type,
    Description => 'Transcribe the audio file into a report for Kiirti',
    Keywords    => 'kiirti',
    #Reward => {
    #    CurrencyCode => 'USD',
    #    Amount       => 0.00
    #},
    RequesterAnnotation         => 'Test Kiirti Hit',
    AssignmentDurationInSeconds => 60 * 60,
    AutoApprovalDelayInSeconds  => 60 * 60 * 10,
    MaxAssignments              => 1,
    LifetimeInSeconds           => 7 * 24 * 60 * 60,
    Question                    => $question
);

printf "%s,%s\n", $result->{HITId}[0], $result->{HITTypeId}[0];
