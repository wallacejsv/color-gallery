(function( $ ) {
 
    $(function() {
        //$('.cg-color-field').wpColorPicker();
	    $('#cg-add-images').click(function(e) {
	        e.preventDefault();
	        var image = wp.media({ 
	            title: 'Upload Images',
	            multiple: true
	        }).open()
	        .on('select', function(e){
	            var images = image.state().get('selection');
	            images.map( function( attachment ) {
	            	$('.gallery-empty').remove();
					attachment = attachment.toJSON();
	            	$('.cg-images-list').append('<img data-attach-id="'+ attachment.id +'" class="cg-images-item" src="' + attachment.url + '">');
			    });
	        });
	    });

	    $(document).on( 'click', '.cg-images-item', function(e){
	    	e.preventDefault();
	    })
    });
     
})( jQuery );