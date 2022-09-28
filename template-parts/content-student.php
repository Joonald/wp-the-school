<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-the-school
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		?>
		<?php 
				$args = array(
					'post_type' 		=> 'wps-student',
					'posts_per_page'	=> -1,
				);
			
			$query = new WP_Query( $args );
			if ( $query -> have_posts() ) {
			while ( $query -> have_posts() ) {
				$query -> the_post();
			
			?> <section>
					<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php			
					}
					?>
				</section>
		<?php 
			}
		?>
			</section>
	</div><!-- .entry-content -->

		
</article><!-- #post-<?php the_ID(); ?> -->
