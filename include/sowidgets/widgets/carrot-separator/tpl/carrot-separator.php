<?php

	$this->carrot_widget_header($instance);
	
	$separator_classes=array("separator");
	if(!preg_match('|^#|', $separator_color)) $separator_classes[]="border-".$separator_color;

	$separator_classes[]="align-".$separator_align;
	$separator_classes[]="text-".$separator_icon_size;
	
?>	
	
	<div class="<?=implode(" ",$separator_classes)?>">
		<?php //if($separator_icon) echo siteorigin_widget_get_icon( $separator_icon); ?>
	</div>

<?php
	$this->carrot_widget_footer($instance);
