( function( wp, $ ) {

	wp.customize.TestControl = wp.customize.Control.extend({
		ready: function() {
			var control = this;
			var input = this.container.find('input[type=text]');
			
			

			input.on("keyup",function(){
				var val=$(this).val();
				control.setting.set(val);
				wp.customize.previewer.refresh();

			});

			this.container.find('.control-reset').on("click",function(){
				var def=input.data('default-value');
				console.log(def);
				input.val(def);
				control.setting.set(def);
				wp.customize.previewer.refresh();
			});

			
					
				
		
		}
	});

	$.extend( wp.customize.controlConstructor, {
		'test-control': wp.customize.TestControl,
	} );

} )( wp, jQuery );

