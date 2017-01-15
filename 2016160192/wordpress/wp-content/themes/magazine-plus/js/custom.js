( function( $ ) {

  $(document).ready(function($){

  	// Tabbed.
  	$('.tabbed-container').easytabs({
  		updateHash: false,
  		animationSpeed: 'fast'
  	});

    // Search in Header.
    if( $('.search-icon').length > 0 ) {
        $('.search-icon').click(function(e){
            e.preventDefault();
            $('.search-box-wrap').slideToggle();
        });
    }

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });

    // Trigger top mobile menu.
    var $mobile_trigger2 = $('#mobile-trigger2');
    if ( $mobile_trigger2.length > 0 ) {
	    $mobile_trigger2.sidr({
			timing: 'ease-in-out',
			side: 'right',
			speed: 500,
			source: '#mob-menu2',
			name: 'sidr2'
	    });
    }

    // Notice ticker.
    var $news_ticker = $('#news-ticker');
    if ( $news_ticker.length > 0 ) {
    	$news_ticker.easyTicker({
    		direction: 'up',
    		easing: 'swing',
    		speed: 'slow',
    		interval: 3000,
    		height: 'auto',
    		visible: 1,
    		mousePause: 1
    	});
    }

    // Implement go to top.
	var $scroll_obj = $( '#btn-scrollup' );
	$( window ).scroll(function(){
		if ( $( this ).scrollTop() > 100 ) {
			$scroll_obj.fadeIn();
		} else {
			$scroll_obj.fadeOut();
		}
	});

	$scroll_obj.click(function(){
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		return false;
	});

  });

} )( jQuery );
