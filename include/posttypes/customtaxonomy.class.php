<?php


	class CustomTaxonomy{
		public $fields;
		
		public $name;
		public $slug;
		
		public $labels;
				
		public $is_public;
		public $hierarchical;
		public $show_ui;
		public $query_var;
		public $rewrite;
		public $show_admin_column;
		public $show_in_rest;
		public $rest_base;
		public $show_in_quick_edit;
		
		
		
		
		public function __construct(){
			
			$this->name = "CustomTaxonomy";
			$this->slug = "customtaxonomies";
			
			
			$this->labels = array(
				"name" => __( 'CustomTaxonomies', THEME_NAME ),
				"singular_name" => __( 'CustomTaxonomy', THEME_NAME ),
			);
	
			
			/*cpt options*/
			
			$this->is_public = true;
			$this->hierarchical = true; 
			$this->show_ui = true;
			$this->query_var = true;
			//$this->rewrite = array( 'slug' => $this->slug, 'with_front' => true ),
			$this->show_admin_column = false;
			$this->show_in_rest = true;
			//$this->rest_base = "";
			$this->show_in_quick_edit = false;
			
			
			/*acf options*/
			$this->fields = array();
			

		}
		
		
		
		public function register($posttype){
		
			$this->rewrite = array( "slug" => $this->slug, "with_front" => true );
			$this->rest_base = $this->slug;
			
			
			
			//add_action( 'init', array( $this , 'registerTaxonomy' ));
			$args = array(
				"label" => $this->labels["name"],
				"labels" => $this->labels,
				"public" => $this->is_public,
				"hierarchical" => $this->hierarchical,
				"show_ui" => $this->show_ui,
				"query_var" => $this->query_var,
				"rewrite" => $this->rewrite,
				"show_admin_column" => $this->show_admin_column,
				"show_in_rest" => $this->show_in_rest,
				"rest_base" => $this->rest_base,
				"show_in_quick_edit" => $this->show_in_quick_edit,
			);
		
	
			register_taxonomy( $this->slug, array($posttype), $args );
			
			$this->registerCustomFields();
			//add_action( 'rest_api_init', array($this, 'registerRestFields'));
			
			
		}
	
				
		
		
		
		public function registerCustomFields(){
			if(function_exists('acf_add_local_field_group')){
				if($this->fields){
					foreach($this->fields as $i=>$field){
						if(!isset($field["key"])){
							$this->fields[$i]["key"] = $this->slug."_field_".$field["type"]."_".sanitize_title($field["label"]);
						}
						if(isset($field["sub_fields"])){
							foreach($field["sub_fields"] as $j=>$subfield){
								if(!isset($subfield["key"])){
									$subname=$this->slug."_subfield_".$subfield["type"]."_".sanitize_title($subfield["label"]);
									$this->fields[$i]["sub_fields"][$j]["key"] = $subname;
									
								}
							}
						}
					}
					
					acf_add_local_field_group(
						array (
							'key' => $this->slug.'_group',
							'title' => $this->labels["name"],
							'fields' => $this->fields,
							'location' => array (
								array (
									array (
										'param' => 'taxonomy',
										'operator' => '==',
										'value' => $this->slug,
									),
								),
							),
							'menu_order' => 0,
							'position' => 'normal',
							'style' => 'seamless',
							'label_placement' => 'top',
							'instruction_placement' => 'label',
							'hide_on_screen' => '',
							'active' => 1,
							'description' => '',
						)
					);
				}
				
		
			}
		}
		
		

		
		
	}

	