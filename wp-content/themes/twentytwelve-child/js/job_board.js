
$(function() {

    // creates tabs for index page
    $( "#listings-contain" ).tabs();

    // hides and shows job board menu for small screens
    $('#job_board_menu').click(function(){
    	
    	$('.job_menu').toggleClass('toggled-on');
    });

  });

