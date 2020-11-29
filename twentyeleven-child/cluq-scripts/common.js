var $jQ = jQuery.noConflict();
$jQ(".type-post" ).addClass("cluq-content-strech");
$jQ(".page-template-page-Union-Info .uq-gallerie" ).toggleClass("stretch-gallery ");
$jQ( function() {
	function transitionMenu(elem, duration){
		elem.animate({
						
						width:"toggle",
						opacity:"toggle",
						
					  }, duration, function() {
						// Animation complete.
						
	});
	}
	
	
	$jQ( "#cluq-menu-button" ).on( "click", function() {
		$jQ(".type-post" ).toggleClass("cluq-content-reduce cluq-content-strech ");
		$jQ("#container-gallery" ).toggleClass("cluq-content-reduce cluq-content-strech ");
		$jQ(".page-template-page-Union-Info .uq-gallerie" ).toggleClass("stretch-gallery ");
		transitionMenu($jQ( ".widget-area" ),200);
		
			
    });
});
