<?php

	class ADType extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Banner Type";
			$this->slug = "banner-type";
			
			
			$this->labels = array(
				"name" => __( 'Banner Types', THEME_NAME ),
				"singular_name" => __( 'Banner Type', THEME_NAME ),
				"add_new" => __( 'New Banner Type', THEME_NAME ),
				"add_new" => __( 'New Banner Type', THEME_NAME ),
				"add_new_item" => __( 'Add new Banner Type', THEME_NAME ),
				"edit_item" => __( 'Edit Banner Type', THEME_NAME ),
			);
			
			/*cpt*/
						
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	