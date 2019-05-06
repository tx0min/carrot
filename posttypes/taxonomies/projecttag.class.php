<?php

	class ProjectTag extends CustomTaxonomy{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Project Tag";
			$this->slug = "project-tag";
			
			
			$this->labels = array(
				"name" => __( 'Project Tags', THEME_NAME ),
				"singular_name" => __( 'Project Tag', THEME_NAME ),
				"add_new" => __( 'New Project Tag', THEME_NAME ),
				"add_new" => __( 'New Project Tag', THEME_NAME ),
				"add_new_item" => __( 'Add new Project Tag', THEME_NAME ),
				"edit_item" => __( 'Edit Project Tag', THEME_NAME ),
			);
			
			/*cpt*/
			$this->hierarchical=false;		
			
			
			/*acf options*/
			$this->fields =  array (
				
				
			);
			
			
			
			
			
		}
		



	}
	
	