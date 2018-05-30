<?php $related_posts = freedom_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-post-wrapper">
		<h4 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php esc_html_e( 'You May Also Like', 'freedom' ); ?></span>
		</h4>

		<div class="related-posts clearfix">

			<?php
			while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="tg-one-third">

					<?php if ( has_post_thumbnail() ): ?>
						<div class="related-posts-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'featured-home' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="article-content">

						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h3><!--/.post-title-->

						<div class="entry-meta">
							<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span>

							<?php
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
							if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
							  $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
							}
							$time_string = sprintf( $time_string,
							  esc_attr( get_the_date( 'c' ) ),
							  esc_html( get_the_date() ),
							  esc_attr( get_the_modified_date( 'c' ) ),
							  esc_html( get_the_modified_date() )
							);
							printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-calendar-o"></i> %3$s</a></span>', 'freedom' ),
								esc_url( get_permalink() ),
								esc_attr( get_the_time() ),
								$time_string
							);
							?>
						</div>

					</div>

				</div><!--/.related-->
			<?php endwhile; ?>

		</div><!--/.post-related-->
	</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
