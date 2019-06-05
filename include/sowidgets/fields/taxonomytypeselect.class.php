<?php

/**
 * Class Carrot_Custom_Field_Taxanomyselect
 */
class Carrot_Custom_Field_Taxonomytypeselect extends SiteOrigin_Widget_Field_Text_Input_Base {
    
	protected $multiple;
	protected $required;
	

	protected function get_input_classes() {
        $input_classes = parent::get_input_classes();
		$input_classes[] = 'carrot-widget-input-taxonomytype';
        return $input_classes;
    }

    public function enqueue_scripts() {

        /* load jQuery-ui datepicker */
		//wp_enqueue_script('carrot-taxonomy-field-script', CARROT_SO_WIDGETS_URI . '/fields/js/taxonomy.js', array('jquery'));
		//wp_enqueue_style('carrot-taxonomy-field-style', CARROT_SO_WIDGETS_URI . '/fields/css/taxonomy.css');
		
    }
	protected function render_field( $value, $instance ) {
		
		
		//_dump($value);
		$taxonomies=get_taxonomies(array(),'objects'); 
		

		
		if(is_array($taxonomies)){
	?>

		<div class="taxonomy-type-field clearfix " id="taxonomy-type-<?=$this->element_id?>">
			
			<select <?=$this->multiple?"multiple":""?> name="<?php echo esc_attr( $this->element_name ) ?>" class="siteorigin-widget-taxonomy-type siteorigin-widget-input" >
				
				<?php if(!$this->required){ ?>
					<option value="">--</option>
				<?php } ?>

				<?php
					foreach($taxonomies as $key=>$taxonomy){
						$name=$taxonomy->labels->name;
						$selected=false;
						if($value){
							if(is_array($value)) $selected=in_array($key,$value);
							else $selected=($value==$key);
						}else{
							if($this->required) $selected=($this->default==$key);
						}

				?>
					<option value="<?=$key?>" <?=$selected?"selected":""?>><?=$name?></option>
				<?php
					}
				?>
		
			</select>
		</div>
	<?php
		}
	
	}

	
	
	protected function sanitize_field_input( $value, $instance ) {
		//if(!is_array($value)) $value=array($value);
		return $value;
		
	}
	
	
		
}