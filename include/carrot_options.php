<?php

class CarrotSettingsPage
{

    private $options;


    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

	
	/**
		add menu pages
	*/
    public function add_plugin_page()
    {
        
		add_menu_page(
			__('Carrot',THEME_NAME),
			__('Carrot',THEME_NAME),
			'manage_options', 
			'carrot_theme_settings', 
			array( $this, 'main_page' ), //page function
			'dashicons-carrot', 
			3
		);
		
		add_submenu_page( 
			'carrot_theme_settings',  //parent
			__('Developer',THEME_NAME), 
			__('Developer',THEME_NAME), 
			'manage_options', 
			'developer', 
			array( $this, 'developer_page')
		);
		
		
		
    }
	

	private function show_carrot_header(){
		$theme=wp_get_theme();
		
?>
	<h1><div class="dashicons dashicons-before dashicons-carrot"></div> <?=$theme->name?> <small>v<?=$theme->version?></small></h1>
<?php	
	}
	
	
	
	private function show_developer_menu($current){
?>
	<div class="subheader">
		<ul class="subsubsub">
			<li><a href="?page=developer&tab=shortcodes" class="<?=$current=="shortcodes"?"current":""?>"><?=__("Shortcodes",THEME_NAME)?></a> | </li>
			<li><a href="?page=developer&tab=options" class="<?=$current=="options"?"current":""?>"><?=__("Options",THEME_NAME)?></a> | </li>
			<li><a href="?page=developer&tab=customizer" class="<?=$current=="customizer"?"current":""?>"><?=__("Customizer",THEME_NAME)?></a>  </li>
		</ul>
	</div>
<?php	
	}
	
	
	
    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'carrot_option_group', // Option group
            'carrot_preset'
           // array( $this, 'sanitize' ) // Sanitize

        );

        /*add_settings_section(
            'carrot_settings_section', // ID
            'Carrot Global Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'carrot_settings' // Page
        );  */
		
		/*add_settings_field(
            'preset', 
            'Style Preset', 
            array( $this, 'style_preset_callback' ), 
            'carrot_settings', 
            'carrot_settings_section'
        );      */
    }


    public function main_page()
    {
        $theme=wp_get_theme();
		// Set class property
        $selected_preset = get_option( 'carrot_preset' );
		
		
     ?>
        <div class="wrap carrot_page">
            <?php $this->show_carrot_header(); ?>
			
			<div class="inner">
				
				<?php _e("Welcome to Carrot! Enjoy :)",THEME_NAME); ?>
				<form method="post" action="options.php">
					<?php
						// This prints out all hidden setting fields
						settings_fields( 'carrot_option_group' );
						//do_settings_sections( 'carrot_settings' );
						
						$style_presets= carrot_get_presets();
						
						//_dump($selected_preset);
						if(!$style_presets) return;
					?>
							<!--select name="carrot_preset" id="carrot_preset"-->
					
					<ul class="presets">
					<?php
						foreach($style_presets as $preset){
							$style="";
							if(isset($preset->defaults["primary_color"])) $style.="background-color:".$preset->defaults["primary_color"].";";
							if(isset($preset->defaults["primary_text_color"])) $style.="color:".$preset->defaults["primary_text_color"].";";
							
							
					?>
							<li  class="<?=($selected_preset==$preset->slug)?"selected":""?>" style="<?=$style?>">
								<input type="radio" id="carrot_preset_<?=$preset->slug?>" name="carrot_preset"  value="<?=$preset->slug?>" <?=($selected_preset==$preset->slug)?"checked":""?>/>
								<?=$preset->name?>
							</li>
					<?php			
						}
					?>
					</ul>
					<!--/select-->
				<?php	
						submit_button();
					?>
				</form>
			</div>
        </div>
        <?php
    }
	
	
	public function customizer_page(){
		global $carrotthemeoptions;
		
		function print_section_fields($section){
			if(array_key_exists("fields", $section)){
				
		?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th width="10%"><strong><?=__("Slug",THEME_NAME)?></strong></th>
						<th width="20%"><strong><?=__("Label",THEME_NAME)?></strong></th>
						<th width="5%"><strong><?=__("Type",THEME_NAME)?></strong></th>
						<th width="25%"><strong><?=__("Options",THEME_NAME)?></strong></th>
						<th width="10%"><strong><?=__("Default",THEME_NAME)?></strong></th>
						<th width="10%"><strong><?=__("Value",THEME_NAME)?></strong></th>
						<th width="20%"><strong><?=__("Code",THEME_NAME)?></strong></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach($section["fields"] as $fieldslug=>$field){
				?>
					<tr>
						<td><code><?=$fieldslug?></code></td>
						<td><?=$field["label"]?></td>
						<td><?=$field["type"]?></td>
						<td>
							<?php
								if(array_key_exists("choices", $field)){
							?>
								<table class="wp-list-table widefat fixed striped">
									<thead>
										<tr>
											<td width="15%"><strong><?=__("Name",THEME_NAME)?></strong></td>
											<td width="30%"><strong><?=__("Label",THEME_NAME)?></strong></td>
										</tr>
									</thead>
									<tbody>
									<?php
										foreach($field["choices"] as $choiceslug=>$choice){
									?>
										
											<tr>
												<td><?=$choiceslug?></td>
												<td><?=$choice?></td>
											</tr>
											
									<?php 
										}
									?>
									</tbody>
								</table>
							<?php	
								}
							?>
						</td>
						<td>
							<?php 
								$val=isset($field["default"])?$field["default"]:"";
								if(is_array($val) || is_object($val)){
									_dump($val);
									
								}else{
									echo $val;
								}
							?>
						</td>
						<td>
							<?php 
								$val=_o($fieldslug);
								if(is_array($val) || is_object($val)){
									_dump($val);
								}else{
									echo $val;
								}
								
								switch($field["type"]){
									case "kirki-icons": $func="_icon";break;
									case "image": $func="_img";break;
									case "color": $func="_color";break;
									default : $func="_o";break;
								}
							?>
						</td>
						<td><?="<code>".htmlspecialchars($func."(\"".$fieldslug."\");")."</code>"?></td>
						
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		<?php 
			}
		}
		//_dump($carrotthemeoptions);
?>
				
		<div class="nav-tab-wrapper wp-clearfix">
		
			<?php
				$i=0;
				foreach($carrotthemeoptions as $slug=>$section){
					$title=$slug;
					if(array_key_exists("title", $section)) $title=$section["title"];
					
						
			?>
						<a href="#tab-<?=$slug?>" class="nav-tab <?=$i==0?"nav-tab-active":""?>"><?=$title?></a>
			<?php		
					
					$i++;
				}
			?>
		</div>
				
		<div class="tabs metabox-holder">
			<?php
				$i=0;
				foreach($carrotthemeoptions as $slug=>$section){
					$title=$slug;
					if(array_key_exists("title", $section)) $title=$section["title"];		
						
			?>
					<div class="tab  <?=$i==0?"tab-active":""?>" id="tab-<?=$slug?>">
						<div class="postbox">
							<h2 class="hndle "><span><?=$title?></span></h2>
							<div class="main">
								<?php 
									print_section_fields($section);
									if(array_key_exists("children", $section)){
										foreach($section["children"] as $childrenslug=>$childsection){	
								?>
											<div class="inside">
												<h4><?=$childsection["title"]?></h4>
												<?php print_section_fields($childsection); ?>
											</div>
								<?php
										}
									}
								?>
							</div>
						</div>
					</div>
			<?php		
					
					$i++;
				}
				
				/*
					if(array_key_exists("fields", $section) && count($section["fields"])>0){
						foreach($section["fields"] as $field
						
						}
					}
				*/
			?>
		</div>
<?php		
	}
	
	
	
	public function show_options_page(){
		$post_types = get_post_types(array(),'objects'); 
		
		
		function print_groups($groups,$global=false){
			if(!$groups) return;
			if(count($groups)<=0) return;
			
			foreach($groups as $group){
?>
				<div class="postbox">
					<h2 class="hndle "><span><?=$group["title"]?></span></h2>
					<div class="">
						<div class="main">
							<table class="wp-list-table widefat fixed striped">
								<thead>
									<tr>
										<td width="15%"><strong><?=__("Name",THEME_NAME)?></strong></td>
										<td width="20%"><strong><?=__("Label",THEME_NAME)?></strong></td>
										<td width="15%"><strong><?=__("Type",THEME_NAME)?></strong></td>
										<td><strong><?=__("Code",THEME_NAME)?></td>
									</tr>
								</thead>
								<tbody>
									<?php 
										$fields = acf_get_fields($group["key"]);
										foreach($fields as $field){
											$istab=$field["type"]=="tab";
									?>	
										<tr>
											<?php if($istab){ ?>
												<th class="tdheader" colspan="4"><?=$field["label"]?></th>
												
											<?php }else{ ?>
												<td>
													<code><?=$field["name"]?></code>
												</td>
												<td><?=$field["label"]?></td>
												<td><?=$field["type"]?></td>
												<td>
													<code>
														<?php 
															if($global){ 
																echo htmlspecialchars("opt(\"".$field["name"]."\")");
															}else{
																echo htmlspecialchars("gf(\"".$field["name"]."\")");
															}
														
														?>
													</code>
												</td>
											<?php } ?>
											
											
										</tr>
										
										<?php 
											if($field["type"]=="repeater"){ 
										?>
											<tr class="subtable">
												<th><strong><?=__("Subfields",THEME_NAME)?></strong></th>
												<td colspan="3">
													<table class="wp-list-table widefat fixed striped">
														<thead>
															<tr>
																<td width="15%"><strong><?=__("Name",THEME_NAME)?></strong></td>
																<td width="30%"><strong><?=__("Label",THEME_NAME)?></strong></td>
																<td width=""><strong><?=__("Type",THEME_NAME)?></strong></td>
															</tr>
														</thead>
														<tbody>
													<?php
															foreach($field["sub_fields"] as $subfield){
																$subhascode=$subfield["type"]!="tab";
														?>
															
																<tr>
																	<td>
																		<?php if($subhascode) { ?>
																			<code><?=$subfield["name"]?></code>
																		<?php } ?>
																	</td>
																	<td><?=$subfield["label"]?></td>
																	<td><?=$subfield["type"]?></td>
																</tr>
															
													<?php 
															} 
													?>
														</tbody>
													</table>
												</td>
											</tr>
										<?php
											} 
										?>
										
										
										<?php 
											if($field["type"]=="select"){ 
										?>
											<tr class="subtable">
												<th ><strong><?=__("Options",THEME_NAME)?></strong></th>
												<td colspan="3">
													<table class="wp-list-table widefat striped">
														<tbody>
													<?php
															foreach($field["choices"] as $val=>$option){
																
														?>
															
																<tr>
																	<td width="15%"><code><?=$val?></code></td>
																	<td><?=$option?></td>
																	
																</tr>
															
													<?php 
															} 
													?>
														</tbody>
													</table>
												</td>
											</tr>
										<?php
											} 
										?>
										
									<?php 
										} 
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
<?php
			 }
		}
		
		
?>
						
		<div class="nav-tab-wrapper wp-clearfix">
			<a href="#tab-global" class="nav-tab nav-tab-active"><?=__("Global",THEME_NAME)?></a>
			<?php
				$i=0;
				foreach($post_types as $slug=>$type){
					$groups = acf_get_field_groups(array('post_type' => $slug));
					
					if(count($groups)>0){
			?>
						<a href="#tab-<?=$slug?>" class="nav-tab "><?=$type->label?></a>
			<?php		
					}
					$i++;
				}
			?>
		</div>
			
		<div class="tabs metabox-holder">
			
			<div class="tab tab-active " id="tab-global">
				<?php
					$groups = acf_get_field_groups(array('options_page' => 'theme-options'));
					print_groups($groups,true);
					
				?>
			</div>
			<?php
				$i=0;
				foreach($post_types as $slug=>$type){
					$groups = acf_get_field_groups(array('post_type' => $slug));
					if(count($groups)>0){
			?>

				<div class="tab  " id="tab-<?=$slug?>">
						
					<?php print_groups($groups);?>
								
				</div>
			<?php			
					}
					$i++;
				 }
			?>
	
		</div>
<?php
	}
	
	
	
	public function shortcodes_page(){
		global $shortcode_tags;
		
?>
	<div class="postbox">
		<h2 class="hndle "><span><?=__("Shortcodes",THEME_NAME)?></span></h2>
		<div class="main">
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<td><strong><?=__("Name",THEME_NAME)?></strong></td>
					</tr>
				</thead>
				<tbody>
<?php

	foreach($shortcode_tags as $code => $function)
	{
		?>
			<tr><td>[<?php echo $code; ?>]</td></tr>
		<?php
	}
?>

				</tbody>
			</table>
		</div>
	</div>
<?php
	}
	
	
	
	
	public function developer_page(){
		
		$theme=wp_get_theme();
		$tab=isset($_GET['tab'])?$_GET['tab']:"shortcodes";
		
		
?>
		<div class="wrap carrot_page">
			<div class="metabox-holder">
				<?php $this->show_carrot_header(); ?>
			
				<?php 
				
					$this->show_developer_menu($tab);
					
					switch($tab){
						case "shortcodes": 
							$this->shortcodes_page();	
							break;
						case "options": 
							$this->show_options_page();	
							break;	
						case "customizer": 
							$this->customizer_page();	
							break;
						default:break;
					}
				?>

			</div>
		</div>
		<?php
	}


	 /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        //$new_input = array();
		//_dump($input);
		//die();
        //if( isset( $input['carrot_preset'] ) )
           // $new_input['carrot_preset'] = absint( $input['id_number'] );


       // return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        _e("Choose a style preset", THEME_NAME);
    }

    	
	

	
}

if( is_admin() )
    $carrot_settings_page = new CarrotSettingsPage();