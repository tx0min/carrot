
	function selectColor(item){
		var color=item.attr('data-value');
		item.siblings().removeClass('selected');
		item.addClass('selected');
		item.parents('.themecolor-field').parent().find('.color-description').html(item.find('.sample').attr('title'));
		
		if(color=='custom'){
			//item.parents('.themecolor-field').parent().find('input.siteorigin-widget-themecolor').val('');
			item.parents('.themecolor-field').parent().removeClass('notcustom');
		}else{
			//jQuery(this).parents('.themecolor-field').find('input').addClass('hidden');
			item.parents('.themecolor-field').parent().addClass('notcustom');
			item.parents('.themecolor-field').parent().find('input.siteorigin-widget-themecolor').val(color);
			
		}
		
	}
	
	function initColorSelector(id){
		if(jQuery(id).size()>0){
			selectColor(jQuery(id).find('ul li.selected'));
		
			jQuery(id).find('ul li').click(function(e){
				selectColor(jQuery(this));
			});
		}
	}

	
