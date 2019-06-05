<?php

/**
 * Class Carrot_Custom_Field_Taxanomyselect
 */
class Carrot_Custom_Field_Taxonomyselect extends SiteOrigin_Widget_Field_Text_Input_Base {
    
	protected $multiple;
	protected $taxonomy;
	protected $required;
	

	protected function get_input_classes() {
        $input_classes = parent::get_input_classes();
		$input_classes[] = 'carrot-widget-input-taxonomy';
        return $input_classes;
    }

    public function enqueue_scripts() {

        /* load jQuery-ui datepicker */
		//wp_enqueue_script('carrot-taxonomy-field-script', CARROT_SO_WIDGETS_URI . '/fields/js/taxonomy.js', array('jquery'));
		//wp_enqueue_style('carrot-taxonomy-field-style', CARROT_SO_WIDGETS_URI . '/fields/css/taxonomy.css');
		
    }
	protected function render_field( $value, $instance ) {
		
		//_dump($value);
		
		$types=carrot_get_taxonomies($this->taxonomy);
		
		$selected="";
		
		if($value){
			$selected=$value;
		}else{
			if($this->required) $selected=$this->default;
		}
		
		if(is_array($types)){
	?>
		<script type="text/javascript">
			//initMulticheckbox('#multicheckbox-<?=$this->element_id?>');
		</script>
		<div class="taxonomy-field clearfix " id="taxonomy-<?=$this->element_id?>">
			
			<select <?=$this->multiple?"multiple":""?> name="<?php echo esc_attr( $this->element_name ) ?>" class="siteorigin-widget-taxonomy siteorigin-widget-input" >
			<?php if(!$this->required){ ?>
				<option value="">--</option>
			<?php } ?>
			<?php
				foreach($types as $type){
					
			?>
				<option value="<?=$type->slug?>" <?=($selected==$type->slug)?"selected":""?>><?=$type->name?></option>
			<?php
				}
			?>
		
			</select>
		</div>
	<?php
		}
	
	}

	
	
	protected function sanitize_field_input( $value, $instance ) {
		
		//$values = json_decode($value);
		
		return $value;
		
	}
	
	
		
}