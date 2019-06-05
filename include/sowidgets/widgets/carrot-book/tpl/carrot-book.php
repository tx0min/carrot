<?php

	$this->carrot_widget_header($instance);
	
	if($bookmode=="selected" ){
		$query_result = carrot_get_book($bookid);
	}else{
		$query_result=carrot_get_books($bookmode);
	}
	
	/*_dump($bookmode);
	_dump($bookid);
	_dump($bookdisplay);
	_dump($items_number);
*/
	
	//_dump($query_result);
	$classes=array("books-container", "display-".$bookdisplay);
	$data="";
	/*if($bookdisplay=="passages" || $bookdisplay=="reviews"){ 
		$classes[]="articles-slider";
		$classes[]="owl-carousel";
		$classes[]="owl-theme";
		$classes[]="loading";
		$data='data-nav="false" data-loop="false" data-fx="fade"';
	}*/
	
	if($query_result->have_posts()) {
?>
	<div class="<?=implode(" ",$classes)?>" >
	<?php	
		while($query_result->have_posts()){
			$query_result->the_post(); 
	?>
		<div class="book-content-container">
			
			<?php	
				switch($bookdisplay){
					case "cover":
						
						carrot_book_cover_card();
						
						break;
					
					case "author":
						//_dump($author);
						carrot_product_author_card();
						break;
					
					case "passages":
						carrot_product_passages($items_number, true);
						break;
					
					case "reviews":
						carrot_product_external_reviews($items_number);
						break;
					
					default: break;
				}//switch
		?>	
		</div>
	<?php
		}
		wp_reset_postdata(); 
	?>
<?php
		
?>
	</div><!--.books-container-->
<?php
	} 
	
	$this->carrot_widget_footer($instance);
