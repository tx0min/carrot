<?php

	class PerformanceCategory extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Performance Category";
			$this->slug = "performance_category";
			
			
			$this->labels = array(
				"name" => __( 'Performance Categories', THEME_NAME ),
				"singular_name" => __( 'Performance Category', THEME_NAME ),
				"add_new" => __( 'New Performance Category', THEME_NAME ),
				"add_new" => __( 'New Performance Category', THEME_NAME ),
				"add_new_item" => __( 'Add new Performance Category', THEME_NAME ),
				"edit_item" => __( 'Edit Performance Category', THEME_NAME ),
			);
			
			/*cpt*/
						
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	