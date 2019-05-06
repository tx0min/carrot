<?php
//	_dump($show_options);
//	_dump($hovereffect);
	$classes[]="post-article";
	
	$showtitle=array_key_exists("title",$show_options)&& isTrue($show_options["title"]) ;
	$showthumbnail=array_key_exists("thumbnail",$show_options)&& isTrue($show_options["thumbnail"]);
	
	$showexcerpt=array_key_exists("excerpt",$show_options)&& isTrue($show_options["excerpt"]);
	$showcontent=array_key_exists("content",$show_options)&& isTrue($show_options["content"]);
	$showdate=array_key_exists("date",$show_options)&& isTrue($show_options["date"]);
	$showauthor=array_key_exists("author",$show_options)&& (isTrue($show_options["author"]) || is_array($show_options["author"]));
	$showcategories=array_key_exists("categories",$show_options)&& isTrue($show_options["categories"]);
	$showcomments=array_key_exists("commentscount",$show_options)&& isTrue($show_options["commentscount"]);
	$showviews=isset($show_options["viewcount"]) && array_key_exists("viewcount",$show_options)&& isTrue($show_options["viewcount"]);
	
	$colsize=$thumbcols;
	$thumbborder=isset($thumbborder)?$thumbborder:true;
	//_dump($responsive);
	
	
	$responsivesize=$responsive?"sm":"xs";
	if($responsive) $classes[]="thumb-responsive";
	
	$col2size=12-$colsize;
	
	if($colsize<=0 || $colsize>=12){
		$colsize=12;
		$col2size=12;
	}
	
	if(!$thumbnail_position) $thumbnail_position="top";

	
	
	if(is_array($hovereffect)){
		if($hovereffect["effect"]!="none"){
			$classes[]="hover";
			$classes[]="hover-effect-".$hovereffect["effect"];
			if(isTrue($hovereffect["view_more"])){
				$classes[]="hover-view-more";
			}
			$classes[]="view-more-v-".$hovereffect["view_more_pos_v"];
			$classes[]="view-more-h-".$hovereffect["view_more_pos_h"];
			
			if($hovereffect["show_text"]){
				$classes[]="hover-title";
			}
			$classes[]="title-v-".$hovereffect["title_pos_v"];
			$classes[]="title-h-".$hovereffect["title_pos_h"];

			
			
		}
	}
		
	$hoverclasses=array();
	if($hovereffect["bgcolor"]){
		if(!preg_match('|^#|', $hovereffect["bgcolor"])) $hoverclasses[]="bg-".$hovereffect["bgcolor"];
		else $hoverclasses[]="bg-custom";
	}
	if($hovereffect["fgcolor"]){
		if(!preg_match('|^#|', $hovereffect["fgcolor"])) $hoverclasses[]="fg-".$hovereffect["fgcolor"];
		else $hoverclasses[]="fg-custom";
	}
	
	if(!$thumbborder) $classes[]="no-thumb-border";
	
	
	$article_icon=carrot_get_article_icon($hovereffect["view_more_icon"]);
	
	$author_before=isset($show_options["author"]["before"]) && $show_options["author"]["before"];

	$gridsize=get_field("single_".get_post_type()."_grid_cols");
?>
<article id="post-<?php the_ID(); ?>"  <?php post_class($classes); ?>  title="<?php the_title(); ?>" data-grid-size="<?=$gridsize?>" >
								
	<div class="article-inner">
	
		<div class="row">
			<?php if($showthumbnail && ($thumbnail_position=='top' || $thumbnail_position=='left')){ ?>
				<div class="col-<?=$responsivesize?>-<?=$colsize?> ">
					<div class="article-featured <?=implode(" ",$hoverclasses)?>">
						<?php 
							if($thumbnail_image_type=='author'){
								carrot_author(true,false,false,false);
							}else if($thumbnail_image_type=='posttype'){
								echo ""; //TODO
							}else{
								if($thumbnail_position=='left' ){
									carrot_post_thumbnail($thumbsize,false,false,true,false,true);
								}else{
									carrot_post_thumbnail($thumbsize,false,false,true,false);
								}
							}
							 
						?>
						<div class="opener-icon"><span><span><p class="icon"><?=$article_icon?></p></span></span></div>
						<div class="hover-title">
							<span>
								<?php 
									
									if(is_array($hovereffect["show_text"])){

								?>
									<h2 >
										<?php if(array_key_exists("title",$hovereffect["show_text"]) && isTrue($hovereffect["show_text"]["title"])){ ?> <span class="title"><?php the_title(); ?></span> <?php } ?>
										
										<?php 
											if(array_key_exists("author",$hovereffect["show_text"]) && isTrue($hovereffect["show_text"]["author"])){ 
												$the_id = get_the_author_meta( 'ID' );
												//_dump($the_id);

												$user=get_userdata($the_id);
												//_dump($user->data->display_name);
										?> 
											<span class="author"><?php echo $user->data->display_name; ?></span> 

										<?php } ?>

										<?php  if(array_key_exists("date",$hovereffect["show_text"]) && isTrue($hovereffect["show_text"]["date"])){ ?> 
											<span class="date"><?php carrot_posted_on(); ?></span> 
										<?php } ?>

										<?php  if(array_key_exists("excerpt",$hovereffect["show_text"]) && isTrue($hovereffect["show_text"]["excerpt"])){ ?> 
											<span class="excerpt"><?php the_excerpt(); ?></span> 
										<?php } ?>

										<?php  
											if(array_key_exists("taxonomy",$hovereffect["show_text"]) && $hovereffect["show_text"]["taxonomy"]){ 
												$terms=carrot_get_post_taxonomies(get_the_ID(),$hovereffect["show_text"]["taxonomy"]);
												
												if($terms){
										?>
												<span class="taxonomy">
													<?php
														$tmp=array();
														foreach($terms as $term) $tmp[]=$term->name; 
														echo implode(", ",$tmp);
													?>
												</span>
										<?php
												}	
										
											} 
										?>
									</h2>


								<?php } ?>
							</span>
						</div>
						
					</div>

				</div>
			<?php } ?>
			
			<?php
				if($showexcerpt || $showcontent || $showtitle || $showdate || $showviews || $showauthor || $showcategories || $showcomments ){
			?>
			
				<div class="col-<?=$responsivesize?>-<?=$col2size?>">
				
					<?php if($showtitle || $showcategories || $showdate ){?>
					
						<header class="entry-header clearfix">
							<?php if($showcategories){?>
								 <div class="article-categories"><?php carrot_post_categories();	?></div>
							<?php }?>
							
							<?php if($showauthor && $author_before){?>
								<div class="author-before">
									<div class="article-author"><?php carrot_author_args($show_options["author"]); ?></div>
									<?php if($showtitle){?>
									<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
								</div>
								<?php }?>
							<?php } ?>
							
							<?php if($showtitle && !$author_before){?>
								<h3 class="entry-title "><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
							<?php }?>
							
							<?php if($showdate){?>
								<div class="article-date"><?php carrot_posted_on(); ?></div>
							<?php }?>
							
							<?php if($showviews){?>
								<div class="article-views">
									<?php 
										if(function_exists('carrot_get_post_views')) { 
											if($showdate) echo " | ";
											carrot_view_count();
										} 
									?>
									</div>
							<?php }?>
						</header><!-- .entry-header -->
					<?php }?>
					
					
					
					<?php
						if(($showauthor && !$author_before) || $showcomments ){
							
							
							
					?>
						<div class="entry-meta clearfix">
							<?php 
								if($showauthor ){
							?>
								 <div class="article-author"><?php carrot_author_args($show_options["author"]); ?></div>
							<?php }?>
							
							
							
							<?php
								if($showcomments){
									$comments=get_comments_number();
							?>
								<div class="article-comments " title="<?=sprintf(__("%s comments",THEME_NAME),$comments)?>">
									<a href="<?php the_permalink();?>#comments-container"><?=_icon("icon_comment".($comments>0?"_alt":""))?></a>
								</div><!-- .entry-content -->
							<?php }?>
						</div>
					<?php }?>
					
					
					<?php if($showexcerpt || $showcontent){?>
						
						<div class="entry-content clearfix">
							
							
							<?php if($showexcerpt){?>
									<?php the_excerpt(); ?>
							<?php }?>
							
							<?php if($showcontent){?>
									<?php the_content(); ?>
							<?php }?>
						
						</div><!-- .entry-content -->
					<?php }?>
				</div>
			<?php }?>
			
			<?php if($showthumbnail &&  (($thumbnail_position=='bottom' && has_post_thumbnail() ) || $thumbnail_position=='right')){ ?>
				<div class="col-<?=$responsivesize?>-<?=$colsize?> ">
					<div class="article-featured <?=implode(" ",$hoverclasses)?>">
						<?php 
							if($thumbnail_image_type=='author'){
								carrot_author(true,false,false,false);
							}else if($thumbnail_image_type=='posttype'){
								echo ""; //TODO
							}else{
								if($thumbnail_position=='right' ){
									carrot_post_thumbnail($thumbsize,false,false,true,false,true);
								}else{
									carrot_post_thumbnail($thumbsize,false,false,true,false);
								}
							}
							
							
							 
						?>
						<div class="opener-icon"><span><span><p class="icon"><?=$article_icon?></p></span></span></div>
						<div class="hover-title"><span><h2><?php the_title(); ?></h2></span></div>
						
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->