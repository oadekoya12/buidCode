jQuery(document).ready(function($){
          $('#tabs').tabs();
                  $('#tabs1').tabs();
                  $('#tabs2').tabs();
                  $('#tabs3').tabs();
                  $('#tabs4').tabs();
                  $('#tabs5').tabs();
                  $('#tabs6').tabs();
                  $('#tabs7').tabs();
                  $('#tabs8').tabs();
                  $('#tabs9').tabs();
				  $('#tabs10').tabs();

});

jQuery(document).ready(function($) {
         	var hash = window.location.hash.substr(6);
         	var parentTab = parseInt(hash.charAt(0)) -1;
         	var childTab = parseInt(hash.charAt(1)) -1;
                $( "#tabs" ).tabs({active: parentTab});
         		$( "#tabs-2" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-3" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-4" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-5" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-6" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-7" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-8" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
         		$( "#tabs-9" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
				$( "#tabs-10" ).tabs({active: (isNaN(childTab)) ? 0 : childTab});
           });
         //Refresh the page once to ensure we have the current data
           window.onload = function() {
             if(!window.location.hash) {
                 window.location = window.location + '#loaded';
                 window.location.reload();
             }
         }
