#!/usr/bin/perl
# Pull the info down from hits.
# Copywrite 2009 Ian Pye <ianpye@gmail.com>
use strict;
use Net::Amazon::MechanicalTurk;
use Data::Dumper;

# Create a new MechTurk client
my $mturk = Net::Amazon::MechanicalTurk->new();

# Get your balance
my $balance = $mturk->GetAccountBalance->{AvailableBalance}[0]{Amount}[0];
print "Your balance is $balance\n";

my $hits = $mturk->GetReviewableHITsAll;
while (my $hit = $hits->next) {
  my $hitId = $hit->{HITId}[0];
  print($hitId."\n");
  my $assignments = $mturk->GetAssignmentsForHITAll(
    HITId => $hitId,
    AssignmentStatus => 'Submitted'
  );
  while (my $assignment = $assignments->next) {
    my $assignmentId = $assignment->{AssignmentId}[0];
    $mturk->ApproveAssignment( AssignmentId => $assignmentId );
    my $answers = $mturk->parseAssignmentAnswer($assignment);
    $answers->eachAnswerValue(sub {
      my ($questionId, $answerText) = @_;
      print "%s = %s\n", $questionId, $answerText;
    });
  }
}
