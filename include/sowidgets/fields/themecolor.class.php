<?php

class Carrot_Custom_Field_Themecolor extends SiteOrigin_Widget_Field_Base {
    
	
	 protected function get_input_classes() {
        $input_classes = parent::get_input_classes();
        $input_classes[] = 'siteorigin-widget-input-color';
		$input_classes[] = 'carrot-widget-input-themecolor';
        return $input_classes;
    }

    public function enqueue_scripts() {

        /* load jQuery-ui datepicker */
		wp_enqueue_script('carrot-theme-color-field-script', CARROT_SO_WIDGETS_URI . '/fields/js/themecolor.js', array('jquery'));
		wp_enqueue_style('carrot-theme-color-field-style', CARROT_SO_WIDGETS_URI . '/fields/css/themecolor.css');
		
    }
	
	protected function render_field( $value, $instance ) {
		
	?>
		<script type="text/javascript">
			initColorSelector('#color-selector-<?=$this->element_id?>');
		</script>
		<div class="themecolor-field clearfix" id="color-selector-<?=$this->element_id?>">
			<ul>
				<li data-value="none" class="transparent <?=($value===false || $value=='none')?"selected":""?>" ><span class="sample" style="background-color:transparent" title="<?=__("Transparent",THEME_NAME)?>"></span></li>
				<li data-value="primary" class="<?=$value=='primary'?"selected":""?>" ><span class="sample" style="background-color:<?=_o('primary_color')?>" title="<?=__("Primary Color",THEME_NAME)?>"></span></li>
				<li data-value="alt" class="<?=$value=='alt'?"selected":""?>"><span class="sample bg-alt" style="background-color:<?=_o('alt_color')?>"title="<?=__("Alternate Color",THEME_NAME)?>"></span></li>
				<li data-value="borders" class="<?=$value=='borders'?"selected":""?>"><span class="sample borders-color" style="background-color:<?=_o('borders_color')?>"title="<?=__("Borders Color",THEME_NAME)?>"></span></li>
				<li data-value="white" class="<?=$value=='white'?"selected":""?>"><span class="sample bg-white" style="background-color:#fff" title="<?=__("White",THEME_NAME)?>"></span></li>
				<li data-value="black" class="<?=$value=='black'?"selected":""?>"><span class="sample bg-black" style="background-color:#000" title="<?=__("Black",THEME_NAME)?>"></span></li>
				<li data-value="custom" class="<?=($value && !in_array($value,array('none','primary','alt','black','white')))?"selected":""?>"><span class="sample bg-custom" title="<?=__("Custom Color",THEME_NAME)?>"></span></li>
			</ul>
		</div>
		<input type="text" name="<?php echo esc_attr( $this->element_name ) ?>" value="<?php echo esc_attr( $value ) ?>" class="siteorigin-widget-themecolor siteorigin-widget-input siteorigin-widget-input-color" />
		<span class="color-description"></span>
	<?php
	
	}

	
	
	protected function sanitize_field_input( $value, $instance ) {
		$sanitized_value = $value;
		
		if(!in_array($sanitized_value,array('none','primary','alt','borders','black','white'))){
			if( ! preg_match('|^#|', $sanitized_value) ) {
				$sanitized_value = '#' . $sanitized_value;
			}
			if ( ! preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $sanitized_value ) ){
				// 3 or 6 hex digits, or the empty string.
				$sanitized_value = false;
			}
		}
		
		return $sanitized_value;
		
	}
		
}