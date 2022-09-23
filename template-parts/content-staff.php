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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php wp_the_school_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		?>
		<?php 
		$terms = get_terms(
			array(
				'taxonomy'	=> 'wps-staff-roles'
			)
		);
		
		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach( $terms as $term ) {
				$args = array(
					'post_type' 		=> 'wps-staff',
					'posts_per_page'	=> -1,
					'tax_query'			=> array(
						array(
							'taxonomy'  => 'wps-staff-roles',
							'field'		=> 'slug',
							'terms'		=> $term,
						)
					)
				);
			
			$query = new WP_Query( $args );
		?>
			<section class=<?php echo esc_html( $term->name );?>>
				<h2><?php echo esc_html( $term->name ); ?></h2>
			<?php 
			while ( $query -> have_posts() ) {
				$query -> the_post();
			?>
				<section>
					<h3><?php the_title(); ?></h3>
					<?php if ( function_exists('get_field') ) {
							if ( get_field('staff_biography') ) {
								echo '<p>;';
								esc_html_e(get_field('staff_biography'));
								echo '</p>';
							}
							if ( get_field('courses') ) {
								echo '<p>Courses: ';
								esc_html_e(get_field('courses'));
								echo '</p>';
							}
							if ( get_field('instructor_website') ) {
								?>
								<a href="<?php esc_url(the_field('instructor_website')); ?>">Instructor Website</a>
								<?php
							}
					}
					?>
				</section>
		<?php 
			}
		?>
			</section>
		<?php
			}
		} 
		?>
	</div><!-- .entry-content -->

		
</article><!-- #post-<?php the_ID(); ?> -->
