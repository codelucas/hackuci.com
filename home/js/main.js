$(document).ready(function() {


  // $('#selector').css('padding-top', ($(window).height()/2)-$('#selector').height()/2 - $('header').height()-100);
  // $('#globalWrapper').height($(window).height() - $('header').height());


  // $(window).resize(function() {
  //     $('#selector').css('padding-top', ($(window).height()/2)-$('#selector').height()/2 - $('header').height()-100);
  //     $('#globalWrapper').height($(window).height() - $('header').height());
  // });
  
  
 /* 
  //selectors animation
  $('#selector article').hover(
  function () {

    $(this).stop(true, true).fadeTo( "slow" , 1).end();
    $('#selector article').fadeTo( "slow" , 0.2);
  }, 
  function () {
    $('#selector article').fadeTo( "slow" , 1);
    //$(this).stop(true, true).animate({ opacity:.2}, 300, 'swing').end();
	}
);*/
  	$('#selector').children().hover(function() {
		$(this).siblings().stop().fadeTo(500,0.25);
	}, function() {
		$(this).siblings().stop().fadeTo(500,1);
	});
  
  
  
  
});
