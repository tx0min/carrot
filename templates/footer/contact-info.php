	<?php
		$contact_items=array();
		//_dump(_o("show_contact_icons"));
		if(_o("contact_phone")){
			$icon= _o("show_contact_icons")?_icon("icon_phone"):"";
			$contact_items[]='<a href="tel:'._o("contact_phone").'">'.$icon.' '. _o("contact_phone").'</a> ';
		}
		if(_o("contact_email")){
			$icon= _o("show_contact_icons")?_icon("icon_email"):"";
			$contact_items[]='<a href="mailto:'._o("contact_email").'">'.$icon.' '. _o("contact_email").'</a> ';
		}
		if(_o("contact_address")){
			$icon= _o("show_contact_icons")?_icon("icon_map_marker"):"";
			$contact_items[]=$icon.' '. _o("contact_address");
		}

	?>
	<div class="text-sm p-y-sm d-ib">
		<?php $separator=((_o("contact_layout")=="inline")?" | ":"</div><div>"); ?>
		<div><?=implode($separator,$contact_items)?></div>
	</div>
