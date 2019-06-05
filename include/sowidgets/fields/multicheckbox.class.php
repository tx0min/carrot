<?php

class Carrot_Custom_Field_Multicheckbox extends SiteOrigin_Widget_Field_Base {
    
	protected $options;
	protected $multiple;
	protected $orientation;
	

	protected function get_input_classes() {
        $input_classes = parent::get_input_classes();
		$input_classes[] = 'carrot-widget-input-multicheckbox';
        return $input_classes;
    }

    public function enqueue_scripts() {

        /* load jQuery-ui datepicker */
		wp_enqueue_script('carrot-multicheckbox-field-script', CARROT_SO_WIDGETS_URI . '/fields/js/multicheckbox.js', array('jquery'));
		wp_enqueue_style('carrot-multicheckbox-field-style', CARROT_SO_WIDGETS_URI . '/fields/css/multicheckbox.css');
		
    }
	
	protected function render_field( $value, $instance ) {
		$or="";
		//_dump($this->options);
		if(isset($this->orientation) && in_array($this->orientation,array("vertical","horizontal"))) $or=$this->orientation;
	?>
		<script type="text/javascript">
			initMulticheckbox('#multicheckbox-<?=$this->element_id?>');
		</script>
		<div class="multicheckbox-field clearfix <?=$or?>" id="multicheckbox-<?=$this->element_id?>">
			<ul>
			<?php if( isset( $this->options ) && !empty( $this->options ) ) : ?>
				<?php foreach( $this->options as $key => $val ) : ?>
					<?php
						if( is_array( $value ) ) {
							$selected = selected( true, in_array( $key, $value ), false );
						}
						else {
							$selected = selected( $key, $value, false );
						} 
					?>
					<li>
						<label for="check-<?=$this->element_id?>-<?=esc_attr( $key )?>"><input type="checkbox"  id="check-<?=$this->element_id?>-<?=esc_attr( $key )?>" value="<?php echo esc_attr( $key ) ?>" <?=$selected?"checked":""?> ><?php echo esc_html( $val ) ?></label>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
			
			</ul>
			<input type="hidden" readonly="true" name="<?php echo esc_attr( $this->element_name ) ?>" value='<?=json_encode( $value )?>' class="siteorigin-widget-multicheckbox siteorigin-widget-input" />
		</div>
	<?php
	
	}

	
	
	protected function sanitize_field_input( $value, $instance ) {
		
		$values = json_decode($value);
		
		return $values;
		
	}
		
}