// This highlights the decisions and filings tabs on the index page.
// Find a better way to do this. This should be possible with only CSS.
 
 jQuery(document).ready(function($) {
     $('#tab2').click(function() {
         if ($('#tab2').is(':checked')) {
             $("#label2").css("background", "#0071BC");
             $("#label1").css("background", "#FFF");
             $("#label2").css("color", "#FFF");
             $("#label1").css("color", "#000")
         }
     });
 });
 jQuery(document).ready(function($) {
     $('#tab1').click(function() {
         if ($('#tab1').is(':checked')) {
             $("#label1").css("background", "#0071BC");
             $("#label2").css("background", "#FFF");
             $("#label1").css("color", "#FFF");
             $("#label2").css("color", "#000")
         }

     });
 });