(function($){

	
	
	function al(msg){
		console.log(msg);
		//alert(msg);
	}

	
	
	function initRandomSections(){
		$('.randomize-icons').each(function(){
			al($(this).height());
			al($(this).width());

		});
	}
	
	$(document).ready(function($){	
        
        initRandomSections();
	});



		
		
		
		
		
		

	
})(jQuery);


