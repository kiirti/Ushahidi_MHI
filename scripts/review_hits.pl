#!/usr/bin/perl
# Pull the info down from hits.
# Copywrite 2009 Ian Pye <ianpye@gmail.com>
use strict;
use Net::Amazon::MechanicalTurk;
use Data::Dumper;
use File::Temp qw/ tempdir  /;

# Read the question spec
my $service_url = $ARGV[0];
my $aws_ak = $ARGV[1];
my $aws_sk = $ARGV[2];

# Create a new MechTurk client
my $mturk = Net::Amazon::MechanicalTurk->new(
    accessKey      => $aws_ak,
    secretKey      => $aws_sk,
    serviceUrl     => $service_url,
);

my $hits = $mturk->GetReviewableHITsAll;
while (my $hit = $hits->next) {
  my $hitId = $hit->{HITId}[0];
  my $assignments = $mturk->GetAssignmentsForHITAll(
    HITId => $hitId,
    AssignmentStatus => 'Submitted'
  );
  while (my $assignment = $assignments->next) {
    my $assignmentId = $assignment->{AssignmentId}[0];
    my $answers = $mturk->parseAssignmentAnswer($assignment);
    my %answers = ();
    $answers->eachAnswerValue(sub {
      my ($questionId, $answerText) = @_;
      $answers{$questionId} = $answerText;
    });

    #my ($fh, $filename) = tempfile();
    my $dir = tempdir();
    while ( my ($key, $value) = each(%answers) ) {
      open FILE, ">$dir/$key.txt" or die $!;
      print FILE $value."\n";
      close FILE;
    }
    chmod 0777, $dir;
    printf("%s|%s\n", $hitId, $dir);
    
    # Should we automatically approve this hit?
    $mturk->ApproveAssignment( AssignmentId => $assignmentId );
  }
  #print "$hitId\n";
  #$mturk->DisposeHIT(HITId => $hitId);
}
