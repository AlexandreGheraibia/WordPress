$jQ(function() {

				var Page = (function() {

					var $navArrows = $jQ( '#nav-arrows' ).hide(),
						$navDots = $jQ( '#nav-dots' ).hide(),
						$nav = $navDots.children( 'span' ),
						$shadow = $jQ( '#shadow' ).hide(),
						$col= $jQ( '.column' ),
						$wrapper=$jQ( '.wrapper' ),
						slicebox = $jQ( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								$navDots.show();
								$shadow.show();

							},
							onBeforeChange : function( pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

							$nav.each( function( i ) {
							
								$jQ( this ).on( 'click', function( event ) {
									
									var $dot = $jQ( this );
									
									if( !slicebox.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slicebox.jump( i + 1 );
									return false;
								
								} );
								
							} );
							
								$col.each( function( i ) {
									$jQ( this ).on( 'click', function( event ) {
										
										if( !slicebox.isActive() ) {

											$nav.removeClass( 'nav-dot-current' );
											$jQ($nav[i]).addClass( 'nav-dot-current' );
											$wrapper.css( {'visibility':'visible'});
										}
										
										slicebox.jump( i+1 );
										
										return;
									
									} );
								});

								$jQ( '#sb-slider' ).on( 'click',function( event ) {
									
									 event.stopPropagation();
									
								});
							
								$wrapper.on( 'click', function( event ) {
									
									$wrapper.css( {'visibility':'hidden'});
									
								});
							
						}

						return { init : init };

				})();

				Page.init();

			});