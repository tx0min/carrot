(function($){



	function initStretchedPanels(){
		if($(".siteorigin-panels-stretch").length>0){
			$(".siteorigin-panels-stretch").each(function(i){
				var flexstyle=$(this).css("align-items");
				if("stretch"==flexstyle){

					$(this).find(".panel-grid-cell").each(function(j){
						var h=$(this).height();
						al(h);
						//$(this).children().css('height',h+"px");
					});
					
					
				}

			});
		}

	}
	$(window).load(function($){	
		initStretchedPanels();
	});

	$(window).resize(function() {
		initStretchedPanels();	
	});

	
})(jQuery);

