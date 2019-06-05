<?php

if (!class_exists('CarrotPreset')):
	
	define ("CARROT_PRESETS_BASE_URI", THEME_URI .'/presets/');
	
	class CarrotPreset {
		
		
		public $slug;
		public $name;
		public $description;
		public $author;
		public $styles;
		public $scripts;
		public $defaults;
		public $customizerelements;
		
		
		protected function includeAll() {
			$this->includeStyles();
			$this->includeScripts();
		}
		
		protected function includeStyles() {
			if($this->styles && is_array($this->styles)){
				foreach($this->styles as $i=>$style){
					wp_enqueue_style( 'preset-'. $this->slug.'-style-'.$i, CARROT_PRESETS_BASE_URI. $this->slug.'/assets/style/'.$style );
				}
			}
		}
		
		protected function includeScripts() {
			if($this->scripts && is_array($this->scripts)){
				foreach($this->scripts as $i=>$script){
					wp_enqueue_script( 'preset-'.$this->slug.'-scripts-'.$i, CARROT_PRESETS_BASE_URI .$this->slug.'/assets/js/'.$script );
				}
			}
		}
		
		function register(){
			 $this->includeAll();//add_action( 'carrot_after_include_scripts',array( $this, 'includeAll' ) );
		}
				

		function __construct($slug="", $name="", $defaults=false) {
			$this->styles=array();
			$this->scripts=array();
			$this->slug=$slug;
			$this->name=$name;
			$this->defaults=$defaults;
			$this->customizerelements=array();
			if(!$defaults) $defaults=array();

		}
		
	
	}
	
endif;