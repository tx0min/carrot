<?php

	class PerformanceTag extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Performance Tag";
			$this->slug = "performance-tag";
			
			
			$this->labels = array(
				"name" => __( 'Performance Tags', THEME_NAME ),
				"singular_name" => __( 'Performance Tag', THEME_NAME ),
				"add_new" => __( 'New Performance Tag', THEME_NAME ),
				"add_new" => __( 'New Performance Tag', THEME_NAME ),
				"add_new_item" => __( 'Add new Performance Tag', THEME_NAME ),
				"edit_item" => __( 'Edit Performance Tag', THEME_NAME ),
			);
			
			/*cpt*/
			$this->hierarchical=false;		
			
			
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	