<?php

	$this->carrot_widget_header($instance);
	
	//$blockid
	//carrot_include_block($blockid);
	$vars=$this->get_template_variables( $instance );
	
	
?>
	<div class="carrot-files" >
		<?php if($heading_text){ ?>
		<header><?=$heading_text?></header>
		<?php } ?>
<?php
	if($files){
?>
	<ul>
<?php		
		foreach($files as $file){
			$url=carrot_get_file_url($file);
			if($url){
				
?>
		<li>
			<span class="file-icon"><a href="<?=$url?>"><?php carrot_file_icon($vars,$file); ?></a></span>
			<div class="file-info">
				<span class="file-name"><a href="<?=$url?>"><?=$file["file_name"]?></a></span>
				<?php
					if($show_filesize){
				?>	
					<span class="file-size"><?php carrot_file_size($file);?></span>
				<?php
					}
				?>
				<?php
					if($file["file_description"]){
				?>	
					<span class="file-description"><?=$file["file_description"]?></span>
				<?php
					}
				?>
				<?php
					if($file["file_alt_url"]){
				?>	
					<span class="file-alt-url"><a href="<?=$file["file_alt_url"]?>" rel="nofollow" target="_blank"><?=__("Referer",THEME_NAME)?></a></span>
				<?php
					}
				?>
			</div>
			
		</li>
<?php
			}
			
			
		}
?>
	</ul>
<?php
	}
?>
	</div>
<?php
	$this->carrot_widget_footer($instance);
