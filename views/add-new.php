<?php 
$gallery = CG_Admin::cg_get_gallery();
$title = $gallery && $gallery->post_title ? $gallery->post_title : '';
$images = CG_Admin::cg_get_gallery_images() ? CG_Admin::cg_get_gallery_images() : '<span class="gallery-empty">' . _x( 'NO IMAGES', 'color-gallery' ) . '</span>';
?>
<div class="cg-container">
	<h3><?php _e( $gallery ? 'Edit Gallery' : 'Add New Gallery', 'color-gallery' ); ?></h3>
	<form method="POST">
		<div class="cg-actions">
			<input type="button" id="cg-add-images" class="cg-btn-action button-primary" value="<?php _e( 'Add Images', 'color-gallery' ); ?>">
			<input type="submit" name="cg_save_gallery" class="cg-btn-action button-primary" value="<?php _e( 'Save Gallery', 'color-gallery' ); ?>">
		</div>
		<input type="text" class="cg-field" name="cg_title" placeholder="<?php _e( 'Gallery Title', 'color-gallery' ); ?>" value="<?php echo $title; ?>" required>
		<div class="cg-images-list">
			<?php echo $images; ?>
		</div>
		<input type="hidden" name="cg_images" class="cg-images" value="">
	</form>
</div>