<?php
/**
 * @package Carrot Theme
 * Template Name: Content left + author/taxonomies/ADs right (no sidebar, no featured)
 */
?>
</div><!--.container-->


	
<article id="post-<?php the_ID(); ?>" <?php carrot_post_class( ); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-7">

				<header class="entry-header clearfix">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			</div>

			<div class="col-sm-5">
				<div class="article-author clearfix">
					<?php 
						$author_options=array(
							"name"=>true,
							"avatar"=>true,
							"bio"=>true,
							"prefix"=>"<small>".__("Un article de",THEME_NAME)."</small><br/>", 
							"twitter"=>true
						);
						carrot_author_args($author_options);
					?>
				</div>
			</div>
		</div>	<!--.row-->		
		<div class="row">		
			<div class="col-sm-7">
				<?php if(gf("entradeta")){ ?>
					<div class="entradeta">
						<?=gf("entradeta")?>
					</div>
				<?php } ?>
				<div class="article-date">
					<?=_icon("icon_clock","small")?> <?=__("Publicat el",THEME_NAME)?> <?php carrot_posted_on(); ?> 
					<?php 
						if(function_exists('carrot_get_post_views')) { 
							echo "| ";
							carrot_view_count();
						} 
					?>
					
					
						
				</div>

				<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
					<?php 
					
						//_dump(get_locale());

						the_content();
						
						
					?>
				</div><!-- .entry-content -->


			</div><!--.col-->	

			<div class="col-sm-4">
				<div class="sidebar">
					<?php
						
						if(gf("show_ads") || !has_field("show_ads")){	
							
							$instance=array(
								"style_section" =>array(
									"header_section" =>array(
										"style_header_border_bottom_section"=> array(
											"header_border_bottom_width" => '0',
											"header_border_top_color" => 'borders',

										)
									),
								),
								"title" => __("ADs",THEME_NAME)

							);
							
							if(gf("ad_type")=="chosen"){
								$banids=array();						
								if(gf("selected_ads")){
									foreach(gf("selected_ads") as $ad){
										$banids[]=$ad->ID;
									}
								
								}
								//_dump($banids);
								
								
								$instance["selected_banners"]='post_type=banners&post__in='.implode(",",$banids).'&date_query={"after":"","before":""}&orderby=post__in&order=DESC&posts_per_page=&sticky=&additional=';
								$instance["banner_number"] = count($banids);
								$instance["banner_show"] = gf("ad_type");

							}else{
								if(get_the_tags() && count(get_the_tags()>0)){
									$instance["banner_show"] = gf("ad_type")?gf("ad_type"):"related";
								}else{
									$instance["banner_show"] = gf("ad_type")?gf("ad_type"):"random";
								}
								
								$instance["banner_format"] = gf("ad_format")?gf("ad_format"):"horizontal";
								$instance["banner_number"] = gf("ad_number");
								
							}
							
							//the_widget( 'Carrot_ADS_Widget', $instance );
						}
					?>
					
					<div id="carrot-widget-carrot-categories" class="widget carrot-widget-carrot-categories ">
						
						<h3 class="widget-title"><?=__("Categories",THEME_NAME)?></h3>
						
						
						<div class="widget-body">
							<?php carrot_post_categories()?>
						</div>
					</div>
					
					<div id="carrot-widget-carrot-tags" class="widget  carrot-widget-carrot-tags ">
						<h3 class="widget-title"><?=__("Tags",THEME_NAME)?></h3>
						
						
						<div class="widget-body">
							<?php carrot_post_tags()?>
						</div>
					</div>
				

				</div>				
			</div>				
		</div><!--.row-->	
	
		<div class="row">
			<div class="article-footer clearfix">
				<div class="col-sm-4">
					<?php carrot_sharing_buttons(); ?>
				</div>
				<div class="col-sm-4 text-center"><a href="#comments-container"><?=_icon("icon_comment")?> <?=__("Leave a comment",THEME_NAME)?> <small>(<?=get_comments_number()?>)</small></a></div>
				<div class="col-sm-4 text-right">
					&nbsp;
				</div>
			</div>
		</div>				
		
	</div><!--.container-->	
	


</article><!-- #post-<?php the_ID(); ?> -->					

<?php carrot_single_post_navigation(); ?>

<?php carrot_show_related(); ?>
<?php carrot_show_comments(); ?>
	
	

<div class="container">