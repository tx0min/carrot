<?php

	class ProjectCategory extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Project Category";
			$this->slug = "project_category";
			
			
			$this->labels = array(
				"name" => __( 'Project Categories', THEME_NAME ),
				"singular_name" => __( 'Project Category', THEME_NAME ),
				"add_new" => __( 'New Project Category', THEME_NAME ),
				"add_new" => __( 'New Project Category', THEME_NAME ),
				"add_new_item" => __( 'Add new Project Category', THEME_NAME ),
				"edit_item" => __( 'Edit Project Category', THEME_NAME ),
			);
			
			/*cpt*/
						
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	