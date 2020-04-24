(function($){

	function initPresetSelector(container){
		$('.carrot_page .presets li').on('click',function(){
			$(this).addClass("selected");
			$(this).find("input[type=radio]").attr("checked",true);
			$(this).siblings().removeClass("selected");
		});
	}
	function initTabs(container){
		if(!container || container.length==0) return;
		 
		 container.find(".carrot_page .nav-tab-wrapper a").on("click",function(e){
			e.preventDefault();
			var href=$(this).attr("href");
			$(this).siblings().removeClass("nav-tab-active");
			$(this).addClass("nav-tab-active");
			container.find(".tab").removeClass("tab-active");
			container.find(href).addClass("tab-active");
		 }); 
	}

	
	function initUploaders(){
	
		// Uploading files
		var file_frame;
		if(!wp.media) return;
		var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
		var set_to_post_id = $('#upload_file_button').data("saved-id");
		//alert(set_to_post_id);
		$('#remove_pdf_button').on('click', function( event ){
			event.preventDefault();
			$( '#pdf_preview' ).val( '' ).attr("placeholder","");
			$( '#pdf_attachment_id' ).val( 0);
			$( '#pdf_icon' ).addClass("empty").empty();
		});
		
		$('#upload_file_button').on('click', function( event ){
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				// Set the post ID to what we want
				file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				// Open frame
				file_frame.open();
				return;
			} else {
				// Set the wp.media post id so the uploader grabs the ID we want when initialised
				wp.media.model.settings.post.id = set_to_post_id;
			}
			
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Select a file to upload',
				button: {
					text: 'Use this file',
				},
				library: {
					type: 'application/pdf'
				},
				multiple: false	// Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				console.log(attachment);
				// Do something with attachment.id and/or attachment.url here
				$( '#pdf_preview' ).val( attachment.url.split('/').pop() );
				$( '#pdf_attachment_id' ).val( attachment.id );
				$( '#pdf_icon' ).removeClass("empty").append("<a href='"+attachment.url+"' target='_blank'><img src='"+attachment.icon+"' class='icon' /><br/>"+attachment.url.split('/').pop()+"</a>");
				// Restore the main post ID
				wp.media.model.settings.post.id = wp_media_post_id;
			});
				// Finally, open the modal
				file_frame.open();
		});
		// Restore the main ID when the add media button is pressed
		$( 'a.add_media' ).on( 'click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});
	
	}
	
	

	$(document).ready(function(e){
		initTabs($("body"));
		initPresetSelector();
		//initUploaders();
	});
	
})(jQuery);


