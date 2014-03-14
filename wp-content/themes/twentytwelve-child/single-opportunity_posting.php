<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php 
				while ( have_posts() ) : the_post(); 

				$meta_values = get_post_meta( $id);
			
				
			?>


			<h2 class='posting_title'>
				<?= $meta_values['poster_name'][0]; ?>
			</h2>
			<h3><?= $meta_values['poster_email'][0]; ?></h3>

			<br>
			<div class='posting_main'>
				<p>
					<span class='posting_subheading'>Background & Experience</span>
					<br><br>
					<?= nl2br($meta_values['poster_background'][0]) ?>
				</p>
				<br>
				<p>
					<span class='posting_subheading'>What I'm looking for</span>
					<br><br>
					<?= nl2br($meta_values['poster_desired'][0]) ?>
					
				</p>
				<br>
				<p>
					<span class='posting_subheading'>Portfolio</span>
					<br><br>
					<?= nl2br($meta_values['poster_portfolio'][0]) ?>
					
				</p>
			</div>
			<div class='posting_sidebar'>
				<p>
					<!-- <span class='posting_subheading'>Tags: </span>
					<br><br> -->
					<div>
					<?= 
						get_the_post_thumbnail($page->ID, 'thumbnail');
					?>
					</div>
					<?= get_the_current_tax_terms_jobs( get_the_ID() );?>

				</p>

			</div>


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>