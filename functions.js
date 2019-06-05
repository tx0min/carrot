function al(msg){
	console.log(msg);
}

function scrollBodyTo(href,speed){
	if(arguments.length==1) speed=1000;
	var targetOffset=$(href).offset().top;
	if(windowWidth>767) targetOffset-= $("#main-menu").height();
	$('body').animate({scrollTop: targetOffset}, {duration:speed});
}


function initSmoothScroll(){
	var hash = window.location.hash.substr(1);
	if(hash){
		scrollBodyTo("#"+hash,0);
	}
	$('a[href^=\\#]').on('click',function(e) {
		e.preventDefault();
		var href=$(this).attr('href');
		if($(href).size()>0) scrollBodyTo(href);
		
	});
		 


}

function isOnTop(){
	var offset=10;
	
	var top =  $("#main-menu").height() ;
	
	if($("#landpage").length>0) top = windowHeight - top;
	
	return $(window).scrollTop() <= (top-offset)  ;
}

function $passed(elem){
	if($(elem).length==0) return false;
	var top=$(elem).offset().top;
	return $(window).scrollTop() >= top;
}


function isOnBottom(){
	return ($(window).scrollTop() + $(window).height()) >= $(document).height()  ;
}


