<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-the-school
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<?php the_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
	
		$term = get_the_terms( $post->ID, 'wps-student-specialty' );

		$args = array(
			'post_type' 		=> 'wps-student',
			'posts_per_page'	=> -1,
			'post__not_in'		=> array( $post-> ID ),
			'tax_query'			=> array(
				array(
					'taxonomy'	=> 'wps-student-specialty',
					'field'		=> 'slug',
					'terms'		=> $term[0],
				)
			)
		);

		$query = new WP_Query( $args );
		if ($query -> have_posts() ) {
			while ( $query -> have_posts() ) {
				$query -> the_post();
				?>
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				<?php
			}
		}
		
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
