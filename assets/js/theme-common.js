function al(msg){
	console.log(msg);
	//alert(msg);
}
var windowWidth,
	windowHeight;

		

var didScroll; 
var lastScrollTop = 0;
var st = 0;  //Scroll TOP
var delta = 1;


function fixBoxedArticleHeight(articles){
	articles.each(function(i){
		var article = jQuery(this);
		if(article.is('.thumb-left') || article.is('.thumb-right')){
			var h=article.find('.article-featured').parent().siblings().height();
			//	al("fixBoxedArticleHeight: "+h);
			if(windowWidth < 768 && h > 180 && article.is('.thumb-responsive') )
				h=180;
			
			article.find('.article-featured').height(h);
		}
	});
}


(function($){

	var $allVideos;

	
	
	var init=false;
	
	
	

	function isIpad(){
		return navigator.userAgent.match(/iPad/i) != null;

	}	
	
	
	function init_smooth_scroll(){
		 //al($('#body').offset().top) ;
		
		  $('a[href^=#]').on('click',function(e) {
				var href=$(this).attr('href');
				e.preventDefault();
				//al(href);
				var offset=0;//-1;
				//if($('#header.sticky').size()>0) offset+=$('#header.sticky').height();
				//if($('#sticky-header').size()>0) offset+=$('#sticky-header').height();
				if($('#wpadminbar').size()>0) offset+=$('#wpadminbar').height();
				
				if($(href).size()>0){
					var targetOffset=$(href).offset().top - offset;
					//al(targetOffset);
					$('html,body').animate({scrollTop: targetOffset}, {duration:600});
					//$.scrollTo(href,{duration:600, easing: 'easeOutExpo'});
				}
				//return false;
		  	
		  });
			 


	}

	
	function initAffixs(){
		
		var tpadding=2; //em
		var bpadding=30; //px
		
		$('.carrotaffix').each(function(i){
			var obj=$(this);
			obj.width($(this).parent().width());
			obj.data("top",$('#header').outerHeight(true) + tpadding);
			
			var btrigger=obj.parent();
			if(obj.data("parenttrigger")) btrigger=obj.closest(obj.data("parenttrigger"));
			
			
			obj.affix({
			  offset: {
				top: function () {
				 // al($('#header').outerHeight(true));
				  return (this.top = $('#header').outerHeight(true));
				},
				bottom: function () {
				 
				  var t = btrigger.offset().top + btrigger.outerHeight(true);
				  var b= $(document).height() - t;
				  
 				  return  this.bottom = b;
				}
			  }
			});
			
			obj.on( 'affix.bs.affix', function () {
				//al("fixing");
				$(this).width($(this).parent().width());
				$(this).css('top',tpadding+"em");
				$(this).css('margin-top',$(this).data('top'));
			});
			obj.on( 'affixed-top.bs.affix', function () {
				//al("top");
				$(this).width('auto');
				$(this).css('top',0);
				$(this).css('margin-top',0);
			});
			
			obj.on( 'affixed-bottom.bs.affix', function () {
				//al("bottom");
				$(this).width('auto');
			});
			
			
			
		});
		
		
		
		
		
	}
	
	

	
	
	function initSections(){
		
		$('.full-height').each(function(i){
			//al($(this));
			$(this).addClass('initialized');
			if(windowWidth>767)	$(this).height(windowHeight);
		});
		 
	}

	function isOnTop(){
		//al($(window).scrollTop());
		//al($('#header').offset().top);
		return $(window).scrollTop() <= 0;//$('#header').offset().top;
	}
	
	
		
	function checkInViewport(){
		//al("checkInViewport");
		$('.anim').each(function(i){
			
			if(!$('body').is('.site-loading')){
				if($(this).is(':in-viewport')){
					if(!$(this).is('.in')) $(this).addClass('in').removeClass('out');
				}else{
					//if($(this).is('.in')) $(this).removeClass('in').addClass('out');
				}
			}else{
				//$(this).addClass("out");
			}
		});
	}
	
	function headerPassed(){
		var navbarHeight=$('#header').outerHeight();

		return st > navbarHeight;//$(window).scrollTop() <=  $('#header').outerHeight();
	}

	function isScrollDown(){
		return st > lastScrollTop;
	}
	
	
	function stickFooter() {
       var $footer=$("#footer");
		footerHeight = $footer.height();
		footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";

	   if ( ($(document.body).height()+footerHeight) < $(window).height()) {
		   $footer.addClass("sticky");
	   } else {
		   $footer.removeClass("sticky");
	   }

	   
               
    }
	
	
	function toggleStickyFooter(){
		if(headerPassed()){
			$('#footer_sticky').addClass('shown');
			$('#header').addClass('notontop').removeClass('ontop');
			$('body').addClass('notontop').removeClass('ontop');
		}else{
			$('#footer_sticky').removeClass('shown');
			$('#header').removeClass('notontop').addClass('ontop');
			$('body').removeClass('notontop').addClass('ontop');
		}
		
	}

	function toggleStickyHeader(){
		
		if ( isScrollDown() && headerPassed()){
		   // Scroll Down
		   
		   $('body').removeClass('scrolling-up').addClass('scrolling-down');
		 } else {
		   // Scroll Up
		   if(st + $(window).height() < $(document).height()) { 
		    $('body').removeClass('scrolling-down').addClass('scrolling-up');
		   }
		 }

	}

	function hex2rgb(hexStr){
		// note: hexStr should be #rrggbb
		var hex = parseInt(hexStr.substring(1), 16);
		var r = (hex & 0xff0000) >> 16;
		var g = (hex & 0x00ff00) >> 8;
		var b = hex & 0x0000ff;
		return [r, g, b];
	}

	
   function initDrawer(){
   		if($('.menu-opener').size()>0){
   			$('.menu-opener').on('click',function(){
   				$(this).parents('.drawer-menu').toggleClass('opened');
   				$('body').toggleClass('drawer-opened');
   			});
   			$('.drawer-overlay').on("click",function(e){
   				e.preventDefault();
   				e.stopPropagation();
   				$(this).parents('.drawer-menu').removeClass('opened');
   				$('body').removeClass('drawer-opened');
   			});
   		}
   }
   
   function fixSidebarHeight(){
		if($('.sidebar').size()>0){
			var s=$('.sidebar');
			
			if(s.is('.sidebar-left') || s.is('.sidebar-right')){
				var h=s.parent().outerHeight(true);
				var h2=s.parent().siblings().outerHeight(true);
				//al(h +"-"+h2);
				if(h<h2){
					//al(h2);
					var pad=s.outerHeight(true)-s.height();
					//al(pad);
					s.height((h2-pad)+"px");
				}
			}
		}
   }
    
	
   
   function fixBoxedArticlesHeight(){
		$('article').each(function(i){
			fixBoxedArticleHeight($(this));
		}); 
   }
   
   
   
   
   
   function refreshGrids(){
	 if($(".grid").size()>0){
	 
		$(".grid").each(function(i){
				// layout Isotope after each image loads
				var $grid =$(this);
				$grid.imagesLoaded().progress( function() {
					stickFooter();
					$grid.isotope('layout');
					//al("refreshGrids");
				  //fixSidebarHeight();
				});
		});
	 }
   }
   
   function initGridBlog(){
        if($(".grid").size()>0){
			$(".grid").each(function(i){
				//$(this).children("article").addClass("tile");
				//al("INIT GRID");
				
				var $grid =$(this).isotope({
					itemSelector: '.tile',
					layoutMode: 'packery',
					packery: {
						columnWidth: '.grid-sizer',
						gutter: '.gutter-sizer'

					}
				});
				
				
				
			});
            
			refreshGrids();
			
        }

    }
   
   
   



	function initSVGLogo(){
		if($('.logo-image img').size()==0) return;
		
		$('.logo-image img').each(function(){
			var $img = $(this);
			var $src=$img.attr('src');
			if($src.match(/svg$/)){

				$img.addClass('loading');
				var imgID = $img.attr('id');
				var imgClass = $img.attr('class');
				var imgURL = $img.attr('src');

				$.get(imgURL, function(data) {
					// Get the SVG tag, ignore the rest
					var $svg = $(data).find('svg');

					// Add replaced image's ID to the new SVG
					if(typeof imgID !== 'undefined') {
						$svg = $svg.attr('id', imgID);
					}
					// Add replaced image's classes to the new SVG
					if(typeof imgClass !== 'undefined') {
						$svg = $svg.attr('class', imgClass+' replaced-svg');
					}

					// Remove any invalid XML tags as per http://validator.w3.org
					$svg = $svg.removeAttr('xmlns:a');

					// Replace image with new SVG
					$img.replaceWith($svg);
					$svg.removeClass('loading');
				}, 'xml');
			}
		});
		
	}
	
	
	
	
	function initArticles(){
		
		$(".single article .entry-content").each(function(i){
			
			var content=$(this);
			
			//arrange blockquotes
			content.find('blockquote').each(function(i){
				var p=$(this).find('p');
				if(p.size()>0){
					p.wrapInner('<span class="underliner" />');
				
					if(p.css('text-align') =='left' || p.css('text-align') == 'justify'){
						$(this).addClass('aleft');
					}else if(p.css('text-align') =='right'){
						$(this).addClass('aright');
					}else{
						$(this).addClass('acenter');
					};
				}
			});
			
			
			
			//columnize
			if(content.closest('article').is('.page') || content.closest('article').is('.post-article')){
				
				if(content.closest('article').is('.columnize')){
					var cols=content.data('cols');
					if(cols>1){
						content.columnize({ columns: cols });
					}
				}
				
				//console.log(content);
				if(content.closest('article').is('.hyphenate')){
					var lang=content.data('lang');
					//al('hyphenate');
					//al(lang);
					//console.log("HYPHENATING CONTENT");
					content.hyphenate(lang);
		
				}
			}
			
		});
	}
	
	function prepareCommentsForm(){

		$('#commentform').each(function(i){
		
			$(this).children('p').each(function(){
				if($(this).find('input[type="text"],textarea').size()>0){
					var $label=$(this).children('label');
					var txt=$label.text();
			
					$(this).find('input[type="text"],textarea').attr('placeholder',txt);
				}				
			
			});
			

		});
	}
	
	
	function resizeVideos(){
			
			// Resize all videos according to their own aspect ratio
			if($allVideos){
				$allVideos.each(function() {
					var newWidth = $(this).parent().width();
					//al(newWidth);
					var $el = $(this);
					$el.width("100%")
						.height(newWidth * $el.data('aspectRatio'));

				});
			}
	}
	
	
	function prepareVideos(){

		$allVideos = $(".single article iframe, .sow-video-wrapper iframe");
		$allVideos.each(function() {
			$ratio=$(this).attr('height') / $(this).attr('width');
			$(this)
				.data('aspectRatio', $ratio)
				.removeAttr('height')
				.removeAttr('width');

		});
		
	}
	
	
	function initTooltips(){
		 $('[data-toggle="tooltip"]').tooltip();
	}
	
	
	function initSubmenus(){
		if($('.menu').size()>0){
			$('.menu > li.menu-item-has-children > a').on('click',function(e){
				e.preventDefault();
				e.stopPropagation();
				$(this).parent().toggleClass('opened');
			});
		}
		
	}
	function initStickyHeader(){
		if($('#sticky-header').size()>0){	
			$('#sticky-header').on('click',function(e){
				//$('body').animate({scrollTop: 0}, {duration:600});
			});
		}
	}
	
	
	
	var slidersDefaults = {
		autoHeight:true,
		items: 1,
		slideBy: 1,
		nav: true,
		dots: true,
		loop: true,
		autoplay: true,
		autoplayTimeout: 5000,
		mouseDrag: true,
		touchDrag: true,
		autoplayHoverPause: true,
		navText: [carrot_ajax.icons.left, carrot_ajax.icons.right],
		animateOut: false,
		animateIn: false,
		video:true,
		//videoWidth: 500, // Default false; Type: Boolean/Number
		//videoHeight: 315, // Default false; Type: Boolean/Number

		onInitialized : function(event) {
			fixBoxedArticleHeight($(event.target).find("article"));
			stickFooter();
			$(event.target).removeClass("loading").addClass("loaded");
			$(event.target).closest(".gallery-slider").removeClass('loading');

		},
		responsive : {
			0 : {
				autoHeight:true,
				items: 1
			},
			// breakpoint from 768 up
			768 : {
				items: 3
			}
		}
		
	};
	
		
/*	var simpleSlidersDefaults = {
		items: 1,
		slideBy: 1,
		nav: false,
		dots: true,
		loop: true,
		autoplay: true,
		autoplayTimeout: 8000,
		mouseDrag: true,
		touchDrag: true,
		autoplayHoverPause: true
		
	};
*/	
	
	function initSlider(slider){
		//al("initSlider");
		var settings = slidersDefaults;
		if(slider.data()) settings = $.extend(true, {}, settings, slider.data()); 
		//al(settings);
		
		settings.responsive[0].items=settings.itemsResponsive;
		settings.responsive[768].items=settings.items;
		
		var fx=settings.fx;
		//al(fx);
		switch(fx){
			case 'fade': 
				settings.animateOut = 'fadeOut';
				settings.animateIn = 'fadeIn';
				break;
			case 'flip-h': 
				settings.animateOut = 'zoomOut';
				settings.animateIn = 'flipInY';
				break;
			case 'flip-v': 
				settings.animateOut = 'zoomOut';
				settings.animateIn = 'flipInX';
				break;
			case 'slide-h': 
				settings.animateOut = 'slideOutRight';
				settings.animateIn = 'slideInLeft';
				break;
			case 'slide-v': 
				settings.animateOut = 'slideOutDown';
				settings.animateIn = 'slideInDown';
				break;
			case 'zoom': 
				settings.animateOut = 'zoomOut';
				settings.animateIn = 'zoomIn';
				break;
			default:break;
		}
		//al(settings);
		
		/*if(slider.is('.carousel')){
			initSlidesWidth(slider);
		}*/
		//al(slider.data());

		// al(settings);
		
		//set height if needed
		if(settings.fixedHeight){
			slider.css('height',settings.fixedHeight);
		}

		

		//add pause button if needed

		
		slider.owlCarousel(settings);
		//al(slider);

		if(settings.autoplay){
			slider.addClass('autoplay');
		}
		if(settings.showPause){
			//al('show pause');
			//al(carrot_ajax.icons);
			var btnpause=$('<button type="button" class="owl-pausebutton"/>').html(carrot_ajax.icons.pause);
			//var btnplay=$('<div class="owl-playbutton"/>').html(carrot_ajax.icons.play);

			if(slider.find('.owl-nav').size()>0 ) {
				slider.find('.owl-prev').after(btnpause);
				
			}else{
				slider.append(btnpause);

			}
			//slider.find('.owl-pausebutton').after(btnplay);

			btnpause.on('click',function(){
				if(slider.is('.autoplay'))
					slider.trigger('stop.owl.autoplay');
				else
					slider.trigger('play.owl.autoplay');
			});
			
			

			slider.on('play.owl.autoplay', function(event) {
				// al("PLAY");
				$(event.target).addClass('autoplay');
				
			});

			slider.on('stop.owl.autoplay', function(event) {
				// al("PAUSE");
				$(event.target).removeClass('autoplay');
				
			});



    
		}
		
		/*slider.on( 'cycle-update-view', function( event, opts ) {
			//console.log("INIT");
			slider.removeClass('loading').addClass('loaded');
			$('[data-toggle="tooltip"]').tooltip();

		});*/
	}


	function initSliders(){
		
		$('.articles-slider').each(function(i){
			
			var slider=$(this);
			initSlider(slider);

			
		});
		
	}
	

	
	function initTwitterSliders(){
		//a(slidersDefaults);
		$(".widget_tp_widget_recent_tweets").each(function(){
			var settings = slidersDefaults;
			settings.responsive[0].items=1;
			settings.responsive[768].items=1;
			settings.autoHeight=false;
			
			var slider=$(this).find(".tp_recent_tweets > ul");
			slider.addClass("owl-carousel owl-theme");
			slider.children().addClass("item");
			slider.owlCarousel(settings);
		});
	}
	
	function initInstagramSliders(){
		
		//a(slidersDefaults);
		$(".instagram-pics").each(function(){
			var settings = slidersDefaults;
			settings.responsive[0].items=1;
			settings.responsive[768].items=1;
			settings.nav= false;
		
			var slider=$(this);
			slider.addClass("owl-carousel owl-theme");
			slider.children().addClass("item");
			slider.children().find("a").append($("<div class='grad'/>"));
			slider.owlCarousel(settings);
		});
	}
	
	
	
	
	


	function isImageLink(obj){
		if(!obj.is("a")) return;
		if(obj.is("a[href$='.jpg']") || obj.is("a[href$='.JPG']") || obj.is("a[href$='.jpeg']") || obj.is("a[href$='.JPEG']") || obj.is("a[href$='.png']") || obj.is("a[href$='.PNG']") || obj.is("a[href$='.gif']") || obj.is("a[href$='.GIF']")) return true;
		return false;
	}
	
	
	

	var galleryisotopedefaults={
		itemSelector: '.tile',
		layoutMode: 'packery',
		packery: {
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer'

		}
	};

	function initGalleries(){
		$(".image-gallery").each(function(i){
			var gallery=$(this);
			initGallery(gallery);
		});
		

		initVenobox($("article:not(.page-builder-enabled) .entry-content, article:not(.page-builder-enabled) .article-featured"));

		
		
	}
	
	
	var venoboxdefaults = {
		infinigall:true,
		numeratio: true,
		numerationPosition: 'bottom'
	}


	function initVenobox(container){
		var options=venoboxdefaults;

		if(container.size()>0)
			var links=$();

			container.find('a').each(function(){
				var link=$(this);
				
				if(link.is(".venobox") || isImageLink(link)){
					
					if(!link.is(".venobox")){
						options.infinigall=false;
						options.numeratio=false;
					}

					if(link.closest(".owl-item").size()>0){
						if(!link.closest(".owl-item").is(".cloned")){
							links=links.add(link);
						}
					}else{
						links=links.add(link);
					}
				}
			});

			//al(container.find('.venobox'));
			//al(links);

			//al(links.size());
			if(links && links.size()>0){
				links.venobox(options);
			}
	}

	
	function initGallery(gallery){
	   if(gallery.size()>0){
	   
			
			//al(gallery.size());
			gallery.each(function(){
				var gal=$(this);
				//al("INIT GALLERY");
				//al(gal);
				gal.addClass('loading');
					
				
				
				if(gal.is('.gallery-grid')){
					gal.imagesLoaded( function() {
						gal.removeClass('loading');
						gal.isotope(galleryisotopedefaults);
					});
				}else if(gal.is('.gallery-slider') ){
					gal.find('.images-wrapper').addClass('owl-carousel owl-theme');
					gal.find('.images-wrapper').addClass("valign-"+gal.data("valign"));
					gal.find('.images-wrapper').data(gal.data());
					initSlider(gal.find(".images-wrapper"));

				}else{
					gal.removeClass('loading');
						
				}

				initVenobox(gal);

	


			});				
			
			
	   }
	}
	
	function initClickables(){
		$('.clickable').each(function(){
			var $a=$("<a class='wrap-link' href='"+$(this).data('href')+"'/>");
			$(this).parent().wrap($a);
		});
		
		
	}


	//init everything height related
	function initThings(){
		windowHeight = $(window).height();
		windowWidth = $(window).width();
		
		if(windowHeight>windowWidth) $('body').addClass('ratio-vertical').removeClass('ratio-horizontal');
		else $('body').removeClass('ratio-vertical').addClass('ratio-horizontal');

		stickFooter();
        
		initSections();
		resizeVideos();
		fixSidebarHeight();
		fixBoxedArticlesHeight();
		
	}
	
	
	
	function resizeManager(){
		windowHeight = $(window).height();
		windowWidth = $(window).width();
		

		toggleStickyFooter();
		toggleStickyHeader();
		checkInViewport();
		
		initThings();
		
	}
	
	
	


	function hasScrolled() {
		//al("hasScrolled");
		st = $(window).scrollTop();
		 
		if(Math.abs(lastScrollTop-st) <= delta) return;

		toggleStickyFooter();
		toggleStickyHeader();
		checkInViewport();
		 
		lastScrollTop = st;


		
	}
	
	
	
	
	$(window).resize(function() {
		resizeManager();
		
	});

	$(window).scroll(function() {
		didScroll = true;
		hasScrolled();

	});
	
	$(window).load(function() {
		
		$('body').removeClass('site-loading');
		setTimeout(function(){
			checkInViewport();
			$('#site-preloader').addClass('hidden');
			refreshGrids();
			
			
		},10);
		
        initSliders();
		initThings();
		initGalleries();	
		
		initInstagramSliders();
		initTwitterSliders();
		
		initAffixs();
		resizeManager();
	});
	
	
	
	
	$(document).ready(function($){	
		
		init_smooth_scroll();
		initDrawer();
        initGridBlog();
		initSVGLogo();
		initArticles();
		prepareCommentsForm();
		initStickyHeader();
		initTooltips();
		initSubmenus();
		prepareVideos();
        resizeManager();
		
		initClickables();
		
		

	});



		
		
		
		
		
		

	
})(jQuery);


