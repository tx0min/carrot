<?php

	class TestControl_Control extends WP_Customize_Control {
		
		public $type = 'test-control';
		
		
		 public function to_json() {
			parent::to_json();
			//_dump($this->default);
			
			$this->json['defaultValue'] = $this->setting->default;
		}
		
		public function render_content() { }
		
		
		public function enqueue() {
			wp_enqueue_script( 'test-control',THEME_URI . '/assets/js/test-control.js', array( 'jquery','customize-preview' ) );
		
		}
		
		public function content_template() {
			?>
			<# var defaultValue = '';
			if ( data.defaultValue ) {
				
				defaultValue = ' data-default-value=' + data.defaultValue; // Quotes added automatically.
			} #>
			
			<label>
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
				<div class="customize-control-content">
					<input value="{{ data.value }}" {{{ data.link }}} {{ defaultValue }}  type="text" />
					<div class="control-reset">
						<span class="dashicons dashicons-image-rotate"></span>
					</div>
					
					
				</div>
			</label>
			<?php
		}
	}