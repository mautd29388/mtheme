(function($) {
	"use strict";
	
	var $slider = $('#portfolio .slider-wrapper'),
		waypoint,
		$isotope_container = $('.isotopeContainer');
	
	$(window).load(function() {
		
		// Add min-height
		add_min_height();
		
		page_fixed();
		
		// Single Carousel
		single_carousel();
		
		padding_top();
		
		// Header Style 4
		if ( $('body.style_v4').length > 0 ) {	
    		var $item_menu = $('body.style_v4').find('#navbar ul.nav > li'),
    			index = Math.round($item_menu.length/2), 
    			$parent = $item_menu.slice(index, index + 1),
    			$logo = $('body.style_v4').find('#logo');
    		
    		$parent.css( {"margin-left": $logo.outerWidth() + 20})
    			.addClass('item-center');
    		
    		$logo.offset({top: $logo.offset().top,left:$parent.offset().left - $logo.outerWidth() - 10});
		} // End Header Style 4
		
		
		// Isotope
		if ( $isotope_container.length > 0 ) {
			
			$isotope_container.siblings('a#loadmore').hide();
			
			$isotope_container.imagesLoaded(function() {
				$isotope_container.isotope({
					layoutMode : 'masonry',
				});
			});
			
			
			// filter items
			if ( $isotope_container.siblings('#filters').length > 0 ) {
				
				$isotope_container.siblings('#filters').on('change', 'select[name=filters]', function() {
					var $this = $(this),
						filterValue = $this.val();
				
					$isotope_container.isotope({
						filter : filterValue,
					});
					
					return false;
				});
			}
				
			$isotope_container.imagesLoaded(function() {
				
				waypoint = new Waypoint({
					element: $isotope_container[0],
					handler: function(direction) {
						
						scroll_load( direction, $isotope_container );
					},
					offset: 'bottom-in-view',
				});
				
			});
		
		} // End Isotope
		
	});
	
	
	$(document).ready(function() {
		
		// Nivo Slider;
		$slider.imagesLoaded(function() {
			
			if ($slider.find('#portfolio-slider').length > 0 ) {
				$slider.find('#portfolio-slider').nivoSlider({
					pauseTime: 5000,
					prevText: '<i class="fa fa-angle-left"></i>',
				    nextText: '<i class="fa fa-angle-right"></i>',
				    beforeChange: function(){
				    	$slider.find('.nivo-caption').animate({right: "-100%"}, 600);
				    },    
				    afterChange: function(){
				    	
				    	$('body').find('a#pullDown').attr('href', $slider.find('.nivo-caption .entry-title a').attr('href'));
				    	
				    	var right = $slider.find('.nivo-directionNav').css('right'),
				    		width = $slider.find('.nivo-caption').outerWidth();
				    	if ( right != width ) {
				    		$slider.find('.nivo-directionNav').animate({right: width}, 600);
				    		$slider.find('.nivo-controlNav').animate({right: width}, 600);
				    		$slider.find('#pullDown').animate({right: width}, 600);
				    	}
				    	
				    	$slider.find('.nivo-caption').animate({right: "0"}, 600);
				    	
				    },        
				    slideshowEnd: function(){
				    },     
				    lastSlide: function(){
				    },         
				    afterLoad: function(){
				    	
				    	// Add min-height
			    		add_min_height();
			    		
				    	var right = $slider.find('.nivo-directionNav').css('right'),
				    		width = $slider.find('.nivo-caption').outerWidth();
				    	if ( right != width ) {
				    		$slider.find('.nivo-directionNav').animate({right: width}, 600);
				    		$slider.find('.nivo-controlNav').animate({right: width}, 600);
				    		$slider.find('#pullDown').animate({right: width}, 600);
				    	}
			    	
				    	$slider.find('.nivo-caption').animate({right: "0"}, 600);
				    
				    },         
				});
				
			}
		}); // End Nivo
		
		
		// Submenu
		$('body').find('ul.sub-menu').each(function () {
			
			var $this = $(this),
				$parent = $this.parent();
			
			$parent.prepend('<a href="#" class="dropdown"><i class="fa fa-caret-down"></i></a>').addClass('has-children');
			
		});
		$('body').find('#navbar').on('click', 'a.dropdown', function (e) {
			
			e.preventDefault();
			
			var $this = $(this),
				$parent = $this.parent();
			
			$parent.siblings().children('ul').slideUp(350);
			$parent.children('ul').slideToggle(350);
			
			return false;
		});// End Submenu
		
		
		// Load Ajax Single
		$(' body ').on('click', '#portfolio a#pullDown, #portfolio h2.entry-title a, .aella-team h3.entry-title a, .aella-team figure a, .aella-gallery h2.entry-title a, .aella-gallery figure a ', function (e) {
			
			e.preventDefault();
			
			var $url = $(this).attr('href'),
				single = $(this).attr('data-single-id');
			
			if ( typeof $url !== "undefined" && $url != '' && $url != '#' && $(single).length > 0 ) {
				
				if ( !$('body').hasClass('overflowHidden') ) 
					$('body').addClass('overflowHidden');
				
				if ( !$(single).hasClass('in') ) 
					$(single).addClass('in');
				
				$( document ).ajaxStart(function() {
					if ( !$(single).hasClass('loadPage') ) 
						$(single).addClass('loadPage');
				});
				$( document ).ajaxStop(function() {
					$(single).removeClass('loadPage');
				});
				
				$.ajax({
					url: $url,
					cache: false,
				}).done(function( html ) {
					
					$(single).html($(html).find(single).html());
					
				})
				.fail(function() {
					location.reload();
				})
				.always(function() {

					page_fixed();
					single_carousel();
					
					var $entry_social = $('body').find('#entry-social');
					if ( $entry_social.length > 0 ) {
						$(single).find('.pageFixed-inner').append( $entry_social.html() );
					}
						
				});
			}
			
			return false;
		}); // End Load Ajax Single
		
		
		$('body.style_v3').find('.navbar .navbar-header .navbar-toggle').removeAttr('data-toggle');
		
		$('body.style_v3').find('.navbar .navbar-header').on('click', '.navbar-toggle', function (e) {
			
			e.preventDefault();
			
			var $this = $(this),
				$parents = $this.parents('#primary-navigation');
			
			if ( $parents.css('right') != '0px' ) {
				$parents.animate({right: "0px"}, 500);
				
			} else $parents.animate({right: '-350px'}, 500);
			
			return false;
		});
		
		
		//Responsive Video
		var $allVideos = $("iframe[src*='//player.vimeo.com'], iframe[src*='//www.youtube.com'], object, embed"),
	    	$fluidEl = $("figure");
		
		if ( $fluidEl.length > 0 ) {
			$allVideos.each(function() {
				$(this)
			    	// jQuery .data does not work on object/embed elements
			    	.attr('data-aspectRatio', this.height / this.width)
			    	.removeAttr('height')
			    	.removeAttr('width');
			});
			
			$(window).resize(function() {
				var newWidth = $fluidEl.width();
				$allVideos.each(function() {
					var $el = $(this);
					$el
						.width(newWidth)
						.height(newWidth * $el.attr('data-aspectRatio'));
				});
				
			}).resize();
			
		} // End resonsive video
		
		
		$('.carousel-galleries_v3').on('slide.bs.carousel', function (e) {
			  var $this = $(this);
			  
			  if ( e.direction == 'right' && $this.find('.item.active').is( ":first-child" ) ) {
				  
				  if ( $this.find('.left.carousel-control').attr('data-url') != '' )
					  location.replace($this.find('.left.carousel-control').attr('data-url'));
					 
				  return false;
			  
			  } else if ( e.direction == 'left' && $this.find('.item.active').is( ":last-child" ) ) {
				  
				  if ( $this.find('.right.carousel-control').attr('data-url') != '' )
					  location.replace($this.find('.right.carousel-control').attr('data-url'));
					
				  return false;
			  }
			  
		});
	});
	
	
	//Scroll Load Ajax
	function scroll_load( direction, $isotope_container ) {
		
		if ( direction == 'down' ) {
			var $url = $isotope_container.siblings('a#loadmore').attr('href');
			
			if ( typeof $url !== "undefined" && $url != '' && $url != '#' ) {
				$.ajax({
					url: $url,
					cache: false,
					
				}).done(function( html ) {
					
					var elements = $(html).find('.isotopeContainer > article');
					
					$isotope_container.append( elements ).isotope( 'insert', elements );
					
					// Change a#loadmore
					$isotope_container.siblings('a#loadmore').attr('href', $(html).find('a#loadmore').attr('href'));
					
				})
				.fail(function() {
					location.reload();
				})
				.always(function() {
					
					$isotope_container.imagesLoaded(function() {
						$isotope_container.isotope('layout');
						
						padding_top();
						
						Waypoint.refreshAll();
						
						waypoint.destroy();
						
						waypoint = new Waypoint({
							element: $isotope_container[0],
							handler: function(direction) {
								
								scroll_load( direction, $isotope_container );
							},
							offset: 'bottom-in-view',
						});
					});
					
					$url = $isotope_container.siblings('a#loadmore').attr('href');
					
					if ( typeof $url === "undefined" || $url == '' || $url == '#' ) {
						
						$isotope_container.siblings('.loading').html('<span>No More Posts to Show</span>');
					
					}
				});
			} 
		}
		
		return false;
	}
	
	//Page Fixed
	function page_fixed() {
		
		var $page_fixed = $('body').find('.pageFixed');
		
		if ( $page_fixed.length > 0 ) {
			
			// Page Fixed Title 
			if ( $page_fixed.hasClass('single-portfolio') || $page_fixed.hasClass('single-gallery') ) {
				
				$page_fixed.find('h2.entry-title').css( 'margin-left', '-' + $page_fixed.find('h2.entry-title').outerWidth()/2 + 'px' );
			}
			
			//Hide Page Fixed
			$page_fixed.on('click', '#pullUp', function (e) {
				e.preventDefault();
				$page_fixed.removeClass('in');
				
				setTimeout(function(){
					$('body').removeClass('overflowHidden');
				},1000);
				
				return false;
			});
		}
		
		return false;	
	}
	
	// Single Carousel
	function single_carousel() {
		
		var $single_carousel = $('body').find('.pageFixed .carousel');
		
		if ( $single_carousel.length > 0 ) {
			
			// ScrollBar
			scroll_bar();
			
			$single_carousel.on('slid.bs.carousel', function () {
				
				var $this = $(this),
					$url = $this.find('.item.active').attr('data-url');
				
				if ( typeof $url !== "undefined" && $url != '' && $url != '#' && $this.find('.item.active').children().length < 1 ) {
					
					$.ajax({
						url: $url,
						cache: false,
					}).done(function( html ) {
						
						$this.find('.item.active').html($(html).find('.carousel .item.active').html());
						
					})
					.fail(function() {
						location.reload();
					})
					.always(function() {
						
						if ( $this.parents('#single-portfolio').length > 0 || $this.parents('#single-gallery').length > 0 ) {
							
							// ScrollBar
							scroll_bar();
							
							$this.find('.item.active h2.entry-title').css( 'margin-left', '-' + $this.find('.item.active h2.entry-title').outerWidth()/2 + 'px' );
							
						}
					});
					
				}
				
			});
		}
		
		return false;
	}
	
	// ScrollBar
	function scroll_bar(){
		
		var $carousel_gallery = $('body').find('.carousel-gallery');
		
		if ( $carousel_gallery.length > 0 ) {
			$carousel_gallery.imagesLoaded(function() {
				
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					$carousel_gallery.find(".item.active .entry-thumbnail-inner").smoothDivScroll({
						hotSpotScrolling: false,
						touchScrolling: true,
						manualContinuousScrolling: false,
						mousewheelScrolling: false,
					});
				
				} else {
					$carousel_gallery.find(".item.active .entry-thumbnail-inner").smoothDivScroll({
						hotSpotScrolling: true,
						touchScrolling: true,
						manualContinuousScrolling: false,
						mousewheelScrolling: true,
					});
				}
			});
		}
		
		return false;
	}
	
	function add_min_height() {
		
		// Add min-height
		
		if ( $('body').hasClass('style_v1') ) {
			var min_height = $( window).height();
			
			if ( min_height < $('.main-content').outerHeight(true) )
				min_height = $('.main-content').outerHeight(true);
				
			if ( min_height < $('header.header').outerHeight(true) )
				min_height = $('header.header').outerHeight(true);
			
			$('.main-content').css('min-height', min_height);
			$('header.header').css('min-height', min_height);
		}
		
		return false;
	}
	
	function padding_top() {
		
		$('body').find('.aella-gallery figure').each( function () {
			var $padding_top = $(this).outerHeight();
			
			$(this).find('a').css('padding-top', $padding_top/2);
		});
		
		return false;
	}
	
})(jQuery);