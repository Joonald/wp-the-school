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
		
		if( have_rows('course_schedule') ):

			?><table>
				<caption>Weekly Course Schedule</caption>
				<thead>
				<?php while ( have_rows('course_schedule') ) {
					the_row();
					$dateObj 	 = get_sub_field_object('date');
					$dateLabel 	 = $dateObj['label'];
					$courseObj   = get_sub_field_object('course');
					$courseLabel = $courseObj['label'];
					$insObj 	 = get_sub_field_object('instructor');
					$insLabel 	 = $insObj['label'];
					?>
					<tr>
						<th><?php echo $dateLabel; ?></th>
						<th><?php echo $courseLabel; ?></th>
						<th><?php echo $insLabel; ?></th>
					</tr>
					<?php break;
				}
				?>
				</thead>
				<tbody>
			<?php 
			// Loop through rows.
			while( have_rows('course_schedule') ) : the_row();
		
				// Load sub field value.
				$date = get_sub_field('date');
				$course = get_sub_field('course');
				$instructor = get_sub_field('instructor');
				// Do something...
				?>
				<tr>
					<td><?php echo $date; ?></td>
					<td><?php echo $course; ?></td>
					<td><?php echo $instructor; ?></td>
				</tr>
				<?php
			// End loop.
			endwhile; ?>
			
			</tbody>
			</table>
		<?php endif; ?>
		
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
