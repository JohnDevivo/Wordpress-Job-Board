
$(function() {

    // creates tabs for index page
    $( "#listings-contain" ).tabs();

    // hides and shows job board menu for small screens
    $('#job_board_menu').click(function(){
    	
    	$('.job_menu').toggleClass('toggled-on');
    });

// media Match for home page browse listings
//     var mq = window.matchMedia( "(min-width: 500px)" );
//     if (mq.matches) {
//   // window width is at least 500px
//   $( "#listings-contain" ).tabs();
// }
// else {
//   // window width is less than 500px
//   $('#listings-contain').accordion();
// }

  });

