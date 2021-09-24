<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0
 */

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div id="tcr-blog" class="tcr-blog blog-page mt-5">
	<!-- <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1"> -->
	<div class="container" id="content" tabindex="-1">
		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
					?>

					<?php
							$no_thumb = "";
						if ( !has_post_thumbnail() ) {
							$no_thumb = "no-thumbs";
						}
					?>
					<div class="col-12">
						<article <?php post_class();?>>
							<div class="blog-item <?php echo esc_attr($no_thumb); ?>">
								<div class="blog-img">
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink();?>">
											<?php
											the_post_thumbnail();
											?>
									<?php } ?>
									</a>
									<div class="blog-img-content">

									<!-- Start date meta value -->
									<?php
										if ( has_post_thumbnail() ) { ?>
											<div class="meta meta-date">
													<span class="month-day"><?php echo get_the_date( 'd' ); ?></span>
													<span class="month-name"><?php echo get_the_date( 'M' ); ?></span>
											</div>
										<?php }else{ ?>
											<div class="default-date meta">
												<?php $post_date = get_the_date(); echo esc_attr($post_date);?>
											</div>
										<?php }
									?>
									<!-- End date meta value -->

									<!-- Start author meta value -->
										<div class="author meta">
										<i class="fa fa-user-o" aria-hidden="true"></i> <?php echo get_the_author(); ?>
										</div>
										<!-- End author meta value -->

										<!-- Start category meta value -->
										<?php
											if(get_the_category()){?>
											<div class="meta">
													<div class="category-name">
													<i class="fa fa-folder-o" aria-hidden="true"></i>
													<?php the_category(', '); ?>
													</div>
												</div>
											<?php
											} ?>
										<!-- End category meta value -->

									</div>

								</div><!-- .blog-img -->

								<div class="full-blog-content">
									<div class="title-wrap">
										<h3 class="blog-title">
											<a href="<?php the_permalink();?>">
												<?php the_title();?>
											</a>
										</h3>
									</div>

									<div class="blog-desc">
										<p>
											<?php the_excerpt();?>
										</p>
									</div>
									<div class="clear"></div>
							</div>
							</div>
						</article>
					</div>

					<?php
					endwhile;
						wp_reset_postdata();
					?>
				<?php
				else :
					get_template_part( 'loop-templates/content', 'none' );
				endif; ?>
			</main>

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
        </div>
    </div>
</div>

<?php
get_footer();
