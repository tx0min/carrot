<?php

	class Authors extends CustomPostType{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Author";
			$this->slug = "authors";
			
			
			$this->labels = array(
				"name" => __( 'Authors', THEME_NAME ),
				"singular_name" => __( 'Author', THEME_NAME ),
				"add_new" => __( 'New author', THEME_NAME ),
				"add_new" => __( 'New author', THEME_NAME ),
				"add_new_item" => __( 'Add new author', THEME_NAME ),
				"edit_item" => __( 'Edit author', THEME_NAME ),
			);
			
			/*cpt*/
			$this->menu_icon = "dashicons-universal-access-alt";		
			$this->optional = true;
			$this->enabled = false;
			$this->shortcodes = true;		
			$this->exclude_from_search = false;
			
						
			/*acf options*/
			$this->shows = array('the_content');
			$this->fields =  array (
				array (
					'label' => __('Personal data',THEME_NAME),
					'name' => '',
					'type' => 'tab',
					
				),
				array (
					'label' => __('Birth year',THEME_NAME),
					'name' => 'birthyear',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
					
				),array (
					'label' => __('Birth place',THEME_NAME),
					'name' => 'birthplace',
					'type' => 'text',
					
				),
				array (
					'label' => __('Publications',THEME_NAME),
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'top',
					'endpoint' => 0,
				),
				array (
					'label' => __('Other publications',THEME_NAME),
					'name' => 'publicaciones',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_titulo_publi',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => __('Add publication',THEME_NAME),
					'sub_fields' => array (
						array (
							'label' => __('Title',THEME_NAME),
							'name' => 'titulo',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array (
							'label' => __('Editorial',THEME_NAME),
							'name' => 'editorial',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array (
							'label' => __('Year',THEME_NAME),
							'name' => 'anyo',
							'type' => 'number',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '10',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
						array (
							'label' => __('Awards and Honours',THEME_NAME),
							'name' => 'premios',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'wpautop',
						),array (
							'label' => __('Synopsis',THEME_NAME),
							'name' => 'synopsis',
							'type' => 'textarea',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'maxlength' => '',
							'rows' => '',
							'new_lines' => 'wpautop',
						),
					),
				),
				array (
					'label' => __('Interview',THEME_NAME),
					'type' => 'tab',
					
				),
				array (
					'label' => __('Interview',THEME_NAME),
					'name' => 'interview',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'visual',
					'toolbar' => 'full',
					'media_upload' => 0,
					'delay' => 0,
				),
				
				array (
					'label' => __('Social Networks', THEME_NAME ),
					'type' => 'tab',
					
				),
				array (
					'label' => __('Social Networks', THEME_NAME ),
					'name' => 'redes_sociales',
					'type' => 'clone',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'clone' => array (
						0 => 'group_social_networks',
					),
					'layout' => 'block',
					'prefix_label' => 0,
					'prefix_name' => 0,
				),
				array (
					'label' => __('Multimedia', THEME_NAME ),
					'type' => 'tab',
					
				),
				array (
					'label' => __('Videos', THEME_NAME),
					'key' => 'field_videos',
					'name' => 'videos',
					'type' => 'repeater',
					'layout' => 'table',
					'collapsed' => 'field_video_url',
					'button_label' => __('Add Video', THEME_NAME),
					'sub_fields' => array (
						array (
							'label' => __('Video URL', THEME_NAME),
							'name' => 'video_url',
							'type' => 'url',
							'instructions' => __('Youtube or Vimeo video URL', THEME_NAME),
						),
					),
				),
				array (
					'label' => __('Audio/Music', THEME_NAME),
					'key' => 'field_audio',
					'name' => 'audio',
					'type' => 'repeater',
					'layout' => 'table',
					'collapsed' => 'field_audio_url',
					'button_label' => __('Add Audio', THEME_NAME),
					'sub_fields' => array (
						array (
							'label' => __('Audio URL', THEME_NAME),
							'name' => 'audio_url',
							'type' => 'url',
							'instructions' => __('Spotify song or playlist URL', THEME_NAME),
						),
					),
				),
				
				
			);
			
			$this->styles=array("authors");
			
			
			if(carrot_projects_enabled()){
				$this->fields=array_merge($this->fields,array(
					array (
						'label' => __('Projects', THEME_NAME),
						'name' => 'tab_author',
						'type' => 'tab',
					),
					array (
						'label' => __('Author projects',THEME_NAME),
						'name' => 'related-project-author',
						'type' => 'relationship',
						'post_type' => array (
							0 => 'projects',
						),
						'taxonomy' => array (
						),
						'filters' => array (
							0 => 'search',
						),
						'elements' => array (
							0 => 'featured_image',
						),
						'min' => '',
						'max' => '',
						'return_format' => 'object',
					),
				));
			}
			
			
			if(carrot_is_woocommerce_activated()){
				$this->options =  array (
					array (
						'label' => __('Link to Woocommerce products',THEME_NAME),
						'name' => 'author_woocommerce',
						'type' => 'true_false',
						'default' => '1',
						
					),
					array (
						'label' => __('Link to Projects',THEME_NAME),
						'name' => 'author_project',
						'type' => 'true_false',
						'default' => '1',
						
					)
				);
				
				
			}
			$this->customizer = array(
				
				$this->slug.'_show_featured'=>array(
					'type'        => 'toggle',
					'label'       => __( 'Show featured image', THEME_NAME ),
					'default'     => '0'

				)

						
			);
			
			$this->otherfields =  array (
				"post" => array(
					"title" =>__("Related Authors",THEME_NAME),
					'position' => 'side',
					"fields" => array(
						array (
							'key' => 'field_related_authors',
							'label' => __('Related Authors',THEME_NAME ),
							'name' => 'related_authors',
							'type' => 'relationship',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'post_type' => array (
								0 => 'authors',
							),
							'taxonomy' => array (
							),
							'filters' => array (
								0 => 'search',
							),
							'elements' => array (
								0 => 'featured_image',
							),
							'min' => '',
							'max' => '',
							'return_format' => 'object',
						)
					)
				)
			
			);
			
			
		}
		



	}
	
	function carrot_authors_enabled(){
		return opt("enable_authors");
	}

	
	function carrot_authors_woocommerce_enabled(){
		return carrot_authors_enabled() && opt("author_woocommerce");
	}

	
	
	



	if ( ! function_exists( 'carrot_get_authors' ) ) :
		function carrot_get_authors($pagenum=1,$filter=false){
			
			 $args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type' => array( 'authors'),
				'post_status'      => 'publish',
				'ignore_sticky_posts' => 0 
			);
			$posts= get_posts( $args );
			$ret=array();
			$ret[0]="--";
			foreach($posts as $post){
				$ret[$post->ID]=$post->post_title;
			}
			
			return $ret;
			
			
			
			
		}
	endif;





	if ( ! function_exists( 'carrot_get_product_author' ) ) :
		function carrot_get_product_author(){
			global $post;
			$authorid=get_post_meta( $post->ID, "product_author", true );
			if($authorid){
				$author=get_post($authorid);
				if($author) return $author;
			}		
			return "";
		}
	endif;
	
	if ( ! function_exists( 'carrot_get_author_products' ) ) :
		function carrot_get_author_products(){
			global $post;
		
			 $args = array(
				'posts_per_page'   => -1,
				'orderby'          => 'post_title',
				'order'            => 'ASC',
				'post_type' => array( 'product'),
				'post_status'      => 'publish',
				'ignore_sticky_posts' => 0,
				'meta_query' => array(
				   array(
					   'key' => 'product_author',
					   'value' => $post->ID,
					   'compare' => '=',
				   )
			   )
			);
			return new wp_query( $args );
			//return  get_posts( $args );
		}
	endif;

	if ( ! function_exists( 'carrot_author_products' ) ) :
		function carrot_author_products(){
			if(!function_exists("carrot_woocommerce_product_image")) return;
			
			global $post;
			$orig_post = $post;
			
				$books_query=carrot_get_author_products();
				if($books_query->have_posts() ){
		?>
		<div class="publications articles-slider owl-carousel owl-theme" data-nav="false" data-loop="false" data-fx="fade" data-auto-height="false">
	
		<?php		
				while( $books_query->have_posts() ) {
					$books_query->the_post();
					
		?>
			<div class="author-product">
				<a href="<?php the_permalink();?>">
					<?php carrot_woocommerce_product_image();?>
					<h2><?php the_title(); ?></h2>
				</a>
			</div>
		<?php
				}
		?>
		</div>
		<?php
			}
			$post = $orig_post;
			wp_reset_query();
		}
	endif;

	
	
	if ( ! function_exists( 'carrot_get_author_name' ) ) :
		function carrot_get_author_name(){
			global $post;
			$authorid=get_post_meta( $post->ID, "product_author", true );
			if($authorid){
				$author=get_post($authorid);
				if($author) return $author->post_title;
			}		
			return "";
			
			
			
			
		}
	endif;

if ( ! function_exists( 'author_single_template' ) ) :
		function author_single_template($layout=false){
			global $post;
			$authorid=get_post_meta( $post->ID, "product_author", true );
			if($authorid){
				$oldpost=$post;
				$post=get_post($authorid);
				setup_postdata($post);
				
				if(!$layout)	$layout= _o("authors"."_layout","default");
				get_posttype_template_part("authors", "single/".$layout);
				
				wp_reset_postdata();
				$post=$oldpost;
									
			}		
			
		}
	endif;


if ( ! function_exists( 'carrot_author_contact_links' ) ) :
	function carrot_author_contact_links(){

		 if(gf("web")||gf("email")||gf("facebook")||gf("twitter")||gf("instagram")||gf("linkedin")||gf("wikipedia")){ 
?>
		<div class="author-contact">
			<div class="author-social">
			<?php
				echo _field("web",'<a href="', '" rel="external" target="_blank">'._icon("icon_web").'</a>'); 
				echo _field("email",'<a href="mailto:', '" rel="external" >'._icon("icon_email").'</a>'); 
				echo _field("facebook",'<a href="', '" rel="external" target="_blank">'._icon("icon_facebook").'</a>'); 
				echo _field("twitter",'<a href="https://twitter.com/', '" rel="external" target="_blank">'._icon("icon_twitter").'</a>'); 
				echo _field("instagram",'<a href="https://www.instagram.com/', '" rel="external" target="_blank">'._icon("icon_instagram").'</a>'); 
				echo _field("wikipedia",'<a href="', '" rel="external" target="_blank">'._icon("icon_wikipedia").'</a>'); 
				echo _field("linkedin",'<a href="', '" rel="external" target="_blank">'._icon("icon_linkedin").'</a>'); 
				
				
				
			?>
		</div>
	</div>
	
<?php
		}
	}
endif;



if ( ! function_exists( 'carrot_author_birth' ) ) :
	function carrot_author_birth(){
		if(gf("birthplace") || gf("birthyear") ){
?>
	<div class="author-birth">
		<?php echo gf("birthplace"); ?> <strong><?php echo gf("birthyear"); ?></strong>
	</div>
	
<?php
		}
	}
endif;



if ( ! function_exists( 'carrot_author_other_publications' ) ) :
	function carrot_author_other_publications(){
		$pubs=gf("publicaciones");
		if($pubs && is_array($pubs)){
?>
	<h2><?=__("Also written",THEME_NAME)?></h2>
	<div class="publications articles-slider owl-carousel owl-theme" data-nav="false" data-loop="false" data-fx="fade" >
		
<?php	
			foreach($pubs as $pub){
?>
		<div class="publication">
			<h3 class="publication-title"><?=$pub["titulo"]?></h3>
			<?php if($pub["premios"]){?> <span class="premios"><?=_icon("icon_award")?> <?=$pub["premios"]?></span> <?php } ?>
			<div>
				<?php if($pub["editorial"]){?> <span class="editorial"><?=$pub["editorial"]?></span> <?php } ?>
				<?php if($pub["anyo"]){?> <?php if($pub["editorial"]){?>, <?php } ?><span class="anyo"><?=$pub["anyo"]?></span> <?php } ?>
			</div>
			<?php if($pub["synopsis"]){?> <span class="synopsis"><?=$pub["synopsis"]?></span><?php } ?>
		</div>
<?php				
			}
?>
	</div>
<?php
		}
	}
endif;