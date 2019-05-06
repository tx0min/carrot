(function ( $ ) {

	function generateUUID(){
		var d = new Date().getTime();
		var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = (d + Math.random()*16)%16 | 0;
			d = Math.floor(d/16);
			return (c=='x' ? r : (r&0x3|0x8)).toString(16);
		});
		return uuid;
	};

	function a(msg){
		console.log(msg);
	}
	
	function correctWidths(){
		if($("#tribe-bar-form").length>0){
			var o=$("#tribe-bar-form");
			o.css({
				"width" : "auto",
				"margin-left" : "0px",
				"margin-right" : "0px",
				"padding-left" : "0px",
				"padding-right" : "0px"
			});
			setTimeout(function(){
				var l=o.offset().left;
				o.css({
					"width" : "auto",
					"margin-left" : -l+"px",
					"margin-right" : -l+"px",
					"padding-left" : l+"px",
					"padding-right" : l+"px"
				});
			
			},10);
			
			
				
		}
	}
	
	function initWoocommerceFilters(){
		if($(".woocommerce-ordering").length>0){
			$(".woocommerce-ordering > select").select2({
				  minimumResultsForSearch: Infinity
			});
				
		}
		if($(".variations select").length>0){
			$(".variations select").select2({
				  minimumResultsForSearch: Infinity
			});
		}
	}
	
	$(document).ready(function(){
		//initTwitterSliders();
		//initInstagramSliders();
		
		$(".buy-buttons-opener").on("click",function(e){
			e.preventDefault();
			$(this).parent().toggleClass("opened");
		});
		
		correctWidths();
		initWoocommerceFilters();
	});
	
	$(window).on("load",function(){
		//$('.woocommerce-product-gallery img').bookCase();
		$(".bk-cover img").bookCase();
		//initInstagramSliders();
		//initTwitterSliders();
		
		//corrijo width formulario agenda
		
		
			
	});
	
	$(window).resize(function() {
		correctWidths();
		
	});

}( jQuery ));