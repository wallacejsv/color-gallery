<h3>Color Gallery</h3>
<a class="button button-primary" href="<?php echo menu_page_url( 'color-gallery', 0 ) . '&action=new'; ?>"><?php _e( 'Add New Gallery', 'color-gallery' ) ?></a>

<table class="wp-list-table widefat fixed striped posts gallery">
	<?php 

		  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		  $custom_args = array(
		      'post_type' => 'color_gallery',
		      'posts_per_page' => 20,
		      'paged' => $paged
		    );

		  $custom_query = new WP_Query( $custom_args ); ?>

		    <!-- the loop -->
		    <?php while ( $custom_query->have_posts() ) : $custom_query->the_post();

				$id = get_the_ID();
				$redirect = admin_url() . 'admin.php?page=color-gallery&action=edit&id=' . $id; ?>
				<tr>
					<th class="manage-column column-title column-primary sortable desc collor-title">
						<span>Titulo</span>
					</th>
					<th class="manage-column column-title column-primary sortable desc collor">
						<span>Autor</span>
					</th>
					<th class="manage-column column-title column-primary sortable desc collor">
						<span>Cor</span>
					</th>
					<th class="manage-column column-title column-primary sortable desc collor">
						<span>Categoria</span>
					</th>
					<th class="manage-column column-title column-primary sortable desc collor">
						<span>Data</span>
					</th>
				</tr>

				<tr class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-sem-categoria color-galley">
					<td class="title column-title has-row-actions column-primary page-title">
						<h1><a href="<?php echo $redirect ?>"><?php the_title(); ?></a></h1>
						<span><a href="<?php echo $redirect ?>">edit gallery</a></span>
					</td>
					<td class="title column-title has-row-actions column-primary page-title collor-inf">
						<h1><?php the_author(); ?></h1>
					</td>
					<td class="title column-title has-row-actions column-primary page-title collor-inf">
						<h1>--</h1>
					</td>
					<td class="title column-title has-row-actions column-primary page-title collor-inf">
						<h1>--</h1>
					</td>
					<td class="title column-title has-row-actions column-primary page-title collor-inf">
						<h1>publicado<br> <?php the_time('d/m/Y'); ?></h1>
					</td>
				</tr>

			<?php
			endwhile;
			wp_reset_postdata(); ´?>
</table>