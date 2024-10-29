jQuery( document ).ready( function( $ ){
 
	$('#baapifwc-select-images .baapifwc-select-image').each(function() {
	
		var mediaPicker;		
		var selectImage = $(this);

		selectImage.find('.baapifwc-select-image').click( function( e ) {
		
			e.preventDefault();
			
			if ( mediaPicker ) {

				mediaPicker.open();
				return;

			}
			
			mediaPicker = wp.media.frames.mediaPicker = wp.media();

			mediaPicker.on( 'select', function() {

				mediaAttachment = mediaPicker.state().get( 'selection' ).first().toJSON();
				mediaId = mediaAttachment.id;
				mediaThumb = mediaAttachment.sizes.thumbnail.url;
				selectImage.find('.baapifwc-image-id').val( mediaId );
				selectImage.find('.baapifwc-image-thumbnail').html( '<img src="' + mediaThumb + '">' );

			});

			mediaPicker.open(); 
			
		});

		selectImage.find('.baapifwc-remove-image').click( function( e ) {
			
			e.preventDefault();			
			selectImage.find( '.baapifwc-image-id' ).val('');
			selectImage.find( '.baapifwc-image-thumbnail' ).empty();
		
		});
		
	});
	
});