// JavaScript Document

//0 - twitter
//1 - music
//2 - instagram
var filters = [true,true,true];
var state = "all";

$(document).ready(function(){
	
	$('.grid-filters .filter').click(function(){
		var type = $(this).attr('id');
		var index = strToIndex(type);
		var delay = 0;
		
		if( (state == "all") || ( (state == "filtered") && (filters[index]==false)) ){
			for(var i = 0; i < filters.length; i++){
				if(i == index){
					filters[i] = true;
				} else{
					filters[i] = false;
				}
			}
			
			$('#grid-container .grid-item').each(function(){
				if($(this).hasClass(type)){
					$(this).delay(delay).fadeIn("fast");
				} else{
					if(! $(this).hasClass('sweepstakes')){
						$(this).delay(delay).fadeOut("fast");
					}
				}
				delay += 10;
			});
			
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
			
			$('#grid-container .grid-item').each(function(){
				$(this).delay(delay).fadeIn("fast");
			});
			
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
	
	
});

$(function() {
	if( screen.width > 640 ) {
		var BV = new $.BigVideo({container: $('.header-video'), doLoop: true});
		BV.init();
		BV.show('wp-content/themes/rocketboard-v1-02/assets/LessBlack.mp4',{ambient:true});
	}
});

function strToIndex(string){
	if(string == 'twitter') return 0;
	if(string == 'music') return 1;
	if(string == 'photo') return 2;

	return 0;
	
}