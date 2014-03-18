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
					<?= get_the_current_tax_terms( get_the_ID() );?>

				</p>
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


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>