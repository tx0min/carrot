(function( $ ) {
	
	var MIN_LENGTH=3;
	
	
	function initSearchbox(){
		
		function openSearchbox(box){
			box.addClass('opened');
			setTimeout(function(){
				$('body').addClass('search-opened');
			},10);
			
			box.find("form").clone().appendTo($("body")); //lo copio al body
			
			$('.searchform-popup input').focus().select();
			$('.searchform-popup').on("click",function(e){
				var target=$(e.target);
				al(e.target);
				al(e.currentTarget);
				if((target.parents('.search-closer').length>0) || target.is(".searchform-popup-inner") || target.is(".results-container") || e.target == e.currentTarget){
					e.preventDefault();
					closeSearchbox();
				}
			});
			
			if($(".menu-opener").length>0){
				$(".menu-opener").addClass("hidden");
			}
		}
		
		function closeSearchbox(){
			$('body').removeClass('search-opened');
			$('.search-box').removeClass('opened');
			$('body > .searchform-popup').remove();
			
			if($(".menu-opener").length>0){
				$(".menu-opener").removeClass("hidden");
			}
		}
		
		//al(CarrotAutosearch);
		
		if($('.search-box').size()>0){
			if(CarrotAutosearch.autocomplete=="1"){
				
				$('body').on('keyup','form.searchform-popup input[type=text]',function(e){
					var f = $(this).closest('form');
					var $results = f.find(".search-results");
					if($results.length==0){
						$resultscontainer=$("<div class='results-container'/>");
						$results=$("<ul class='search-results'/>");
						$results.appendTo($resultscontainer);
						$resultscontainer.appendTo(f);
					}
								
					var filter=$(this).val();
					
					var url = CarrotAutosearch.url + "?action=carrot_autosearch&term="+filter;
					//al(url);
					if(filter.length >=MIN_LENGTH){
							f.addClass("loading");
						$.getJSON(url,function(data){
							//al(data);
							f.removeClass("loading");
							$results.empty();
							if(data && data.length>0){
								for(var i in data){
									//al(data[i]);
									var post=data[i];
									
									var $li=$("<li/>").appendTo($results);
									$li.html("<a href='"+ post.link +"'><span class='search-thumb'>"+post.thumbnail+"</span><span class='search-title'>"+post.title+"</span></a>");
								}
							}else{
								$results.append("<span class='no-results'>"+CarrotAutosearch.texts.no_results+"</span>");
							}
							
						});
					}
				});
			}
			
			
			$('.search-box').each(function(i){
				$(this).find('.search-opener').on('click',function(e){
					e.preventDefault();
					e.stopPropagation();
					if($(this).parent().is(".opened")){
						closeSearchbox();
						
					}else{
						openSearchbox($(this).parent());
					}
					
				});
				
				/*$(this).find('input').on('blur',function(e){
					closeSearchbox();
					
				});*/
			
			});
			$(document).on("keyup", function(e){
				if (e.keyCode == 27) { // escape key maps to keycode `27`
					closeSearchbox();
				}
			});
		}
	}
	
		
		
		
		
	$(document).ready(function($){	
		initSearchbox();
	});

		
})( jQuery );