<?php

	class CustomPostType{
		public $fields;
		public $hides;
		public $shows;
		
		public $name;
		public $slug;
		
		public $labels;
		
		
		public $is_public;
		public $show_ui;
		public $show_in_rest;
		public $rest_base;
		public $has_archive;
		public $show_in_menu;
		public $exclude_from_search;
		public $capability_type;
		public $capabilities;
		public $map_meta_cap;
		public $hierarchical;
		public $rewrite;
		public $query_var;
		public $menu_icon;
		public $supports;
		
		public $styles;
		public $scripts;
		public $adminstyles;
		public $adminscripts;
		
		public $columns;
		
		
		public $editForm;
		
		public $optional;
		public $enabled;
		
		public $taxonomies;
		
		public $shortcodes;

		public $customizer;
		
		//widgets
		
		
		//other_fields (fields in other post types)
		public $otherfields;
		
		//global options 
		public $options;
		
		
		public $thumbsizes;
		
		
		public function __construct(){
			
			$this->name = "CustomPostType";
			$this->slug = "customposttypes";
			
			
			$this->labels = array(
				"name" => __( 'CustomPostTypes', THEME_NAME ),
				"singular_name" => __( 'CustomPostType', THEME_NAME ),
			);
	
			$labels = array(
				/*"name" => __( 'CustomPostTypes', THEME_NAME ),
				"singular_name" => __( 'CustomPostType', THEME_NAME ),
				"menu_name" => __( 'Mis aaaa', THEME_NAME ),
				"all_items" => __( 'Todos los aaa', THEME_NAME ),
				"add_new" => __( 'Nuevo aaa', THEME_NAME ),
				"add_new_item" => __( 'A�adir nuevo aaa', THEME_NAME ),
				"edit_item" => __( 'Editar aaa', THEME_NAME ),
				"new_item" => __( 'Nuevo aaa', THEME_NAME ),
				"view_item" => __( 'Ver aaa', THEME_NAME ),
				"search_items" => __( 'Buscar aaa', THEME_NAME ),
				"not_found" => __( 'No se encontraron aaa', THEME_NAME ),
				"not_found_in_trash" => __( 'No se encontraron aaa en la papelera', THEME_NAME ),
				"parent_item_colon" => __( 'aaa padre', THEME_NAME ),
				"featured_image" => __( 'Imagen del aaa', THEME_NAME ),
				"set_featured_image" => __( 'Definir im�gen', THEME_NAME ),
				"remove_featured_image" => __( 'Quitar imagen', THEME_NAME ),
				"use_featured_image" => __( 'Usar como imagen', THEME_NAME ),
				"archives" => __( 'Archivo de aaa', THEME_NAME ),
				"insert_into_item" => __( 'Insertar en aaa', THEME_NAME ),
				"uploaded_to_this_item" => __( 'Subir a aaa', THEME_NAME ),
				"filter_items_list" => __( 'Filtrar lista de aaa', THEME_NAME ),
				"items_list_navigation" => __( 'Navegaci�n de la lista de aaa', THEME_NAME ),
				"items_list" => __( 'Lista de aaa', THEME_NAME ),
				"parent_item_colon" => __( 'aaa padre', THEME_NAME ),*/
			);

			
			/*cpt options*/
			$this->description = "";
			$this->is_public = true;
			$this->show_ui = true;
			$this->show_in_rest = true;
			$this->has_archive = true;
			$this->show_in_menu = true;
			$this->exclude_from_search = true;
			$this->capability_type = "post";
			$this->capabilities = array();
			$this->map_meta_cap = true;
			$this->hierarchical = false;
			$this->query_var = true;
			$this->menu_icon = "dashicons-admin-generic";		
			$this->supports = array( "title","editor","excerpt","thumbnail","revisions","post-formats"); 
			
			/*acf options*/
			$this->fields = array();
			$this->hides=array (
				// 'permalink',
				'the_content',
				'excerpt',
				'custom_fields',
				'discussion',
				'comments',
				'revisions',
				'slug',
				'author',
				'format',
				'page_attributes',
				'categories',
				'tags',
				'send-trackbacks',
			);
			$this->shows=array();
			
			
			$this->styles = array();
			$this->scripts = array();
			$this->columns = array();
			
			$this->editForm = array();
			$this->optional = true;
			$this->enabled = true;
		
			$this->otherfields = array();
			$this->options = array();
			$this->shortcodes = false;
			

		}
		
		
		
		public function register(){
		
			$this->rewrite = array( "slug" => $this->slug, "with_front" => true );
			$this->rest_base = $this->slug;
			

			
			
			
			/*register the post type*/
			add_action( 'init', array( $this , 'registerPostType' ));
			
			/*custom form*/
			add_action( 'edit_form_advanced', array($this,'setCustomEditForm' ) );
			add_action( 'admin_head', array($this,'setEditFormTitle') );
			add_action( 'admin_enqueue_scripts', array($this,'includeAdminScripts') );
			add_action( 'wp_enqueue_scripts', array($this,'includeScripts') );
			add_action( 'save_post', array($this,'savePostTypeFields'), 10, 3 );
			
			/*columns*/
			add_filter('manage_edit-'.$this->slug.'_columns', array($this,'registerColumns'));
			add_action('manage_'.$this->slug.'_posts_custom_column', array($this,'setColumnsContent'), 10, 2);
			add_filter('manage_edit-'.$this->slug.'_sortable_columns', array($this,'setColumnsSortable'));
			add_action( 'pre_get_posts', array($this,'setColumnsSortingFunction' ));
			
			/*add to rest api*/
			//add_action( 'rest_api_init', array($this, 'registerRestFields'));
			
			add_action( 'restrict_manage_posts', array($this, 'addFilters') );
			add_filter( 'parse_query', array($this, 'filterQuery') );
			
			
			// Add quick edit fields
			add_action('quick_edit_custom_box',  array($this,'add_quick_edit'), 10, 2);
			//add_action('save_post', array($this,'save_quick_edit_data'));

	

		
		}
		

		
		public function addThumbsizes() {
			if($this->thumbsizes && is_array($this->thumbsizes) && count($this->thumbsizes>0)){
				foreach($this->thumbsizes as $key=>$thumbsize){
					add_image_size( $key, $thumbsize[0], $thumbsize[1], true );
				}
			}
		}
		
		
		public function add_quick_edit($column_name, $post_type) {
			if($this->taxonomies){
					
				foreach($this->taxonomies as $taxonomy){
					if(is_object($taxonomy)){
						$taxslug=$taxonomy->slug;
					
						if($column_name== $taxslug){
							//_dump($taxonomy);
							$fieldname='tax_input['.$taxslug.']';
							//$current_v = isset($_GET[$fieldname])? $_GET[$fieldname]:'';
							
			
														
							if($taxonomy->hierarchical){
?>
						
						
								<fieldset class="taxonomy-quick-edit-fieldset inline-edit-col-center inline-edit-categories">
									<div class="inline-edit-col">
										<span class="title inline-edit-categories-label"><?=$taxonomy->labels["name"]?></span>
										<input type="hidden" name="<?=$fieldname?>[]" value="0">
										<ul class="cat-checklist category-checklist">
											<?php	
												$taxonomies= carrot_get_taxonomies($taxslug);
												if($taxonomies){
													foreach($taxonomies as $i=>$tax){
											?>
											<li id="<?=$column_name?>-<?=$tax->term_id?>" class="popular-category">
												<label class="selectit">
													<input value="<?=$tax->term_id?>" class="taxonomy_quickedit"  data-taxonomy="<?=$taxslug?>" type="checkbox" id="tax-field-<?=$tax->term_id?>_<?=$i?>_<?=$taxslug?>" name="<?=$fieldname?>[]" > <?=$tax->name?>
												</label>
											</li>
											<?php
													}
												}
											?>
												
										</ul>

								
									</div>
								</fieldset>
<?php
							}else{
?>
						
						
								<fieldset class="taxonomy-quick-edit-fieldset inline-edit-col-center">
									<div class="inline-edit-col">
										<label class="inline-edit-tags">
											<span class="title"><?=$taxonomy->labels["name"]?></span>
											<textarea  data-taxonomy="<?=$taxslug?>" cols="22" rows="1" name="tax_input[<?=$taxslug?>]" class="taxonomy_quickedit tax_input_post_tag ui-autocomplete-input" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" ></textarea>
										</label>
									</div>
								</fieldset>
<?php
								
							}				
						}
					}
				}
			}
			
			
			
			
		}
		
		
				
		
		
		
		public function addDefaultColumns(  ){
			if($this->taxonomies){
					
				foreach($this->taxonomies as $taxonomy){
					
					if(is_object($taxonomy)){
						$taxslug=$taxonomy->slug;
						$this->columns[$taxslug] = array(
							"title"=> $taxonomy->labels["name"],
							"sortable" => false,
							"content" => function($column_name, $id){
								//return $column_name." hola ".$id;
								$taxes=carrot_get_post_taxonomies($id,$column_name);
								
								
								$taxonomy=get_taxonomy($column_name);

								$tmp="";
								$slugs=[];
								$vals=[];
								$hierarchical=$taxonomy->hierarchical;
								
								if($taxes){
									$i=0;
									foreach($taxes as $tax){
										$url="?taxonomy_filter_".$column_name."=".$tax->term_id;
										if(isset($_GET["post_type"])) $url.="&post_type=".$this->slug;
										
										
										if($hierarchical) $tmp.="<a href='".$url."'>";
										
										$tmp.=$tax->name;
										$vals[]=$tax->term_id;
										$slugs[]=$tax->slug;
										
										if($hierarchical)  $tmp.="</a>";
										if($i<count($taxes)-1) $tmp.=", ";
										$i++;
										
									}
									
								}
								if($hierarchical){
									$tmp.="<input type='hidden' class='taxonomy_field hierarchical' data-taxonomy='".$column_name."' id='".$column_name."_".$id."' value='".implode(",",$vals)."' />";
								}else{
									$tmp.="<input type='hidden' class='taxonomy_field ' data-taxonomy='".$column_name."' id='".$column_name."_".$id."' value='".implode(", ",$slugs)."' />";
								}
								//return implode(", ",$tmp);
								
								return $tmp;

							}
						);
					}
				}
			}
			
			if($this->supports && in_array("thumbnail",$this->supports)){
				$this->columns['thumbnail']  = array(
					"title"=>__('Featured Image',THEME_NAME),
					"sortable" => false,
					"content" => function($column_name, $id){
						$img=get_post_thumbnail_by_id($id,"mini-icon",true,false,false);
						if ($img) return $img;

					}
				);
			}
		}
		
		
		
		
		
		public function addFilters(  ){
			$type = 'post';
			if (isset($_GET['post_type'])) {
				$type = $_GET['post_type'];
			}
			//only add filter to post type you want
			if ($this->slug == $type){
				
				if($this->taxonomies){
					
					foreach($this->taxonomies as $taxonomy){
						if($taxonomy->hierarchical){
							$taxslug="";
            
							if(is_object($taxonomy)) $taxslug=$taxonomy->slug;
							else $taxslug=$taxonomy; 
							
							$fieldname='taxonomy_filter_'.$taxslug;
							$current_v = isset($_GET[$fieldname])? $_GET[$fieldname]:'';
							
			
							$args = array(
								'show_option_all'    => sprintf( __('All %s', THEME_NAME), $taxonomy->labels["name"]),
								'selected'           => $current_v,
								'name'               => $fieldname,
								'id'                 => $fieldname,
								'hierarchical'       => 1,
								'hide_empty'         => 0,
								'taxonomy'           => $taxslug,
							); 
							
							//_dump($args);
							wp_dropdown_categories( $args ); 
						}
						
					}
				}

				
				
			}
			
		}
		
		public function filterQuery( $query ){
			global $pagenow;
			//_dump($pagenow);
			 
			$type = 'post';
			if (isset($_GET['post_type'])) {
				$type = $_GET['post_type'];
			}
			
			if ( $this->slug == $type && is_admin() && $pagenow=='edit.php'){

				if($this->taxonomies){
					foreach($this->taxonomies as $taxonomy){
						if($taxonomy->hierarchical){
							$taxslug="";
							if(is_object($taxonomy)) $taxslug=$taxonomy->slug;
							else $taxslug=$taxonomy; 
							$fieldname='taxonomy_filter_'.$taxslug;
							
							if(isset($_GET[$fieldname]) && $_GET[$fieldname] ) {
								if(!isset($query->query_vars["tax_query"])){
									$query->query_vars["tax_query"]=array();	
								}
								
								$query->query_vars["tax_query"][]=array( 
									'taxonomy' => $taxslug, //or tag or custom taxonomy
									'field' => 'id', 
									'terms' => $_GET[$fieldname] 
								); 
							}
						}
					}
					//_dump($query->query_vars);
				}
				
			}
		}
		
		
		function savePostTypeFields( $post_id, $post, $update ){
			
			//_dump($update);
			
			if ($post->post_type == $this->slug ) {
				
				//save quick edit taxonomies
				if(isset($_REQUEST["tax_input"])){
					foreach($_REQUEST["tax_input"] as $taxslug=>$terms){
						$taxonomy=get_taxonomy($taxslug);
						if($taxonomy){
							if(!is_array($terms)){
								$terms=explode(",",$terms);
							}
							if($taxonomy->hierarchical){
								$terms = array_map( 'intval', $terms );
								$terms = array_unique( $terms );
							}
							$append=isset($_REQUEST["bulk_edit"]);
							wp_set_object_terms( $post_id, $terms, $taxslug ,  $append);
						}
					}
					
				}
				
				if($this->editForm && isset($this->editForm["save_function"])){
					if(is_callable ($this->editForm["save_function"])){
						call_user_func_array($this->editForm["save_function"], array($post_id, $post, $update));
					}
				}
			}
		}
		
				
		
		
		public function registerPostType(){
			
			$args = array(
				"label" => $this->labels["name"],
				"labels" => $this->labels,
				"description" => $this->description,
				"public" => $this->is_public,
				"show_ui" => $this->show_ui,
				"show_in_rest" => $this->show_in_rest,
				"rest_base" =>  $this->rest_base,
				"has_archive" => $this->has_archive,
				"show_in_menu" => $this->show_in_menu,
				"exclude_from_search" => $this->exclude_from_search,
				"capability_type" => $this->capability_type,
				"capabilities" => $this->capabilities,
				"map_meta_cap" => $this->map_meta_cap,
				"hierarchical" => $this->hierarchical,
				"rewrite" => $this->rewrite,
				"query_var" => $this->query_var,
				"menu_icon" => $this->menu_icon,		
				"supports" => $this->supports	
			);
		
			if(($this->optional && opt("enable_".$this->slug)) || !$this->optional){
			
				
				register_post_type( $this->slug, $args );
				
				if($this->taxonomies){
					foreach($this->taxonomies as $taxonomy){
						if(is_object($taxonomy)) $taxonomy->register($this->slug);
						else register_taxonomy_for_object_type($taxonomy, $this->slug) ; 
					}
				}
				
				$this->registerCustomFields();
				
				//create shortcodes
				if($this->shortcodes){
					add_shortcode( 'single_'.$this->slug, array( $this, 'singleShortcode' ) );
					add_shortcode( 'list_'.$this->slug, array( $this, 'listShortcode' ) );
				}

				$this->addThumbsizes();
				$this->addCustomizerOptions();
				/*
					add post type taxonomies columns
					
				*/
				$this->addDefaultColumns();
				
			}
			$this->registerOptions();
				
	
		}
		
		function addCustomizerOptions(  ) {
				//_dump($this->getSingleTemplates());
			$templates=$this->getSingleTemplates();
			
			$customizeroptions=array();
			
			if($templates){
				$customizeroptions['single_'.$this->slug.'_template']=array(
					'type'        => 'select',
					'label'       => __( 'Template', THEME_NAME ),
					'default'     => 'default',
					'multiple'    => false,
					'choices'     => $templates
				);
			}
			$customizeroptions['single_'.$this->slug.'_show_title'] = array(
				'type'        => 'toggle',
				'label'       => __( 'Show Title', THEME_NAME ),
				'default'     => '1'

			);
			$customizeroptions['single_'.$this->slug.'_show_breadcrumb'] = array(
				'type'        => 'toggle',
				'label'       => __( 'Show Breadcrumb', THEME_NAME ),
				'default'     => '1'

			);
			
			if($this->customizer) $customizeroptions=array_merge($customizeroptions,$this->customizer);

			//_dump($customizeroptions);
			if($customizeroptions){
				$customizersections=array(

					'single_'.$this->slug.'_section' =>array(
						'title' => __( 'Single '.$this->name, THEME_NAME ),
						'fields' => $customizeroptions,
						'active_callback' => function () { 
							return is_singular($this->slug);
						},
					)
				);
				//_dump($customizersections);
				foreach($customizersections as $name=>$section){
					Kirki_add_sections($name,$section);
				
				}
			}
		 }

		 function singleShortcode( $args ) {
			//var_dump($atts);
			/*	$atts = shortcode_atts( array(
					'i' => 'no foo',
					'baz' => 'default baz'
				), $atts, 'bartag' );
			*/	
			$template=_o('single_'.$this->slug."_template","default");
			
			$filepath=$this->getTemplatesPath()."single/".$template.".php";
			//_dump($filepath);
			if(file_exists($filepath)){
				//_dump($args);
				if(!isset($args["id"]) && !isset($args["slug"]) ) return;
				
				global $post;
				
				if(isset($args["id"])){
					$post=get_post($args["id"]);
				}else if(isset($args["slug"])){
					$post=get_page_by_path( $args["slug"], OBJECT, $this->slug );
				}
				if(!$post) return;
				
				setup_postdata($post);
				
				$ret = includeToVar($filepath, $args);
				wp_reset_postdata();
				return $ret;
			}
				
		}

		public function listShortcode( $args ) {
			$filepath=$this->getTemplatesPath()."list.php";
			//echo $filepath;
			if(file_exists($filepath)){
				global $post;
				$orig_post = $post;
				$queryargs=array ( 
					'post_type' => $this->slug,
				);

				//_dump($queryargs);
				$queryargs=array_merge($queryargs,$args);

				$my_query = new wp_query( $queryargs );

				if($my_query->have_posts() ){
					while( $my_query->have_posts() ) {
						$my_query->the_post();
						$ret.=includeToVar($filepath, $args);
					}
				}
				$post = $orig_post;
				wp_reset_query();
			}
			return $ret;
		}
		
		public function registerRestFields(){
			if($this->fields){
				 foreach($this->fields as $i=>$field){
					 register_rest_field( $this->slug,
						$field["name"],
						array(
						   'get_callback'    => 'carrot_get_post_meta_slug',
						   'update_callback' => 'carrot_update_post_meta_slug',
						   'schema'          => null,
						)
					 );
				}
			}
		}
		
		

		
		private function prepareFields($fields){
			if(!$fields) return;
			$tmp=$fields;
			foreach($tmp as $i=>$field){
				if(!isset($field["key"])){
					$tmp[$i]["key"] = $this->slug."_field_".$field["type"]."_".sanitize_title($field["label"]);
				}
				if(isset($field["sub_fields"])){
					foreach($field["sub_fields"] as $j=>$subfield){
						if(!isset($subfield["key"])){
							$subname=$this->slug."_subfield_".$subfield["type"]."_".sanitize_title($subfield["label"]);
							$tmp[$i]["sub_fields"][$j]["key"] = $subname;
						}
					}
				}
			}
			return $tmp;
		}
		
		private function prepareOtherFields($fields){
			if(!$fields) return;
			$tmp=$fields;
			foreach($tmp as $posttype=>$group){
				if(!isset($group["title"])) {
					$tmp[$posttype]["title"] = __("Options for:",THEME_NAME)." ".$this->slug;
				}
				if(isset($group["position"])) {
					/*Choices of 'acf_after_title', 'normal' or 'side'*/
					if(!in_array($tmp[$posttype]["position"],array('acf_after_title', 'normal' , 'side'))) $tmp[$posttype]["position"]="normal";
				}else{
					$tmp[$posttype]["position"]="normal";
				}
				if(isset($group["fields"])) {
					$tmp[$posttype]["fields"]=$this->prepareFields($group["fields"]);
				}
			}
			return $tmp;
		}
		
		
		public function registerCustomFields(){
			if(function_exists('acf_add_local_field_group')){
				if($this->fields){
					$this->fields=$this->prepareFields($this->fields);
					//if($this->shows)
					$this->hides=array_diff($this->hides,$this->shows);
					//_dump($this->hides);
					$templates=$this->getSingleTemplates(true);
					//$templates[""] = __("--site default--", THEME_NAME);
					//_dump($templates);
					//_dump(_o('single_'.$this->slug.'_template'));
					acf_add_local_field_group(array (
						'key' => $this->slug.'_template_group',
						'title' => __('Template',THEME_NAME ),
						'fields' => array (
							array (
								'key' => 'field_'.$this->slug.'_template',
								'label' => __('Template',THEME_NAME ),
								'name' => 'single_'.$this->slug.'_template',
								'type' => 'select',
								'required' => 0,
								
								'wrapper' => array (
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => $templates,
								'default_value' =>  '',//_o('single_'.$this->slug.'_template'),
								'allow_null' => 0,
								'multiple' => 0,
								'ui' => 0,
								'ajax' => 0,
								'placeholder' => '',
								'disabled' => 0,
								'readonly' => 0,
							),
							array (
								'key' => 'field_'.$this->slug.'_grid_cols',
								'label' => __('Grid columns',THEME_NAME),
								'name' => 'single_'.$this->slug.'_grid_cols',
								'instructions' => sprintf(__('For %s displayed in grids',THEME_NAME), $this->labels["name"] ),
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array (
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => 1,
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'min' => 1,
								'max' => 6,
								'step' => 1,
								'readonly' => 0,
								'disabled' => 0,
							)
						),
						'location' => array (
							array (
								array (
									'param' => 'post_type',
									'operator' => '==',
									'value' => $this->slug,
								)
							),
						),
						'menu_order' => 0,
						'position' => 'side',
						'style' => 'default',
						'label_placement' => 'top',
						'instruction_placement' => 'label',
						'hide_on_screen' => '',
						'active' => 1,
						'description' => '',
					));

					
					acf_add_local_field_group(
						array (
							'key' => $this->slug.'_group',
							'title' => $this->labels["name"],
							'fields' => $this->fields,
							'location' => array (
								array (
									array (
										'param' => 'post_type',
										'operator' => '==',
										'value' => $this->slug,
									),
								),
							),
							'menu_order' => 0,
							'position' => 'normal',
							'style' => 'seamless',
							'label_placement' => 'left',
							'instruction_placement' => 'label',
							'hide_on_screen' => $this->hides,
							'active' => 1,
							'description' => '',
						)
					);
				}
				
				if($this->otherfields){
					$this->otherfields=$this->prepareOtherFields($this->otherfields);
					foreach($this->otherfields as $posttype=>$group){
						acf_add_local_field_group(
							array (
								'key' => $this->slug.'_'.$posttype.'_group',
								'title' => $group["title"],
								'fields' => $group["fields"],
								'location' => array (
									array (
										array (
											'param' => 'post_type',
											'operator' => '==',
											'value' => $posttype,
										),
									),
								),
								'menu_order' => 0,
								'active' => 1,
								'position' => isset($group["position"])?$group["position"]:'normal',
								'style' => isset($group["style"])?$group["style"]:'default',
								'label_placement' => isset($group["label_placement"])?$group["label_placement"]:'top',
								'instruction_placement' => isset($group["instruction_placement"])?$group["instruction_placement"]:'label',
								'description' => isset($group["description"])?$group["description"]:'',
							)
						);
					}
				}

				

				
				
		
			}
		}
		

		public function registerOptions(){
			/* add global option to enable/disable post type*/
				
			if(function_exists('acf_add_local_field') && ($this->optional || $this->options)){
			
				if($this->optional){
					acf_add_local_field(array (
						'key' => 'tab_options_'.$this->slug,
						'label' => $this->name." ".__("Options",THEME_NAME),
						'type' => 'tab',
						'parent' => 'group_theme_settings'

						
					));
				}

				acf_add_local_field(array (
					'key' => 'enable_'.$this->slug,
					'label' => sprintf(__('Manage %s',THEME_NAME ),$this->labels["name"]),
					'name' => 'enable_'.$this->slug,
					'type' => 'true_false',
					//'instructions' => __('Check to enable this post type management',THEME_NAME),
					'default_value' => $this->enabled?1:0,
					'parent' => 'group_theme_settings',
					'wrapper' => array (
						'class' => 'separator',
					),
					
					
				));

				if($this->options){
					$this->options=$this->prepareFields($this->options);
					foreach($this->options as $option){
						$option["parent"]='group_theme_settings';
						if($this->optional){
							$option['conditional_logic']= array (
								array (
									array (
										'field' => 'enable_'.$this->slug,
										'operator' => '==',
										'value' => '1',
									),
								),
							);
						}
						acf_add_local_field($option);
							
						
					}
				}

			}
		}
		
		public function setCustomEditForm(){
			global $post;
			if ($post->post_type == $this->slug ) {
				if($this->editForm && isset($this->editForm["custom_content"])){
					$filepath=$this->getTemplatesPath().$this->editForm["custom_content"];
					if(file_exists($filepath)){
						include($filepath);
					}
				}
			}
		}
		
		public function setEditFormTitle() {
			global $post, $title, $action, $current_screen;
			if( isset( $current_screen->post_type ) && $current_screen->post_type == $this->slug && $action == 'edit' ){
				if($this->editForm && isset($this->editForm["title"])){
					if(is_callable ($this->editForm["title"])){
						$title = call_user_func_array($this->editForm["title"],array($post));
					}else{
						$title = $this->editForm["title"];
					}
				}
			}
				
		}
		
		public function includeAdminScripts($hook){
			global $post;
			
			if(!$post) return;
			if ($post->post_type == $this->slug && (($hook=='post.php' && $_GET["action"]=="edit") || $hook=='post-new.php') ) {
				
				if($this->adminstyles){
					foreach($this->adminstyles as $style){
						_dump(get_template_directory_uri() . '/posttypes/posttypes/'.$this->slug.'/assets/style/'.$style.'.css');
						wp_register_style( 'carrot_wp_'.$style, get_template_directory_uri() . '/posttypes/posttypes/'.$this->slug.'/assets/style/'.$style.'.css', false, '1.0.0' );
						wp_enqueue_style( 'carrot_wp_'.$style );

					}
				}
				
				if($this->adminscripts){
					foreach($this->adminscripts as $script){
						wp_enqueue_script( 'carrot_wp_'.$script, get_template_directory_uri() . '/posttypes/posttypes/'.$this->slug.'/assets/js/'.$script.'.js' , array( 'jquery' ), '1.0', true);
					}
				}
				
	
				
			}
			
			if ( 'edit.php' === $hook && isset( $_GET['post_type'] ) &&	$this->slug === $_GET['post_type'] ) {

				wp_enqueue_script( 'carrot_wp_quick_edit', get_template_directory_uri() .'/assets/js/theme-admin-quickedit.js', array( 'jquery' ), '1.0', true);

			}
		
		}
		
		public function includeScripts(){
			
			if($this->styles){
				foreach($this->styles as $style){
					wp_register_style( 'carrot_wp_'.$style, get_template_directory_uri() . '/posttypes/posttypes/'.$this->slug.'/assets/style/'.$style.'.css', false, '1.0.0' );
					wp_enqueue_style( 'carrot_wp_'.$style );

				}
			}
			
			if($this->scripts){
				foreach($this->scripts as $script){
					wp_enqueue_script( 'carrot_wp_'.$script, get_template_directory_uri() . '/posttypes/posttypes/'.$this->slug.'/assets/js/'.$script.'.js' , array( 'jquery' ), '1.0', true);
				}
			}
				
	
				
			
		
		}
		

		
		
		
		function registerColumns($columns) {
			if($this->columns){
				foreach($this->columns as $key=>$column){
					$columns[$key] = $column["title"];
				}
			}
			return $columns;
		}
		
		function setColumnsContent($column_name, $id) {
			if($this->columns){
				if(isset($this->columns[$column_name])){
					$col=$this->columns[$column_name];
					$content=$col["content"];
					echo call_user_func_array($content,array($column_name, $id));
				}
			}
			return;
		}
	

		/*
		 * BOOKS - COLUMN SORTING - MAKE HEADERS SORTABLE
		 */
		function setColumnsSortable($columns) {
			if($this->columns){
				foreach($this->columns as $key=>$column){
					if($column["sortable"]) $columns[$key] = $key;
				}
			}
			return $columns;
		}

		/*
		 * BOOKS - COLUMN SORTING - ORDERBY
		 */
		function setColumnsSortingFunction( $query ) {
			if( ! is_admin() ) return;
			if(!$this->columns) return;
			if(count($this->columns)==0) return;
			
			$orderby = $query->get('orderby');
			//_dump($orderby);
			if(!is_array($orderby)){
				if(isset($this->columns[$orderby])){
					$query->set('meta_key',$this->columns[$orderby]["sort_field"]);
					$query->set('orderby',$this->columns[$orderby]["sort_type"]);
				}
			}
			
		}

		function getTemplatesPath(){
			return THEME_PATH."/posttypes/posttypes/".$this->slug."/templates/";
			
		}
		function getSingleTemplates($enableempty=false){	
			$path=$this->getTemplatesPath()."single/";
			
			$ret=array();
			
			if(!is_dir($path)) return $ret;
			
			$files=scandir($path);
			
			if($enableempty) $ret[""]=__("--Default site template--", THEME_NAME);
			
			if($files){
				//_dump($files);
				foreach ($files as $file) {
					$filepath=$path.$file;
					//_dump($filepath);
					if (!is_dir($filepath)){
						$extension = pathinfo($file, PATHINFO_EXTENSION);
						$name = pathinfo($file, PATHINFO_FILENAME);
						if($extension=="php" && file_exists($filepath)){

							$headers=get_file_data($filepath,array("Template Name"));
							if($headers){
								$ret[$name]=$headers[0]; 
							}else{
								$ret[$name]=$name; 
							}	

						}
					}
					
				}
			}
			return $ret;

		}


		
		
	}

	function get_posttype_template_part($type,$template, $args=false){
		$path=THEME_PATH."/posttypes/posttypes/".$type."/templates/".$template.".php"; 
		
		if(file_exists($path)){
			if($args){
				if(is_array($args)){
					foreach ( $args as $key => $value ) { $$key = $value; }
				}
			}
			//_dump($path);
			include $path;
		}
	}

	function carrot_posttype_title_is_visible($posttype){
		//_dump('single_'.$posttype.'_show_title');
		return _o('single_'.$posttype.'_show_title');
		
	}

	function carrot_posttype_breadcrumb_is_visible($posttype){
		//_dump('single_'.$posttype.'_show_breadcrumb');
		return _o('single_'.$posttype.'_show_breadcrumb');
	}
