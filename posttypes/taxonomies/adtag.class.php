<?php

	class ADTag extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Banner Tag";
			$this->slug = "banner-tag";
			
			
			$this->labels = array(
				"name" => __( 'Banner Tags', THEME_NAME ),
				"singular_name" => __( 'Banner Tag', THEME_NAME ),
				"add_new" => __( 'New Banner Tag', THEME_NAME ),
				"add_new" => __( 'New Banner Tag', THEME_NAME ),
				"add_new_item" => __( 'Add new Banner Tag', THEME_NAME ),
				"edit_item" => __( 'Edit Banner Tag', THEME_NAME ),
			);
			
			/*cpt*/
			$this->hierarchical=false;		
			
			
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	