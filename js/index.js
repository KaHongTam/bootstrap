$(document).ready(function(){
    $(".golden_card").hide();
});
$( "#option1" ).click(function() {
    $( ".golden_card" ).hide( "slow", function() {});
    $( ".normal_card" ).show ("slow", function() {});
});

$( "#option2" ).click(function() {
    $( ".normal_card" ).hide( "slow", function() {});
    $( ".golden_card" ).show ("slow", function() {});
});
