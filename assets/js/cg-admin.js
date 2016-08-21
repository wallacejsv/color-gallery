(function( $ ) {
	//ADD NEW GALLERY
    $('#cg-add-images').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Images',
            multiple: true
        }).open()
        .on('select', function(e){
        	var imgs = $.parseJSON( $('.cg-images').val() );
			imgs = imgs ? imgs : [];
            $('.gallery-empty').remove();
            var images = image.state().get('selection');
            images.map( function( attachment ) {
            	imgs.push(attachment.id);
				attachment = attachment.toJSON();
            	$('.cg-images-list').append('<img data-attach-id="'+ attachment.id +'" class="cg-images-item" src="' + attachment.url + '">');
		    });
        	imgs = JSON.stringify(imgs);
			$('.cg-images').val( imgs );        	
        });
    });

    $(document).on( 'click', '.cg-images-item', function(e){
    	e.preventDefault();
    })
})( jQuery );