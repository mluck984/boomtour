// JavaScript Document

//0 - twitter
//1 - music
//2 - instagram
var filters = [true,true,true,true,true];
var state = "all";
var container;
var msnry;
var flash = false;

$(document).ready(function(){
		
	initGrid();
	
	if(swfobject.getFlashPlayerVersion().major == 0){
		flash = false;
		$(".grid-item.music").hide();
		$(".grid-filters #music").hide();
	} else{
		flash = true;
	}
	
	//GAME
	if ( navigator.userAgent.match(/(iPod|iPhone|iPad)/i)) {
		$('#tictactoe').click(function(){
			var $newWindow = window.open("tictactoe/");

		});
	} else{
		$('#tictactoe').magnificPopup({
			items: {
			  src: '<div class="mfp-close"></div><iframe src="tictactoe/" width="320" height="480"></iframe>',
			  type: 'inline',
			}
		});
	}
	
});

function initGrid(){
	
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
			setTimeout(function(){ msnry.layout(showArr, true); }, 800);
			
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
				var $element = $(tileArr[i]);
				var tile = msnry.getItem(tileArr[i]);
				if(! $element.hasClass("music")){
					showArr.push(tile);
				} else{
					if(flash){
						showArr.push(tile);
					}
				}
			}
			
			msnry.hide(hideArr);
			msnry.reveal(showArr);
			setTimeout(function(){ msnry.layout(showArr, true); }, 800);
			
			
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
	
	$('.grid-item.poll .answers li').bind("click", function(){
		var poll = $(this).parent().attr("poll");
		var answer = $(this).attr("answer");

		$.ajax({
		  url: "wp-content/themes/rocketboard-v1-02/polls-send.php?p="+poll+"&a="+answer
		})
		
		var sum = parseInt($(this).parent().attr("sum")) + 1;
		
		$(this).parent().removeClass("answers");
		$(this).parent().addClass("results");
		
		var i = 0;
		
		$(this).parent().find('li').each(function(){
			var result = $(this).attr("result");
			var text = $(this).html();
			if(i == answer) result++;
			
			var width = 100 * (result / sum);
			$(this).css("background-size", width+"% 100%");
			$(this).html("<div>" + Math.floor(width) + "%</div><div class='answer-text'>"+text+"</div>");
			$(this).unbind("click");
			
			i++;
		});
		
		$(this).parent().parent().hide();
		$(this).parent().parent().fadeIn(250);
		
		var answeredArr = [];
		if($.cookie("boomtour-polls")){
			answeredArr = $.cookie("boomtour-polls").split(",")
		}
		answeredArr.push(poll);
		var str = answeredArr.join(",");
		console.log(str);
		$.cookie("boomtour-polls", str, { expires: 30 });
	});
}



//MOBILE
$(function() {
	if( screen.width > 640 ) {
		var BV = new $.BigVideo({container: $('.header-video'), doLoop: true, useFlashForFirefox:false});
		BV.init();
		if ($.browser.mozilla) {
			BV.show('wp-content/themes/rocketboard-v1-02/assets/BoomTour_NewVid_1.ogv',{ambient:true});
		} else{
			BV.show('wp-content/themes/rocketboard-v1-02/assets/BoomTour_NewVid_1.mp4',{ambient:true});
		}
	}
});

function strToIndex(string){
	if(string == 'twitter') return 0;
	if(string == 'music') return 1;
	if(string == 'photo') return 2;
	if(string == 'product') return 3;
	if(string == 'poll') return 4;

	return 0;
	
}