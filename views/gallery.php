<?php 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array("post_type" => "color_gallery", "posts_per_page" => 10, 'paged'=>$paged);
$argsLoop = new WP_Query($args);

?>

<h3>Color Gallery</h3>
<a class="button button-primary" href="<?php echo menu_page_url( 'color-gallery', 0 ) . '&action=new'; ?>"><?php _e( 'Add New Gallery', 'color-gallery' ) ?></a>

<table class="wp-list-table widefat fixed striped posts gallery">
	<?php 
		while ( $argsLoop->have_posts() ) : $argsLoop->the_post();
			$id = get_the_ID();
			$redirect = admin_url() . 'admin.php?page=color-gallery&action=edit&id=' . $id;
			?>
			<tr>
				<th class="manage-column column-title column-primary sortable desc collor">
					<span>Titulo</span>
				</th>
				<th class="manage-column column-title column-primary sortable desc collor">
					<span></span>
				</th>
			</tr>

			<tr class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-sem-categoria color-galley">
				<td class="title column-title has-row-actions column-primary page-title">
					<h1><a href="<?php echo $redirect ?>"><?php the_title(); ?></a></h1>
					<span><a href="<?php echo $redirect ?>">edit gallery</a></span>
				</td>
			</tr>
		<?php

		endwhile;
	?>

	<?php previous_posts_link('&laquo; Newer') ?>
    <?php next_posts_link('Older &raquo;') ?>
</table>