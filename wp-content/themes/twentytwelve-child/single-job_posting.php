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

			<?php while ( have_posts() ) : the_post(); 

					$meta_values = get_post_meta( $id);


	
			?>
				
				<h2 class='posting_title'>
					<?= $meta_values['job_title'][0]; ?>
				</h2>
				<br>
				<div class='posting_main'>
					<p>
						<span class='posting_subheading'>Job Description</span>
						<br><br>
						<?= nl2br($meta_values['job_description'][0]) ?>
					</p>
					<br>
					<p>
						<span class='posting_subheading'>How To Apply</span>
						<br><br>
						<?= nl2br($meta_values['job_apply'][0]) ?>
					</p>
				</div>
				<div class='posting_sidebar'>
					<p>
						<span class='posting_subheading'>Company Name: </span>
						<br><br>
						<?= $meta_values['company_name'][0]; ?>
					</p>
					<br>
					<p>
						<span class='posting_subheading'>Contact Information: </span>
						<br><br>
						<?= $meta_values['contact_name'][0]; ?>
						<br>
						<?= $meta_values['contact_email'][0]; ?>
					</p>
					<br>
					<p>
						<!-- <span class='posting_subheading'>Tags: </span>
						<br><br> -->
						<?= get_the_current_tax_terms_jobs( get_the_ID() );?>

					</p>

				</div>
				


				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>