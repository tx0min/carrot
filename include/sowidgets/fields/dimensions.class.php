<?php

class Carrot_Custom_Field_Dimensions extends SiteOrigin_Widget_Field_Base {
    
	
	 protected function get_input_classes() {
        $input_classes = parent::get_input_classes();
        $input_classes[] = 'carrot-widget-input-dimensions';
        return $input_classes;
    }

    public function enqueue_scripts() {
		wp_enqueue_script('carrot-dimensions-field-script', CARROT_SO_WIDGETS_URI . '/fields/js/dimensions.js', array('jquery'));
		wp_enqueue_style('carrot-dimensions-field-style', CARROT_SO_WIDGETS_URI . '/fields/css/dimensions.css');
		
    }
	
	protected function render_field( $value, $instance ) {
		$valores=array("","","","");
		if(!$value) $value="0px";
		
		$vals=explode(" ",$value);
		$checked=false;
		$units="";
		
		$dimunits=array("px","%","in","cm","mm","em","ex","pt","pc","rem");
		
		if(is_array($vals) && count($vals)==4){
			
			foreach($vals as $i=>$val){
				$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$val);                                                               
				$units=$arr[1];
				$valores[$i]=$arr[0];
			}
			$checked=false;	
		}else{
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$value);                                                               
			$units=$arr[1];
			$valores[0]=$arr[0];
			$checked=true;	
		}
		
		
	?>
		<script type="text/javascript">
			initDimensions('#dimensions-<?=$this->element_id?>');
		</script>
		<div class="dimensions-container" id="dimensions-<?=$this->element_id?>">
			<table class="dimensions-table">
				<tr>	
					<th><?=__("Top",THEME_NAME)?></th>
					<th><?=__("Right",THEME_NAME)?></th>
					<th><?=__("Bottom",THEME_NAME)?></th>
					<th><?=__("Left",THEME_NAME)?></th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
				<tr>
					<td><input type="text" value="<?=$valores[0]?>" class="top siteorigin-widget-input dimension"></td>
					<td><input type="text" value="<?=$valores[1]?>" class="right siteorigin-widget-input dimension"></td>
					<td><input type="text" value="<?=$valores[2]?>" class="bottom siteorigin-widget-input dimension"></td>
					<td><input type="text" value="<?=$valores[3]?>" class="left siteorigin-widget-input dimension"></td>
					<td>
						<select class="dimension-units" >
							<?php foreach($dimunits as $u){ ?>
								<option value="<?=$u?>" <?=$u==$units?"selected":""?>><?=$u?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="text" readonly="true" name="<?php echo esc_attr( $this->element_name ) ?>" value="<?php echo esc_attr( $value ) ?>" class="dimension-final-input siteorigin-widget-input" />
						<div class="dimensions-check-container">
							<label for="dimensions-same-<?=$this->element_id?>"> <input type="checkbox" <?=$checked?"checked":""?> class="dimensions-same" id="dimensions-same-<?=$this->element_id?>"> <?=__("Apply the same value to all?",THEME_NAME)?></label>
						</div>
					</td>
				</tr>
			</table>
			
		</div>
	<?php
	
	}

	
	
	protected function sanitize_field_input( $value, $instance ) {
		$sanitized_value = $value;
		
		
		return $sanitized_value;
		
	}
		
}