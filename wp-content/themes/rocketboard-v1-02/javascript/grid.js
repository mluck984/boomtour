// JavaScript Document

//0 - twitter
//1 - music
//2 - instagram
var filters = [true,true,true,true];
var state = "all";
var container;
var msnry;

$(document).ready(function(){
	
		
	container = $('#grid');
	// initialize
	container.masonry({
	  columnWidth: '.grid-sizer',
	  itemSelector: '.grid-item'
	});
	
	msnry = container.data('masonry');
	setTimeout(function(){ msnry.layout(); }, 500);
	
	$('.grid-filters .filter').click(function(){
		var type = $(this).attr('id');
		var index = strToIndex(type);
		
		if( ( (state == "all") && (type != "all")) || ( (state == "filtered") && (type != "all") && (filters[index]==false)) ){
			for(var i = 0; i < filters.length; i++){
				if(i == index){
					filters[i] = true;
				} else{
					filters[i] = false;
				}
			}
			
			var tileArr = msnry.getItemElements();
			var hideArr = [];
			var showArr = [];
			
			for(var i = 0; i < tileArr.length; i++){
				var $element = $(tileArr[i]);
				var tile = msnry.getItem(tileArr[i]);
				
				if($element.hasClass(type)){
					showArr.push(tile);
					//msnry.reveal(tile);
				} else if(! $element.hasClass('sweepstakes')){
					hideArr.push(tile);
					//msnry.hide(tile);
				}
			}
			
			msnry.hide(hideArr);
			msnry.reveal(showArr);
			setTimeout(function(){ msnry.layout(showArr, true); }, 700);
			
			$('.grid-filters ul li').each(function(){
				if($(this).attr('id') == "filter-by") return true;
				if($(this).attr('id') != type) {
					$(this).removeClass('filter-on');
					$(this).addClass('filter-off');
				} else{
					$(this).removeClass('filter-off');
					$(this).addClass('filter-on');
				}
			});
			
			state = "filtered";
		} else{
			for(var i = 0; i < filters.length; i++){
				filters[i] = true;
			}
			
			var tileArr = msnry.getItemElements();
			var showArr = [];
			
			for(var i = 0; i < tileArr.length; i++){
				var tile = msnry.getItem(tileArr[i]);
				showArr.push(tile);
			}
			
			msnry.hide(hideArr);
			msnry.reveal(showArr);
			setTimeout(function(){ msnry.layout(showArr, true); }, 700);
			
			
			$('.grid-filters ul li').each(function(){
				if($(this).attr('id') == "filter-by") return true;

				$(this).removeClass('filter-off');
				$(this).addClass('filter-on');
			});
			
			state = "all";
		}
		
	});
	
	
	$('.image-popup-fit-width').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: false
		}
	});
	
	$('.grid-item.photo').hover(
		function(){
			$('p', this).fadeIn(200);
		},
		function(){
			$('p', this).fadeOut(200);
		}	
	);
	
	
});

$(function() {
	if( screen.width > 640 ) {
		var BV = new $.BigVideo({container: $('.header-video'), doLoop: true, useFlashForFirefox:false});
		BV.init();
		if ($.browser.mozilla) {
			BV.show('wp-content/themes/rocketboard-v1-02/assets/LessBlack.ogv',{ambient:true});
		} else{
			BV.show('wp-content/themes/rocketboard-v1-02/assets/LessBlack.mp4',{ambient:true});
		}
	}
});

function strToIndex(string){
	if(string == 'twitter') return 0;
	if(string == 'music') return 1;
	if(string == 'photo') return 2;
	if(string == 'product') return 3;

	return 0;
	
}