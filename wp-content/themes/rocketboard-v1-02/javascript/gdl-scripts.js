jQuery(document).ready(function(){
	
	// Search Default text
	jQuery('.search-text input').live("blur", function(){
		var default_value = jQuery(this).attr("data-default");
		if (jQuery(this).val() == ""){
			jQuery(this).val(default_value);
		}	
	}).live("focus", function(){
		var default_value = jQuery(this).attr("data-default");
		if (jQuery(this).val() == default_value){
			jQuery(this).val("");
		}
	});	

	// Social Hover
	jQuery("#gdl-social-icon .social-icon").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Accordion
	var gdl_accordion = jQuery('ul.gdl-accordion');
	gdl_accordion.find('li').not('.active').each(function(){
		jQuery(this).children('.accordion-content').css('display', 'none');
	});
	gdl_accordion.find('li').click(function(){
		if( !jQuery(this).hasClass('active') ){
			jQuery(this).addClass('active').children('.accordion-content').slideDown(function(){
				jQuery("html:not(:animated),body:not(:animated)").animate({ scrollTop: jQuery(this).parent('li').offset().top });
			});
			jQuery(this).siblings('li').removeClass('active').children('.accordion-content').slideUp();
		}
	});
	
	// Toggle Box
	var gdl_toggle_box = jQuery('ul.gdl-toggle-box');
	gdl_toggle_box.find('li').not('.active').each(function(){
		jQuery(this).children('.toggle-box-content').css('display', 'none');
	});
	gdl_toggle_box.find('li').click(function(){
		if( jQuery(this).hasClass('active') ){
			jQuery(this).removeClass('active').children('.toggle-box-content').slideUp();
		}else{
			jQuery(this).addClass('active').children('.toggle-box-content').slideDown();
		}
	});	
	
	// Tab
	var gdl_tab = jQuery('div.gdl-tab');
	gdl_tab.find('.gdl-tab-title li a').click(function(e){
		if( jQuery(this).hasClass('active') ) return;
		
		var data_tab = jQuery(this).attr('data-tab');
		var tab_title = jQuery(this).parents('ul.gdl-tab-title');
		var tab_content = tab_title.siblings('ul.gdl-tab-content');
		
		// tab title
		tab_title.find('a.active').removeClass('active');
		jQuery(this).addClass('active');
		
		// tab content
		tab_content.children('li.active').removeClass('active').css('display', 'none');
		tab_content.children('li[data-tab="' + data_tab + '"]').fadeIn().addClass('active');
		
		e.preventDefault();
	});
	
	// Scroll Top
	jQuery('div.scroll-top').click(function() {
		jQuery('html, body').animate({ scrollTop:0 }, { duration: 600, easing: "easeOutExpo"});
		return false;
	});
	
	// Blog Hover
	jQuery(".blog-media-wrapper.gdl-image img, .port-media-wrapper.gdl-image img, .gdl-gallery-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Port Hover
	jQuery(".portfolio-item .portfolio-media-wrapper.gdl-image a.hover-wrapper").hover(function(){
		jQuery(this).animate({ opacity: 1 }, 200);
	}, function(){
		jQuery(this).animate({ opacity: 0 }, 200);
	});
	
	// Board Hover
	jQuery(".rocket-board-item-wrapper.feature-image").each(function(){
		jQuery(this).hover(function(){
			jQuery(this).find('img').animate({ opacity: 1 }, 200);
			jQuery(this).find('.hidden-title-wrapper').slideDown(200);
		}, function(){
			jQuery(this).find('img').animate({ opacity: 0.6 }, 200);
			jQuery(this).find('.hidden-title-wrapper').slideUp(200);
		});	
		
	});	
	
	// Color Board Hover
	jQuery(".rocket-board-item-wrapper.color-board").each(function(){
		if( jQuery(this).find('.color-board-image-wrapper').length > 0 ){
			jQuery(this).hover(function(){
				jQuery(this).children('.color-board-wrapper').animate({ 'margin-left': '-100%' }, 200);
				jQuery(this).find('.hidden-title-wrapper').delay(150).slideDown(200);
			}, function(){
				jQuery(this).children('.color-board-wrapper').animate({ 'margin-left': '0%' }, 200);
				jQuery(this).find('.hidden-title-wrapper').slideUp(200);
			});	
		}
	});		
	
	// Search Box
	var search_button = jQuery("#searchsubmit");
	var search_wrapper = search_button.parents('.top-search-wrapper');
	search_button.click(function(){
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active');
			search_wrapper.animate({'opacity':'0.2', 'width':'50px'},200);
		}else{
			jQuery(this).addClass('active');
			search_wrapper.animate({'opacity':'0.7', 'width':'250px'},200);
			return false;
		}
	});
	search_wrapper.click(function(e){
		if (e.stopPropagation){ e.stopPropagation();
		}else if(window.event){ window.event.cancelBubble = true; }
	});
	jQuery(document).click(function(){
		search_button.removeClass('active');
		search_wrapper.animate({'opacity':'0.2', 'width':'50px'});	
	});	
	
	// JW Player Responsive
	responsive_jwplayer();
	function responsive_jwplayer(){
		jQuery('[id^="jwplayer"][id$="wrapper"]').each(function(){
			var data_ratio = jQuery(this).attr('data-ratio');
			if( !data_ratio || data_ratio.length == 0 ){
				data_ratio = jQuery(this).height() / jQuery(this).width();
				jQuery(this).css('max-width', '100%');
				jQuery(this).attr('data-ratio', data_ratio);
			}
			jQuery(this).height(jQuery(this).width() * data_ratio);
		});
	}
	jQuery(window).resize(function(){
		responsive_jwplayer();
	});

});
jQuery(window).load(function(){

	// Menu Navigation
	jQuery('#main-superfish-wrapper ul.sf-menu').supersubs({
		minWidth: 14.5, maxWidth: 27, extraWidth: 1
	}).superfish({
		delay: 400, speed: 'fast', animation: {opacity:'show',height:'show'}
	});

	// Set Portfolio Max Height
	function set_portfolio_height(){
		jQuery('div.portfolio-item-holder').each(function(){
			var max_height = 0; 
			jQuery(this).children('.portfolio-item').height('auto');
			jQuery(this).children('.portfolio-item').each(function(){
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}				
			});
			jQuery(this).children('.portfolio-item').height(max_height);
		});
	}
	setTimeout(function(){ set_portfolio_height(); }, 100);

	// Personnal Item Height
	function set_personnal_height(){
		jQuery(".personnal-item-holder .row").each(function(){
			var max_height = 0;
			jQuery(this).find('.personnal-item').height('auto');
			jQuery(this).find('.personnal-item-wrapper').each(function(){
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}
			});
			jQuery(this).find('.personnal-item').height(max_height);
		});		
	}
	set_personnal_height();
	
	// Price Table Height
	function set_price_table_height(){
		jQuery(".price-table-wrapper .row").each(function(){
			var max_height = 0;
			jQuery(this).find('.best-price').removeClass('best-active');
			jQuery(this).find('.price-item').height('auto');
			jQuery(this).find('.price-item-wrapper').each(function(){
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}
			});
			jQuery(this).find('.price-item').height(max_height);
			jQuery(this).find('.best-price').addClass('best-active');
		});		
	}	
	set_price_table_height();

	// Navigation Sliding Bar
	var header_area = jQuery('.header-navigation-container');
	var navigation_wrapper = header_area.find('.navigation-wrapper');
	
	var main_navigation = header_area.find('#main-superfish-wrapper');
	var sliding_bar = main_navigation.siblings('.gdl-current-menu');
	var sf_menu = main_navigation.children('ul.sf-menu');
	var current_bar = sf_menu.children('.current_page_item, .current_page_ancestor');
	if( !current_bar.length ){ current_bar = sf_menu.children().filter(':first'); }
	
	function init_navigation_sliding_bar(){
		// sliding bar width
		sliding_bar.css({ 'width':current_bar.outerWidth(), 'left':current_bar.position().left });
		
		// sub nav height
		var header_height = parseInt(header_area.css('height'));
		var nav_margin = parseInt(navigation_wrapper.css('margin-top'));
		var nav_height = parseInt(navigation_wrapper.css('height'));
		
		sf_menu.children('li').children('ul.sub-menu').css('top', header_height + 'px');
		sf_menu.children('li').css('padding-bottom', (header_height - nav_height) + 'px');
	}
	
	init_navigation_sliding_bar();
	sf_menu.children().hover(function(){
		sliding_bar.animate({ 'width':jQuery(this).outerWidth(), 'left':jQuery(this).position().left }, 
			{ queue: false, easing: 'easeOutQuad', duration: 250 });
	},function(){
		sliding_bar.animate({ 'width':current_bar.outerWidth(), 'left':current_bar.position().left }, 
			{ queue: false, easing: 'easeOutQuad', duration: 250 });
	});	
	
	// When window resize, set all function again
	jQuery(window).resize(function(){
		set_portfolio_height()	
		set_personnal_height();
		set_price_table_height();
	});	
	
});

