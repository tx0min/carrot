	function getVal(input){
		var tmp=input.val();
		if(isNaN(tmp) || tmp=='') return 0;
		else return tmp;
	}
		
	function setDimensions(item){
	
		var check=item.find('.dimensions-same');
		
		if(check.is(':checked')){
			item.find('.dimension.right').attr('readonly',true);
			item.find('.dimension.bottom').attr('readonly',true);
			item.find('.dimension.left').attr('readonly',true);
			
		}else{
			item.find('.dimension.right').attr('readonly',false);
			item.find('.dimension.bottom').attr('readonly',false);
			item.find('.dimension.left').attr('readonly',false);
			
		}
		var units= item.find('.dimension-units').val();
		
		var dim='';
		if(item.find('.dimensions-same').is(':checked')){
			dim=
				getVal(item.find('.dimension.top')) +units;
		}else{
			dim=
				getVal(item.find('.dimension.top')) +units +" "+
				getVal(item.find('.dimension.right'))+units +" "+
				getVal(item.find('.dimension.bottom'))+units +" "+
				getVal(item.find('.dimension.left'))+units ;
		}
			
		item.find('.dimension-final-input').val(dim);
	}
	function initDimensions(id){
		if(jQuery(id).size()>0){
			var item=jQuery(id);
			item.find('.dimensions-same').change(function(){
				setDimensions(item);
			
			});
			
			item.find('.dimension').keyup(function(){
				setDimensions(item);
			});
			item.find('.dimension-units').change(function(){
				setDimensions(item);
			});
			setDimensions(item);
			
		}
	}

	
