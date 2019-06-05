( function( wp, $ ) {

	wp.customize.IconsControl = wp.customize.Control.extend({
		ready: function() {
			var control = this;
			//console.log(this);
			
			var input = control.container.find('.the-value');
			var val=input.val();
			
			activateIcon(val);
							
	
			function deactivateIcon(iconid){
				control.container.find('.siteorigin-widget-icon-icons .siteorigin-widget-icon-icons-icon').removeClass('active');
				control.container.find('.kirki-icon-preview').empty();
				
			}

			function setValue(val){
				//console.log("setValue "+val);
				input.val(val);
				input.change();
				//wp.customize.previewer.refresh();
			}
			
			
			
			function activateIcon(iconid){
				//console.log("activateIcon "+iconid);
				
				if(!iconid){
					deactivateIcon();
					return;
				}
				//console.log("activateIcon: "+iconid);
				
				var family=iconid.split("-")[0];
				//console.log(family);
				control.container.find('.siteorigin-widget-icon-family').val(family);
				//console.log(control.container);
				control.container.find('.siteorigin-widget-icon-icons').removeClass('active');
				control.container.find('.siteorigin-widget-icon-icons[data-family='+family+']').addClass('active');
				//console.log(control.container.find('.siteorigin-widget-icon-icons-icon[data-value='+iconid+']'));
				
				control.container.find('.siteorigin-widget-icon-icons-icon').removeClass('active');
				control.container.find('.siteorigin-widget-icon-icons-icon[data-value='+iconid+']').addClass('active');

				var icon=control.container.find('.siteorigin-widget-icon-icons .siteorigin-widget-icon-icons-icon[data-value='+iconid+']');
				//console.log(icon);
				control.container.find('.kirki-icon-preview').empty().append(icon.clone());
				
				
				
			}
			
			
			// Save when input changes.
			this.container.find('input.the-value').on('change', function() {
				
				//console.log("CHANGED!");
				var val=$(this).val();
				activateIcon(val);
				control.setting.set(val);
				
			});
			
			
			//icon clicked
			this.container.find('.kirki-icons-container .siteorigin-widget-icon-icons-icon').on("click",function(){
				var val;
				if($(this).is(".active")){
					val="";
					//deactivateIcon($(this).data('value'));
				}else{
					val=$(this).data('value');
					//console.log(val);
					//activateIcon(val);
				}
				setValue(val);
					
				
			});
			
			
			//reset clicked
			this.container.find('.control-reset').on("click",function(){
				var def=input.data('default-value');
				setValue(def);
				
			});
			
			
			
			
			this.container.find('.kirki-icon-preview').on("click",function(){
				$(this).toggleClass("open");
				control.container.find('.icons-container').slideToggle(200);//"active");
			});
			

			this.container.find('.siteorigin-widget-icon-family').on("change",function(){
				var family=$(this).val();
				//console.log(family);
				control.container.find('.siteorigin-widget-icon-icons.'+family).addClass('active');
				control.container.find('.siteorigin-widget-icon-icons.'+family).siblings().removeClass('active');

			});

			this.container.find('.kirki-icons-search').on("keyup",function(){
				var family=control.container.find('.siteorigin-widget-icon-family').val();
				//console.log(family);
				var filter=$(this).val();
				//console.log(filter);
				
				control.container.find('.siteorigin-widget-icon-icons-icon').each(function(){
					if($(this).data("value").indexOf(filter)!== -1){
						$(this).removeClass("hidden");
					}else{
						$(this).addClass("hidden");
					}


				});

			});


			

			
		}
	});

	$.extend( wp.customize.controlConstructor, {
		'kirki-icons': wp.customize.IconsControl,
	} );

} )( wp, jQuery );




