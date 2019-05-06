(function($){

	var windowWidth,
		windowHeight;
		
	var defaults={
		itemSelector: '.tile',
		layoutMode: 'packery',
		packery: {
			columnWidth: '.grid-sizer',
			gutter: '.gutter-sizer'

		}
	};
	
	function disableButton($b){
		$b.addClass('disabled');
		$b.attr('disabled',true);
	}
	
	
	function getTexts($grid){
		var texts={};
		//al("getTexts");
		texts=carrot_grid_ajax.texts;
		//al(texts);
		
		
		/*if($grid.data('text-load-more')) texts.load_more=$grid.data('text-load-more');
		if($grid.data('text-loading')) texts.loading=$grid.data('text-loading');
		if($grid.data('text-no-more-results')) texts.no_more_results=$grid.data('text-no-more-results');
		if($grid.data('text-no-results')) texts.no_results=$grid.data('text-no-results');
		if($grid.data('text-older')) texts.older=$grid.data('text-older');
		if($grid.data('text-newer')) texts.newer=$grid.data('text-newer');
		if($grid.data('text-choose-filter')) texts.choose_filter=$grid.data('text-choose-filter');
		*/
		return texts;
		
	}
	
	
	function loadPosts($grid){
		var texts=getTexts($grid);
		var $query=$grid.data('query');
		
		//console.log($query);
		//console.log("Loading page "+$query.paged);
		$grid.addClass('loading');
		$grid.parent().find('.posts-navigation').addClass('loading');
		
		$grid.parent().find('.posts-navigation').html('<div class="loader">'+carrot_grid_ajax.icons.loading+' '+texts.loading+'</div>');
		
		/*
		if($grid.is('.pagination-numbers')){
		}else if($grid.is('.pagination-arrows')){
			//$grid.parent().find('.posts-navigation .loader').html(texts.loading);
			//$grid.parent().find('.posts-navigation .loader').html('<i class="ti ti-reload spin"></i>');
		}else if($grid.is('.pagination-lazyload')){
			$grid.parent().find('.posts-navigation').html(texts.loading);
		}else if($grid.is('.pagination-loadmore')){
			//$grid.parent().find('.load-more-btn').addClass('beat');
			$grid.parent().find('.load-more-btn').html(texts.loading);
		}*/
	
		
		var params={
			query : $query,
			options : $grid.data('show-options'),
			template : $grid.data('post-template')
		
		}
		
		$grid.data('query',$query);
		
		
		$.post( carrot_grid_ajax.url, params, function( data ) {
			if(data){
				var totalposts= data.numposts;
				var numpages= data.numpages;
				
				////console.log(totalposts);
				//console.log(numpages);
				
				$grid.removeClass('loading');
				
				$grid.data('numpages',numpages);
				$grid.data('numposts',totalposts);
				
				
				//update preloaders and restore controls
				$grid.parent().find('.posts-navigation').removeClass('loading');
				
				var posts= data.posts;
				//console.log(posts);
				//console.log(posts.length);
				
				
				if(posts.length>0){
					if($grid.is('.pagination-arrows') || $grid.is('.pagination-numbers') || $grid.is(".filterschanged") ){
						if($grid.is('.filterschanged')) $grid.removeClass('filterschanged');
						$grid.isotope('destroy');
						$grid.find('.tile').remove();
						$grid.isotope(defaults);
					}
					for(var i=0;i<posts.length;i++){
						var post=posts[i];
						
						var tile=$('<div class="tile"/>');
						if($(post).data("grid-size")) tile.addClass("size-"+$(post).data("grid-size"));
						tile.html("<div class='the-gap'>"+post+"</div>");
						$grid.append(tile);
						fixBoxedArticleHeight(tile.children("article"));
						
						$grid.isotope( 'appended', tile );
						
						$grid.imagesLoaded().progress( function() {
							$grid.isotope('layout');
							
						});
					}
					
					
				}
				
			}else{
				$grid.data('numpages',0);
				$grid.data('numposts',0);
				
				$grid.isotope('destroy');
				$grid.find('.tile').remove();
				$grid.isotope(defaults);
			}
			
			
			redrawPagination($grid);
			
			
			
			
		},'json');
	}
	
	
	function redrawPagination($grid){
		if($grid.is('.pagination-numbers')){
			drawPaginationNumbers($grid);
		}else if($grid.is('.pagination-arrows')){
			drawPaginationArrows($grid);
		}else if($grid.is('.pagination-lazyload')){
			drawPaginationLazyload($grid);
		}else if($grid.is('.pagination-loadmore')){
			drawPaginationLoadMoreButton($grid);
		}else if($grid.is('.pagination-dots')){
			drawPaginationDots($grid);
		}
	}
	
	function drawNoPagination($grid){
		$grid.removeClass('loading');
		$grid.parent().find('.posts-navigation').removeClass('loading');
		$grid.parent().find('.posts-navigation').empty();
		return;
	}
	
	
	function drawPaginationLoadMoreButton($grid){
		//console.log("DRAW");
		var texts=getTexts($grid);
		var current=getPageNum($grid);
		var max=$grid.data('numpages');
		if(max<=1) 	return drawNoPagination($grid); 
		
		
		var first=current<=1;
		var last=current>=max;

		var $p=$grid.parent().find('.posts-navigation');
		
		var $b=$('<button/>');
		$b.addClass("load-more-btn");
		
		if(!last){
			$b.html(texts.load_more);
		}else{
			$b.html(texts.no_more_results);	
			disableButton($b);

		} 
		
		$p.html('').append($b);
		
		if(!last){
			$b.on('click',function(e){
				//console.log(pagesize);
				incPageNum($grid);
				loadPosts($grid);
				
			});
		}
		
		

	}

	function drawPaginationLazyload($grid){
		//console.log("DRAW");
		var texts=getTexts($grid);
		var current=getPageNum($grid);
		var max=$grid.data('numpages');
		
		var first=current<=1;
		var last=current>=max;

		var $p=$grid.parent().find('.posts-navigation');
		
		
		
		if(last){
			$p.html(texts.no_more_results);
			$grid.addClass('nomore');
		}else{
			$p.html('');
		$grid.removeClass('nomore');
		}
		
		

	}


	function drawPaginationArrows($grid){
		var texts=getTexts($grid);
		var current=getPageNum($grid);
		var max=$grid.data('numpages');
		
		if(max<=1) return drawNoPagination($grid); 
		
		var first=current<=1;
		var last=current>=max;
		
		var $p=$grid.parent().find('.posts-navigation');
		//al(texts);
		$p.html('<div class="col-xs-5 text-left"><a href="#" class="newer '+(first?'disabled':'')+' ">'+carrot_grid_ajax.icons.left+' '+texts.newer+'</a></div><div class="col-xs-2 text-center loader"></div><div class="col-xs-5 text-right"><a href="#" class="older '+(last?'disabled':'')+'">'+texts.older+' '+carrot_grid_ajax.icons.right+'</a></div>');
		
		
		if(!first){
			$p.find('.newer').on('click',function(e){
				e.preventDefault();
				//console.log("CLICK");
				if(!($(this).is('.disabled'))){
					decPageNum($grid);
					loadPosts($grid);
				}
			});
		
		}
		
		if(!last){
			$p.find('.older').on('click',function(e){
				e.preventDefault();
				if(!($(this).is('.disabled'))){
					incPageNum($grid);
					loadPosts($grid);
				}
			});
		}
		
		
	}
	
	
	function drawPaginationDots($grid){
		var texts=getTexts($grid);
		var current=getPageNum($grid);
		
		var max=$grid.data('numpages');
		if(max<=1) 	return drawNoPagination($grid); 
			
		
		
		var $p=$grid.parent().find('.posts-navigation');
		$p.html('<nav class="navigation dots-pagination" role="navigation"></nav>');
		
		var html='';
			
		for(var i=1;i<=max;i++){
			if(current==i) html+='<span class="page-dot"></span>';
			else html+='<a class="page-dot" href="#page-'+i+'" data-numpage="'+i+'" ></a>';
		}
		
		$p.find('.navigation').html(html);
		
		$p.find('.navigation a').on('click',function(e){
			e.preventDefault();
			if(!$(this).parent().is('.current') && !$(this).is('.disabled')){
				var num=$(this).data('numpage');
				setPageNum($grid,num);
				loadPosts($grid);
				
			}
		});
		
	}
	
	
	function drawPaginationNumbers($grid){
		var texts=getTexts($grid);
		var current=getPageNum($grid);
		
		var max=$grid.data('numpages');
		
		if(max<=1) return drawNoPagination($grid); 
		
		
		var $p=$grid.parent().find('.posts-navigation');
		$p.html('<nav class="navigation pagination" role="navigation"><div class="nav-links"></div></nav>');
		
		var range=2;
		var html='';
		//al(current)
		if(current>1){
			html+='<a class="newer page-numbers" data-numpage="'+(current-1)+'" href="#newer">'+carrot_grid_ajax.icons.left+'</a>';
		}else{
			html+='<span class="page-numbers" >'+carrot_grid_ajax.icons.left+'</span>';
		}
		
		var ini=current-range;
		if(ini<1) ini=1;
		
		var fin=current+range;
		if(fin>max) fin=max;
		
		//console.log(ini+"-"+fin);
		
		if(current-range > 1){
			html+='<a class="page-numbers" href="#page-1" data-numpage="1" >1</a>';
			if(current-range>2) html+='<span class="page-numbers">...</span>';
		}
		
		for(var i=ini;i<=fin;i++){
			if(current==i) html+='<span class="page-numbers current">'+i+'</span>';
			else html+='<a class="page-numbers" href="#page-'+i+'" data-numpage="'+i+'" >'+i+'</a>';
			

			
		}
		
		if(current+range < max){
			if(current+range < max-1) html+='<span class="page-numbers">...</span>';
			html+='<a class="page-numbers" href="#page-'+max+'" data-numpage="'+max+'" >'+max+'</a>';
			
		}
		
		
		//console.log(current +"-"+max);
		//console.log(current < max);
		if( current < max){
			html+='<a class="older page-numbers" data-numpage="'+(current+1)+'" href="#older">'+carrot_grid_ajax.icons.right+'</a>';
		}else{
			html+='<span class="page-numbers">'+carrot_grid_ajax.icons.right+'</span>';
		}
		
		
		$p.find('.nav-links').html(html);
		
		$p.find('.nav-links a').on('click',function(e){
			e.preventDefault();
			if(!$(this).is('.current') && !$(this).is('.disabled')){
				var num=$(this).data('numpage');
				setPageNum($grid,num);
				//$(this).parents('ol').find('.current').removeClass('current');
				//$(this).parent().addClass('current');
				loadPosts($grid);
				
			}
		});
		
	}
	
	function initPaginationDots($grid){
		$grid.addClass('init');
		var $p=$('<div/>');
		$p.addClass("posts-navigation");
		$grid.after($p);

		
		drawPaginationDots($grid);
	}
	
	
	function initPaginationNumbers($grid){
		
		$grid.addClass('init');
		var $p=$('<div/>');
		$p.addClass("posts-navigation");
		$grid.after($p);

		
		drawPaginationNumbers($grid);
		
		
		/*for(var i=0;i<max;i++){
			var li=$('<li/>');
			if(current==(i+1)) li.addClass("current");
			li.html('<a href="#page-'+(i+1)+'" data-numpage="'+(i+1)+'" >'+(i+1)+'</a>');
			
			$p.find('ol').append(li);
		}*/
		
		
		
	}
	function initPaginationClassic($grid){
		
		
		
		$grid.addClass('init');
		var $p=$('<div/>');
		$p.addClass("posts-navigation");
		$grid.after($p);
		
		drawPaginationArrows($grid);
		
		
	}

	function initPaginationLoadMoreButton($grid){
		

		$grid.addClass('init');
		var $p=$('<div/>');
		$p.addClass("posts-navigation");
		$grid.after($p);

		
		drawPaginationLoadMoreButton($grid);



		
		
					
	}
	
	function initPaginationLazyload($grid){
		$grid.addClass('init');
		var $p=$('<div/>');
		$p.addClass("posts-navigation");
		$grid.after($p);
		
		drawPaginationLazyload($grid);

		
	}
	
	function decPageNum($grid){
		$query=$grid.data('query');
				
		if(!$query.hasOwnProperty('paged')){
			$query.paged=1;
		}
		if($query.paged>1)
			$query.paged--;
		
		$grid.data('query',$query);
	}
	
	function incPageNum($grid){
		$query=$grid.data('query');
		var max=$grid.data('numpages');
		if(!$query.hasOwnProperty('paged')){
			$query.paged=1;
		}
		if($query.paged<max)
			$query.paged++;
		
		//console.log($query.paged);
		$grid.data('query',$query);
	}

	
	function prepareQueryFilters($grid,$cleantax){
		$query=$grid.data('query');
		//console.log($query.tax_query);
		var condition=$grid.is('.AND')?"AND":"OR";
		/*$grid.parent().find('.grid-filter li:not(.required) a').on( 'click', function(e) {
			e.preventDefault();
			var single=$(this).parents('.grid-filter').is('.single');
			var tax = $(this).data('taxonomy');
			var taxid = $(this).data('tax-id');*/
		//console.log(clean);
		
		
		if(!$query.hasOwnProperty('tax_query') || !$query.tax_query.hasOwnProperty('defaults')){
			var taxquery={
				relation : 'AND',
				userselected : { relation: condition},
				defaults : {}
			};
			taxquery.defaults=$query.tax_query;
			$query.tax_query=taxquery;
		}
		
		
	
		$grid.parent().find('.grid-filter').each(function(i){
			var condition=$(this).data('condition');
			var tax=$(this).data('taxonomy');
			if(!$query.tax_query.userselected.hasOwnProperty($(this).data('taxonomy')) ||  $cleantax==tax){
				$query.tax_query.userselected[$(this).data('taxonomy')]={relation : condition};
			}
		});
			
		
		$grid.data('query',$query);
		
		return $query;
		
	}
	function toggleTaxonomyFilter($grid,$taxonomy,$id){
		$query=$grid.data('query');
		$query=prepareQueryFilters($grid);
		
		
		if($query.tax_query.userselected[$taxonomy].hasOwnProperty($id)){
			delete $query.tax_query.userselected[$taxonomy][$id];
		}else{
			$query.tax_query.userselected[$taxonomy][$id]={
				field: 'id',
				taxonomy: $taxonomy,
				terms: $id
			};
		}
		//console.log($query.tax_query);
		$grid.data('query',$query);
		setPageNum($grid,1);
	}
	
	function removeTaxonomyFilter($grid,$taxonomy,$id){
		$query=$grid.data('query');
		$query=prepareQueryFilters($grid);
		if($query.tax_query.userselected[$taxonomy].hasOwnProperty($id)){
			delete $query.tax_query.userselected[$taxonomy][$id];
		}
		$grid.data('query',$query);
		//console.log($query.tax_query);
		
		setPageNum($grid,1);
	}


	function resetTaxonomyFilter($grid,$taxonomy){
		$query=$grid.data('query');
		//console.log("RESET "+$taxonomy);
		

		$grid.parent().find('.grid-filter').each(function(i){
			var condition=$(this).data('condition');
			if($(this).data('taxonomy')==$taxonomy){
				delete $query.tax_query.userselected[$taxonomy];
				$query.tax_query.userselected[$taxonomy]={relation : condition};	
			}
			
		});
		

		$grid.data('query',$query);
		//console.log($query.tax_query);
		
		setPageNum($grid,1);
	}
	
	
	function setTaxonomyFilter($grid,$taxonomy,$id){
		$query=$grid.data('query');
		$query=prepareQueryFilters($grid,$taxonomy);
		
		//remove not default filters
		//prepareQueryFilters($grid);
		//console.log($taxonomy+"_"+$id);
		//console.log($query.tax_query);
		if($taxonomy && !$id){
			resetTaxonomyFilter($grid,$taxonomy);

		}else{
			if(!$.isArray($id)){
				$id=[$id];
			}
			//console.log($id);
			$.each($id,function(key,value){
				if(value && value!=""){
					//console.log(value);
					//console.log($query.tax_query.userselected[$taxonomy]);
					$query.tax_query.userselected[$taxonomy][value]={
						field: 'id',
						taxonomy: $taxonomy,
						terms: value
					};
				}

			});
			
		}
		//console.log($query.tax_query);
		$grid.data('query',$query);
		setPageNum($grid,1);
		
	}

	
	function setPageNum($grid,num){
		$query=$grid.data('query');
		var max=$grid.data('numpages');
		//console.log("Setting page "+num);
		
		if(num<=max && num>0)
			$query.paged=num;
		
		$grid.data('query',$query);
	}
	
	function getPageNum($grid){
		$query=$grid.data('query');
		if(!$query.hasOwnProperty('paged')) return 1;
		else return $query.paged;
	}
	
	function monitorLazyloaders($grid){
		//console.log($grid.is(':in-viewport')+";"+$(window).scrollTop()+";"+$(window).height()+";"+$grid.offset().top +";"+$grid.height());
		if($grid.is('.init') && !$grid.is('.nomore') && !$grid.is('.loading') && $grid.is(':in-viewport') && ($grid.height()+$grid.offset().top - $(window).scrollTop())<$(window).height()){
			incPageNum($grid);
			loadPosts($grid);
		}
	}
	
	



	function initFiltering($grid){
		
		var texts=getTexts($grid);
		
		var selects=$grid.parent().find('.grid-filter select.select2');
		
		
		

		if(selects.size()>0){
			var args={
			  placeholder: texts.choose_filter
			};

			if(!selects.data('required')) args.allowClear=true;
			selects.select2(args);

			selects.on("change", function (e) { 
				//log("select2:select", e); 
				var single=$(this).parents('.grid-filter').is('.single');
				$grid.addClass('filterschanged');
				var tax = $(this).data('taxonomy');
				var taxid = $(this).val();
				
				if(single){
					setTaxonomyFilter($grid,tax,taxid);
					loadPosts($grid);
				}else{
					//console.log(taxid);
					setTaxonomyFilter($grid,tax,taxid);
					loadPosts($grid);
				}
				

				 
			



			});
		}


		$grid.parent().find('.grid-filter li:not(.required) a').on( 'click', function(e) {
			e.preventDefault();
			var tax = $(this).data('taxonomy');
			var taxid = $(this).data('tax-id');
			var single=$(this).parents('.grid-filter').is('.single');
			$grid.addClass('filterschanged');
			if(single){
				if(!$(this).parent().is('.selected')){
					$(this).parents('.grid-filter').find('li.selected:not(.required)').removeClass('selected');
					$(this).parent().addClass('selected');
					setTaxonomyFilter($grid,tax,taxid);
					loadPosts($grid);
				}else{
					$(this).parent().removeClass('selected');
					removeTaxonomyFilter($grid,tax,taxid);
					loadPosts($grid);
				}
			}else{
				$(this).parent().toggleClass('selected');
				toggleTaxonomyFilter($grid,tax,taxid);
				loadPosts($grid);
			}
				
				
				
			
			/*var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });*/
		});

	}
	
	function initGrids(){
        if($(".articles-container.grid").size()>0){
			$(".articles-container.grid").each(function(i){
				
				var $grid =$(this);
				$grid.find(".tile").each(function(){
					fixBoxedArticleHeight($(this).children("article"));
						
				});
				
				$grid.isotope(defaults);
				
				
				// layout Isotope after each image loads
				$grid.imagesLoaded().progress( function() {
				    $grid.isotope('layout');
				});
				
				$query=$grid.data('query');
				if($query){
					var pagesize=$query.posts_per_page;
					if(pagesize==-1) return;
					if(pagesize=="") pagesize=$grid.find('.tile').size();
					$grid.data('pagesize',pagesize);
				
					if($grid.is('.pagination-loadmore')) initPaginationLoadMoreButton($grid);
					if($grid.is('.pagination-lazyload')) initPaginationLazyload($grid);
					if($grid.is('.pagination-arrows')) initPaginationClassic($grid);
					if($grid.is('.pagination-numbers')) initPaginationNumbers($grid);
					if($grid.is('.pagination-dots')) initPaginationDots($grid);
						
					if($grid.is('.filterable')) initFiltering($grid);
				}		
				
				
			});
            


        }

    }
	
	
	

		

	$(document).ready(function(){	
		
		initGrids();
		
	});
	
	$(window).resize(function(){	
		
		
	});
	
	
	$(window).scroll(function(){	
		monitorLazyloaders($(".articles-container.pagination-lazyload"));
	});
	


	
})(jQuery);