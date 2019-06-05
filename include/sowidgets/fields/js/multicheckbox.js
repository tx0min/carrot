

	
	function initMulticheckbox(id){
		if(jQuery(id).size()>0){
			
			jQuery(id).find('input[type="checkbox"]').change(function(e){
				
				var vals=[];
				jQuery(id).find('input[type="checkbox"]').each(function(){
					if(jQuery(this).is(':checked')) vals.push(jQuery(this).val());
				
				});
				var valor=JSON.stringify(vals);
				
				
				jQuery(this).parents('.multicheckbox-field').find('.siteorigin-widget-multicheckbox').val(valor);
			});
		}
	}

	
