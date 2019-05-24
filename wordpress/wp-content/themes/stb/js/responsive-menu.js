jQuery(document).ready(function($) {
    
    $(".hamburger").click(function() {
        $(".hamburger").hide();
        $(".cross").show();
		$(".searchbar").hide();
		$(".splash h1").hide();
    });
    $(".cross").click(function() {
        $(".cross").hide();
        $(".hamburger").show();
		$(".searchbar").delay(500).show(0);
		$(".splash h1").delay(500).show(0);
    });
	 $(".menu-item").click(function() {
        $(".cross").hide();
        $(".hamburger").show();
		$(".searchbar").delay(500).show(0);
		$(".splash h1").delay(500).show(0);
    });
	
});

$(document).ready(function() {
    $('.menu-trigger').click(function() {
        $('nav ul').slideToggle(500);
    }); //end slide toggle

    $(window).resize(function() {
        if ($(window).width() > 500) {
            $('nav ul').removeAttr('style');
			$(".cross").hide();
			$(".hamburger").show();
        }
    }); //end resize
}); //end ready


		 
