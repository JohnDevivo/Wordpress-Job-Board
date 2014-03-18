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

			<?php $gmt_timestamp = get_post_time('U', true);
				echo $gmt_timestamp;
				 ?>	
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
					<div>
					<?= 
						get_the_post_thumbnail($page->ID, 'thumbnail');
					?>
					</div>
					<div>
						<span class='posting_subheading'>Company Name: </span>
						<br><br>
						<?= $meta_values['company_name'][0]; ?>
					</div>
					<br>
					<div>
						<span class='posting_subheading'>Contact Information: </span>
						<br><br>
						<?= $meta_values['contact_name'][0]; ?>
						<br>
						<?= $meta_values['contact_email'][0]; ?>
					</div>
					<br>
					<div>
						<!-- gets taxonomy and forms their listing -->
						<?= get_the_current_tax_terms( get_the_ID() );?>

					</div>
					<br><br>
					<div>
						<span class='posting_subheading'>Share this Post</span>
						<br><br>

						<a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_permalink();?>" target="_blank"><img src="../../wp-content/themes/twentytwelve-child/share.png"></a>
						<br><br>
						<!-- Twitter tweet button will not work for localhost and will only work on live url. -->
						<a href="https://twitter.com/share" class="twitter-share-button" data-text="Check out this listing from the NeWhiteBoard:" data-size="large" data-count="none">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						<br><br>
						Copy Link:
						<input value='<?= get_permalink();?>' readonly>
						

					</div>
					
						
					

				</div>
				


				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>