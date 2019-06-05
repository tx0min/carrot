<?php

	class Block extends CustomPostType{
		
		public function __construct() {
			parent::__construct();
		
			$this->name = "Block";
			$this->slug = "block";
			
			
			$this->labels = array(
				"name" => __( 'Blocks', THEME_NAME ),
				"singular_name" => __( 'Block', THEME_NAME ),
				"add_new" => __( 'New block', THEME_NAME ),
				"add_new_item" => __( 'Add new block', THEME_NAME ),
				"edit_item" => __( 'Edit block', THEME_NAME ),
			);
			
			/*cpt*/
			$this->menu_icon = "dashicons-editor-insertmore";		
			$this->supports = array( "title","editor","revisions"); 
			$this->optional = false;
			$this->enabled = true;
						
			/*acf options*/
			$this->fields = array ();
			
			$this->styles=array("blocks");
		
			
			
		}
		



	}
	
	
	