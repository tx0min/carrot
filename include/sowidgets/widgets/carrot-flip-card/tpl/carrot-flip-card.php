<?php

	$this->carrot_widget_header($instance);
	
	
	
	$card_classes=array("flip-card");
	$card_classes[]=$flip_effect;
	
	$front_classes=array("front-side");
	$back_classes=array("back-side");
	
	if(!preg_match('|^#|', $front_bgcolor)) $front_classes[]="bg-".$front_bgcolor;
	if(!preg_match('|^#|', $back_bgcolor)) $back_classes[]="bg-".$back_bgcolor;
			
?>
<div class="<?=implode(" ",$card_classes)?>">
	<div class="<?=implode(" ",$front_classes)?>">
		<div class="side-content">
			<div class="content-wrap">
				<?php echo $front_content;?>
			</div>
		</div>
	</div>
	<div class="<?=implode(" ",$back_classes)?>">
		<div class="side-content">
			<div class="content-wrap">
				<?php echo $back_content;?>
			</div>
		</div>
	</div>
</div>
<?php	
	

	$this->carrot_widget_footer($instance);
?>