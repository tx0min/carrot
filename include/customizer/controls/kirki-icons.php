<?php
/**
 * The custom control class
 * Class Name must be equal to the type name in camelcase withouth the score
 */

	class KirkiIcons_Control extends WP_Customize_Control  {
		

		public $type = 'kirki-icons';
		public $families = array();
		


		public function __construct( $manager, $id, $args = array() ) {
			if(function_exists('siteorigin_widgets_icon_families_filter')){
				$this->families=apply_filters('siteorigin_widgets_icon_families', array() );
			}
			
			parent::__construct( $manager, $id, $args );
		}

		public function enqueue() {
			wp_enqueue_script( 'kirki-icons',THEME_URI . '/assets/js/kirki-icons.js', array( 'jquery','customize-preview' ) );
			wp_enqueue_style( 'kirki-icons', THEME_URI .'/assets/style/kirki-icons.css' );
			//wp_enqueue_style( 'siteorigin-icons', plugin_dir_url() .'/so-widgets-bundle/base/inc/fields/css/icon-field.css' );
			if(function_exists('siteorigin_widgets_icon_families_filter')){
				//$families=apply_filters('siteorigin_widgets_icon_families', array() );
				//$families=siteorigin_widgets_icon_families_filter();
				foreach($this->families as $familyname=>$family){
					wp_enqueue_style( 'siteorigin-icons-'.$familyname, $family["style_uri"] );

			

				}
			}

		}	

		public function to_json() {
			parent::to_json();
			//_dump($this);
			$this->json['defaultValue'] = $this->setting->default;
			//$this->json['families'] = $this->families;
		}
		
		public function render_content() { }


		protected function content_template() {
			
			 
	?>

				<# 
					var defaultValue = '';
					if ( data.defaultValue ) {
					
						defaultValue = ' data-default-value=' + data.defaultValue; // Quotes added automatically.
					}
					
					var theval = '';
					if(data.value){
						theval=data.value;
					}else{
						theval=data.defaultValue;
					}
				#>

			


			<label>
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{{ data.label }}}</span>
				<# } #>
				<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
				
				<span class="kirki-icon-preview"></span>
				<div class="control-reset">
					<span class="dashicons dashicons-image-rotate"></span>
				</div>
						
				<div class="customize-control-content icons-container">
					
					<div class="kirki-icons-container siteorigin-widget-form">
						<div class="siteorigin-widget-field-type-icon">
							<div class="kirki-icons-form-container">
								<select class="siteorigin-widget-icon-family">
									<?php foreach($this->families as $familyname=>$family){ ?>
										<option value="<?=$familyname?>"><?=$family["name"]?> (<?=count($family["icons"])?>)</option>
									<?php } ?>

								</select>
								<input type="text" class="kirki-icons-search" placeholder="<?=__("Search icons...",THEME_NAME)?>" />
							</div>
							<div class="siteorigin-widget-icon-selector">
								<?php
									$i=0;
									foreach($this->families as $familyname=>$family){
												
								?>
								
									
									<div class="siteorigin-widget-icon-icons <?=($i==0)?"active":""?> <?=$familyname?>" data-family="<?=$familyname?>">
								<?php
											if(isset($family["icons"])){
												foreach($family["icons"] as $iconname=>$icon){
													echo '<div data-sow-icon="'.$icon.'" data-value="'.$familyname.'-'.$iconname.'" class="sow-icon-'.$familyname.' siteorigin-widget-icon-icons-icon"></div>';
												}
											}
								?>
									</div>
								
								<?php
										$i++;

									}

								?>
						
							</div>		
						</div>
					</div>
					
				</div>
				<input class='the-value' autocomplete='off' type="hidden" {{{ data.link }}} value="{{ theval }}"  {{ defaultValue }} />


			</label>
			<?php
			}


	}//end class
