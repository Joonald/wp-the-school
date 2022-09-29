<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wp-the-school
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header">
				<?php
				post_type_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$args = array(
				'post_type'		 => 'wps-student',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );
			if ( $query -> have_posts() ) {
				while ( $query -> have_posts() ) {
					$query -> the_post();
					$terms = wp_get_post_terms( $post->ID, 'wps-student-specialty' );
					?>
					<section>
						<a href="<?php the_permalink() ?>">
							<h2><?php the_title() ?></h2>
							<?php the_post_thumbnail('medium'); ?>
						</a>
						<?php the_excerpt() ?>
						<p>Specialty: 
						<?php foreach ( $terms as $term ) {
							$termLink = get_term_link( $term );
							?>
							<a href="<?php echo $termLink; ?>"><?php echo $term->name; ?></a>
							<?php
						} ?>
						</p>							
					</section>
					<?php
				}
				wp_reset_postdata();
			}
		?>

	</main><!-- #main -->

<?php
get_footer();
