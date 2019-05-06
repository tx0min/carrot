(function ( $ ) {
	var bookCaseDefaults = {
		bookw: 200,
		bookh: 320,
		inset: 5,
		pages: 400,
		covertype : "soft",
		coverthickness : { "hard" : 4, "soft" : 1},
		title : "",
		synopsys : "",
		author : "",
		showSimpleController : false,
		showController : false,
		showPalette : false
		
	};
	
	$.fn.bookCase = function( options ){
		
	
		
		var settings = $.extend( true, {}, bookCaseDefaults, options );


		function al(msg){
			console.log(msg);
		}

		function resetClasses(book){
			var classes=[];
			if(book.is(".backhide")){
				classes.push("backhide");
			}
			book.attr("class","book").addClass(classes.join(" "));
		}
		
		
		function getControlsContainer(book){
			var controls = book.parent().parent().find(".book-controls");
			
			if(controls.length==0){
				controls=$('<div class="book-controls">');
				book.parent().after(controls);
				
			}
			
			return controls;
		}
		
			
		function getSimpleControlsContainer(book){
			var controls = book.parent().parent().find(".book-simple-controls");
			
			if(controls.length==0){
				controls=$('<div class="book-simple-controls">');
				book.parents(".bk-book").after(controls);
				
			}
			
			return controls;
		}
			

		function createPalette(book){
		
			var controls = getControlsContainer(book);
			
			
			
		
			var img = book.find("img");
			var colorThief = new ColorThief();
			var dominantColor = colorThief.getColor(img[0]);
			var paletteArray = colorThief.getPalette(img[0], 3);
			
			/*paleta*/
			var palette=$("<p class='palette'>");
			palette.append($("<span class='color main'></span>").css("background-color","rgb("+dominantColor[0]+","+dominantColor[1]+","+dominantColor[2]+")"));
			for(var i in paletteArray){
				var color=$("<span class='color "+(i==0?"selected":"")+"'></span>").css("background-color","rgb("+paletteArray[i][0]+","+paletteArray[i][1]+","+paletteArray[i][2]+")");
				
				palette.append(color);
			}
			
			palette.find(".color").on("click",function(e){
				
				e.preventDefault();
				e.stopPropagation();
				$(this).siblings().removeClass("selected");
				$(this).addClass("selected");
				$(this).parents(".book-wrap").find(".book").find(".book-back, .book-left, .book-left-mass-top, .book-left-mass-right, .book-left-mass-bottom, .book-front-mass-back, .book-front-mass-top, .book-front-mass-bottom, .book-front-mass-right, .book-back-mass-back, .book-back-mass-top, .book-back-mass-bottom, .book-back-mass-right").css("background-color",$(this).css("background-color"));
					
			});
			
			
			controls.append(palette);

			
		}
		

		function createSimpleButtons(book){
			var controls = getSimpleControlsContainer(book);
			controls.append('<button class="simple-toggle-front-back selected view-simple-toggle" ><i class="ti ti-reload"></i></button>');
			controls.find("button.view-simple-toggle").on("click",function(e){
				controls.toggleClass("back");
				e.preventDefault();
				e.stopPropagation();
				var bk=$(this).parents('.book-container').find(".book");
				bk.toggleClass("show-default").toggleClass("show-back-34");
			});
		}



		function createButtons(book){
		
			var controls = getControlsContainer(book);
			
			
			controls.append(
				'<div class="book-nav">'+
				'	<div class="book-nav-buttons">'+
						'<button class="show-top view-toggle"><i class="ti ti-angle-up"></i></button><br/>'+
						'<button class="show-left view-toggle"><i class="ti ti-angle-left"></i></button>'+
						//'<button class="show-front selected" ><span class="icon-arrows-slide-right1"></span></button>'+
						'<button class="toggle-front-back selected view-toggle" ><i class="ti ti-reload"></i></button>'+
						//'<button class="show-back" ><span class="icon-arrows-slide-left2"></span></button>'+
						'<button class="show-right view-toggle"><i class="ti ti-angle-right"></i></button><br/>'+
						'<button class="show-bottom view-toggle"><i class="ti ti-angle-down"></i></button>'+
					'</div>'+
				'</div>'
				/*'<div class="book-extra">'+
					'<button class="show-51 view-toggle"><span class="icon-basic-eye"></span> 1</button>'+
					'<button class="show-136 view-toggle"><span class="icon-basic-eye"></span> 2</button>'+
					'<button class="anim-toggle" data-anim="spin3d"><span class="icon-arrows-rotate"></span> 1</button>'+
					'<button class="anim-toggle" data-anim="showfaces"><span class="icon-arrows-rotate"></span> 2</button>'+
				'</div>'+*/
			
			);
			
				
			controls.find("button.view-toggle").on("click",function(e){
				e.preventDefault();
				e.stopPropagation();
				
				var bk=$(this).parents(".book-wrap").find(".book");
				//al(bk);
				
				$(this).parents(".book-wrap").find(".book-nav").attr("class","book-nav");
				
				if($(this).is(".toggle-front-back")){
					if(bk.is(".show-front")){	
						resetClasses(bk);
						bk.addClass("show-back");
					}else{
						resetClasses(bk);
						bk.addClass("show-front");
					}
					
				}else{
					resetClasses(bk);
					bk.addClass($(this).attr("class"));
					$(this).parents(".book-wrap").find(".book-nav").addClass($(this).attr("class"));
				}
				$(this).parents(".book-wrap").find("button.view-toggle").removeClass("selected");
				$(this).parents(".book-wrap").find("button.anim-toggle").removeClass("selected");
				$(this).addClass("selected");
				
				

			});
			
			controls.find(".anim-toggle").on("click",function(e){
				e.preventDefault();
				e.stopPropagation();
				resetClasses(book);
				$(this).parents(".book-wrap").find(".book-nav").attr("class","book-nav");
				$(this).parents(".book-wrap").find("button.view-toggle").removeClass("selected");
				$(this).parents(".book-wrap").find("button.anim-toggle").removeClass("selected");
				$(this).addClass("selected");
				$(this).parents(".book-wrap").find(".book").toggleClass("anim-"+ $(this).data("anim"));
				
			});

		
			
		}
		
		
				

		function makeCover(img){
			//al(settings);
			var colorThief = new ColorThief();
			var dominantColor = colorThief.getColor(img[0]);
			var paletteArray = colorThief.getPalette(img[0], 3);
			
			var size=Math.ceil(settings.pages*2/24);
			var imgsrc=img.attr("src");
			var thickness=settings.coverthickness[settings.covertype];
			
			img.wrap($("<div class='book-wrap camera-top-center'/>"));
			img.wrap($("<div class='book-cover'/>"));
			img.wrap($("<div class='book show-default'/>"));
			
			
			
			var book = img.parent();
			book.css({
				"width":settings.bookw+"px",
				"height": settings.bookh+"px",
					
			});
			
			if(settings.showController || settings.showPalette){
				book.on("click",function(e){
					e.preventDefault();
					e.stopPropagation();
					//al(e.pageX+"-"+e.pageY);
					//al($(this).parents(".book-wrap").offset());
					var xx= e.pageX - $(this).parents(".book-wrap").offset().left;
					var yy= e.pageY - $(this).parents(".book-wrap").offset().top;
					$(this).parents(".book-wrap").find(".book-controls").slideToggle(200).css({left:xx+"px", top:yy+"px", });
				});
			}
			

			//img.hide();
			
			
			/*left mass cover*/
			var masscolor="rgb("+paletteArray[0][0]+","+paletteArray[0][1]+","+paletteArray[0][2]+")";
			var bmasslefttop=$("<div class='book-left-mass-top'/>").css({"background-color": masscolor});
			var bmassleftright=$("<div class='book-left-mass-right'/>").css({"background-color": masscolor});
			var bmassleftbottom=$("<div class='book-left-mass-bottom'/>").css({"background-color": masscolor});
				
			var h=((2*thickness) + size-2);	
			bmasslefttop.css(
				{
					"width":thickness+"px",
					"height": h+"px",
					"z-index":"30",
					"background-image": "linear-gradient( 0deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "rotateX(90deg) translateZ("+((h/2))+"px) translateX(-1px)",
					//translateZ("+(Math.floor(size/2))+"px) rotateX(90deg) translateZ("+Math.floor(thickness/2)+"px) translateY("+Math.floor(thickness/2)+"px)
				}
			);
			bmassleftbottom.css(
				{
					"width":thickness+"px",
					"height": h+"px",
					"z-index":"30",
					"background-image": "linear-gradient( 0deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "rotateX(-90deg) translateZ("+(settings.bookh -((h/2)))+"px) translateX(-1px)",
					
					
				}
			);
			bmassleftright.css(
				{
					"width":h+"px",
					"height": settings.bookh+"px",
					"z-index":"30",
					"transform" : "rotateY(90deg) translateZ("+(-(h/2) + thickness-1)+"px)",
					
				}
			);
			

			
			book.append(bmasslefttop,bmassleftright,bmassleftbottom);
			
			
			
			/*front mass cover*/
			//var masscolor="rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")";
			var bmassback=$("<div class='book-front-mass-back'/>").css({"background-color": masscolor});
			var bmasstop=$("<div class='book-front-mass-top'/>").css({"background-color": masscolor});
			var bmassbottom=$("<div class='book-front-mass-bottom'/>").css({"background-color": masscolor});
			var bmassright=$("<div class='book-front-mass-right'/>").css({"background-color": masscolor});
				
			bmasstop.css(
				{
					"width":settings.bookw+"px",
					"height": thickness+"px",
					"background-image": "linear-gradient( 90deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "translateZ("+(Math.floor(size/2))+"px) rotateX(90deg) translateZ("+Math.floor(thickness/2)+"px) translateY("+Math.floor(thickness/2)+"px)",
					
				}
			);
			bmassbottom.css(
				{
					"width":settings.bookw+"px",
					"height": thickness+"px",
					"background-image": "linear-gradient( 90deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "translateZ("+(Math.floor(size/2))+"px) rotateX(90deg) translateZ("+Math.floor(thickness/2)+"px) translateY("+Math.floor(thickness/2)+"px) rotateX(180deg) translateZ( "+settings.bookh+"px) ",
					
				}
			);
			bmassright.css(
				{
					"width":thickness+"px",
					"height": settings.bookh+"px",
					"background-image": "linear-gradient( 0deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.1) 100%)",
					"transform" : "rotateY(90deg) translateX("+( (-Math.floor(size/2)) - Math.floor(thickness/2)) +"px) translateZ("+(settings.bookw-Math.floor(thickness/2))+"px)",
					
				}
			);
			bmassback.css(
				{
					"width":settings.bookw+"px",
					"height": settings.bookh+"px",
					"transform" : "translateZ("+(Math.floor(size/2))+"px) rotateY(180deg) ",
					
				}
			);
			
			book.append(bmassback,bmasstop,bmassbottom,bmassright);
			
			
			
			
			/*back mass cover*/
			//var masscolor="rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")";
			
			var bmassback2=$("<div class='book-back-mass-back'/>").css({"background-color": masscolor});
			var bmasstop2=$("<div class='book-back-mass-top'/>").css({"background-color": masscolor});
			var bmassbottom2=$("<div class='book-back-mass-bottom'/>").css({"background-color": masscolor});
			var bmassright2=$("<div class='book-back-mass-right'/>").css({"background-color": masscolor});
				
			bmasstop2.css(
				{
					"width":settings.bookw+"px",
					"height": thickness+"px",
					"background-image": "linear-gradient( 90deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "translateZ("+(-Math.floor(size/2))+"px) rotateX(90deg) translateZ("+Math.floor(thickness/2)+"px) translateY("+(-Math.floor(thickness/2))+"px)",
					
				}
			);
			bmassbottom2.css(
				{
					"width":settings.bookw+"px",
					"height": thickness+"px",
					"background-image": "linear-gradient( 90deg, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.3) 100%)",
					"transform" : "translateZ("+(-Math.floor(size/2))+"px) rotateX(90deg) translateZ("+Math.floor(thickness/2)+"px) translateY("+(-Math.floor(thickness/2))+"px) rotateX(180deg) translateZ( "+settings.bookh+"px) ",
					
				}
			);
			bmassright2.css(
				{
					"width":thickness+"px",
					"height": settings.bookh+"px",
					"background-image": "linear-gradient( 0deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.1) 100%)",
					"transform" : "rotateY(90deg) translateX("+( (Math.floor(size/2)) + Math.floor(thickness/2)) +"px) translateZ("+(settings.bookw-Math.floor(thickness/2))+"px)",
					
				}
			);
			bmassback2.css(
				{
					"width":settings.bookw+"px",
					"height": settings.bookh+"px",
					"transform" : "translateZ("+(-Math.floor(size/2))+"px)  ",
					
				}
			);
			
			book.append(bmassback2,bmasstop2,bmassbottom2,bmassright2);
			
			
			
			
			
			/*front side*/
			var bfront=$("<div class='book-front'/>");
			book.append(bfront);
			
			var bgimg=bfront.css("background-image");
			//bgimg+=", url("+imgsrc+")";
			
			
			bfront.css(
				{
					"width":settings.bookw+"px",
					"height": settings.bookh+"px",
					/*"background-color": "rgb("+dominantColor[0]+","+dominantColor[1]+","+dominantColor[2]+")",*/
					"background-image": bgimg,
					"transform": "translateZ("+(thickness + Math.floor(size/2)-1)+"px)",
					
				}
			);
			/*bfront.hide();*/
			//muevo imagen delante de todo
			img.css(
				{
					"width":settings.bookw+"px",
					"height": settings.bookh+"px",
					//"background-color": "rgb("+dominantColor[0]+","+dominantColor[1]+","+dominantColor[2]+")",
					//"background-image": bgimg,
					"transform": "translateZ("+(thickness + Math.floor(size/2)-1)+"px)",
					
				}
			);
			
			
			/*left side*/
			
			var bleft=$("<div class='book-left'/>");
			var lsize=(size+(2*thickness));
			
			bleft.css(
				{
					"color":"rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")",
					"background-color":"rgb("+paletteArray[0][0]+","+paletteArray[0][1]+","+paletteArray[0][2]+")",
					"background-image": "linear-gradient( 0deg, rgba(0,0,0,0.2) 0%, rgba(255,255,255,0.1) 100%)",
					"height": lsize+"px",
					"width":settings.bookh+"px",
					"transform": "rotateZ(90deg) rotateX(-90deg) translateZ("+settings.bookh/2+"px) translateX("+( settings.bookh/2 -Math.floor(lsize/2))+"px)"
				}
			);
			
			bleft.html("<h2>"+settings.title+"</h2>"+(settings.author?"<h3>"+settings.author+"</h3>":""));
			bleft.find("h2").css(
				{
					"color":"rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")"
				}
			);
			bleft.find("h3").css(
				{
					"color":"rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")"
				}
			);

			book.append(bleft);
			
			
			/*top side*/
			var btop=$("<div class='book-top'/>");
			var bh= (settings.bookw - thickness - settings.inset);
			btop.css(
				{
					"height": bh+"px",
					"width": size+"px",
					"transform": "rotateZ(90deg) rotateY(-90deg) translateZ("+(( Math.floor(settings.bookw/2) - settings.inset ) -Math.floor(thickness/2))+"px) translateY("+(-Math.floor(settings.bookw/2) +Math.floor(settings.inset/2)+ Math.floor(size/2) - Math.floor(thickness/2)) +"px) "
				}
			);
			book.append(btop);
			
			/*bottom side*/
			var bbottom=$("<div class='book-bottom'/>");
			var bh= (settings.bookw - thickness - settings.inset);
			bbottom.css(
				{
					"height": bh+"px",
					"width": size+"px",
					"transform": "rotateZ(90deg) rotateY(90deg)  translateZ("+( settings.bookh -(Math.floor(settings.bookw/2)) + Math.floor(thickness/2))+"px) translateY("+(-(settings.bookw/2) +Math.floor(settings.inset/2)+ Math.floor(size/2) - Math.floor(thickness/2)) +"px)"
					//"transform": "rotateZ(90deg) rotateY(90deg) translateZ(220px) translateY("+(-100 + Math.floor(size/2) +2)+"px)"
				}
			);
			book.append(bbottom);
			
			
			
			/*right side*/
			var bright=$("<div class='book-right'/>");
			var bh=settings.bookh -(2*settings.inset);
			bright.css(
				{
					"height": bh+"px",
					"width": size+"px",
					"transform": "rotateY(90deg) translateZ("+( settings.bookw - Math.floor(size/2) -settings.inset)+"px) translateY("+(settings.inset-3)+"px)"

				}
			);
			book.append(bright);

			/*back side*/
			var bback=$("<div class='book-back'/>");
			bback.css(
				{	
					"width":settings.bookw+"px",
					"height": settings.bookh+"px",
					"color":"rgb("+paletteArray[1][0]+","+paletteArray[1][1]+","+paletteArray[1][2]+")",
					"background-color":"rgb("+paletteArray[0][0]+","+paletteArray[0][1]+","+paletteArray[0][2]+")",
					"transform": "rotateY(180deg)  translateZ("+(thickness+Math.floor(size/2)-1)+"px)",
				}
			);
			bback.html("<h2>"+settings.title+"</h2>"+(settings.synopsys?("<div class='synopsis'>"+settings.synopsys+"</div>"):"")+ (settings.author?"<div class='author'>"+settings.author+"</div>":""));
			
			book.append(bback);
			
			/*shadow*/
			var bshadow=$("<div class='book-shadow'/>");
			bshadow.css({
				"height": size+"px",
					
			});
			book.append(bshadow);
			
			
			
			/*create buttons*/
			if(settings.showController){
				createButtons(book);
			}
			if(settings.showSimpleController){
				createSimpleButtons(book);
			}
			if(settings.showPalette){
				createPalette(book);
			}
			
			
		}
		
		
		return this.each(function(){
			var book = $(this);
			settings = $.extend( true, {}, bookCaseDefaults );
			if(book.data()) settings = $.extend(true, {}, settings, book.data()); 
		
			//al(settings);
			makeCover(book);

		});
	};
}( jQuery ));