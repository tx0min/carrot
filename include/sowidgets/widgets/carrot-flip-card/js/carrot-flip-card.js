(function($){
		
	function evenSidesHeights(card){
		var front=card.children('.front-side');
		var back=card.children('.back-side');
		
		/*console.log(front.height() + "-" + front.outerHeight() + "-" +front.outerHeight(true) );
		console.log(back.height() + "-" + back.outerHeight() + "-" +back.outerHeight(true) );*/
		
		var h;
		front.css('height','auto');
		back.css('height','auto');
		card.height( Math.max(front.outerHeight(true), back.outerHeight(true)));
		front.css('height','100%');
		back.css('height','100%');
		
		/*var frontmargins=  parseInt(front.css('padding-top'), 10) + parseInt(front.css('padding-bottom'), 10) ;
		var backmargins= parseInt(back.css('padding-top'), 10) + parseInt(back.css('padding-bottom'), 10) ;*/
		
		//console.log(front.children('.side-content').outerHeight(true));
		//console.log(backmargins + " + " +back.children('.side-content').innerHeight()) ;
		//front.innerHeight(front.children('.side-content').innerHeight() + frontmargins);
		//back.innerHeight(back.children('.side-content').innerHeight() + backmargins);
		
		
		/*if(back.outerHeight(true) < front.outerHeight(true)){
			h=front.outerHeight(true) - backmargins;
			back.height(h);
			
			
		}else{ 
			h=back.outerHeight(true) - frontmargins;
			front.height(h);
			
			
		}*/
		
		
				
	}	
	function initCards(){
        if($(".flip-card").size()>0){
			$(".flip-card").each(function(i){
				//even sides heights
				var card=$(this);
				evenSidesHeights(card);

			});
		}
    }
		
	$(window).load(function($){	
		initCards();
	});
	$(window).resize(function($){	
		initCards();
	});
	
	

	
})(jQuery);