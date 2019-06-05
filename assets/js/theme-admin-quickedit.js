(function($) {

	// we create a copy of the WP inline edit post function
	var $wp_inline_edit = inlineEditPost.edit;

	// and then we overwrite the function with our own code
	inlineEditPost.edit = function( id ) {

		// "call" the original WP edit function
		// we don't want to leave WordPress hanging
		$wp_inline_edit.apply( this, arguments );

		// now we take care of our business

		// get the post ID
		var $post_id = 0;
		if ( typeof( id ) == 'object' ) {
			$post_id = parseInt( this.getId( id ) );
		}

		if ( $post_id > 0 ) {
			// define the edit row
			var $edit_row = $( '#edit-' + $post_id );
			var $post_row = $( '#post-' + $post_id );
			
			// get the data
			//console.log($post_row.find( '.taxonomy_field' ).length);
			$post_row.find( '.taxonomy_field' ).each(function(i){
				
				var values=$(this).val();
				var taxonomy=$(this).data('taxonomy');
				if($(this).is(".hierarchical")){
					values=values.split(",");
					
					//console.log(values);
					$edit_row.find(".taxonomy_quickedit[data-taxonomy="+taxonomy+"]").each(function(j){
						//if($(this).val() == values){
						var ischecked= $.inArray($(this).val(), values)>=0;
						//console.log(check);
						$(this).prop('checked', ischecked );
						
						
					});
				}else{
					$edit_row.find(".taxonomy_quickedit[data-taxonomy="+taxonomy+"]").val(values);
				}
			});
			
		}
	};

})(jQuery);