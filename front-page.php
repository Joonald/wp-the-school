<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-the-school
 */

get_header();
?>

	<main id="primary" class="site-main">
		
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<section class='blog-post'>
		<h2> <?php esc_html_e('Recent News', 'wp-the-school');?> </h2>
			<?php $args = array(
				'post_type' 	=> 'post',
				'post_per_page' => 3,
			);
			$blog_query = new WP_QUERY( $args );
			if ( $blog_query -> have_posts() ) {
				while ( $blog_query -> have_posts() ) {
					$blog_query -> the_post();
				?>
				<article>
					<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail('wide-blog'); ?>
						<h3><?php the_title() ?></h3>
					</a>
				</article>
			<?php }; 
			wp_reset_postdata(); 
			}; ?>
		</section>
	</main><!-- #main -->

<?php
get_footer();
