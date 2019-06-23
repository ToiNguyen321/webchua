$(document).ready(function(){
	$(window).scroll(function(){
		var footer = $("#form-binh-luan");
		var footer_height;
		//Check có phần tử footer ko.
		if(typeof(footer.offset()) != "undefined"){
			footer_height = footer.offset().top;
		}

		
		$("#banner .latest-comments-widget.col-12.banner").css({
			'min-height': 600
		});
		var docao_banner = $("#banner").height();
		var height_scroll = $(window).scrollTop();
		var do_cao_an_banner = footer_height - docao_banner +200;
		var width = $('body').width();
		if(height_scroll > 380 && height_scroll < do_cao_an_banner && width > 991){
			top_ = height_scroll - 350;
			$("#banner").css({'top': top_, 'display': 'block'});
		}else if(height_scroll > do_cao_an_banner || width < 991){
			$("#banner").css({'display': 'none'});
		}else{
			$("#banner").css({'top': 0, 'display': 'block'});
		}

		
	});
	$(window).resize(function(){
		var width = $('body').width();
		if(width < 991){
			$("#banner").css({'display': 'none'});
		}else{
			$("#banner").css({'display': 'block'});
		}
	});
})