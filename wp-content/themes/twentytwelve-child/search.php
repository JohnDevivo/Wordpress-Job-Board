<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<br>
				<!-- Total Results: 
				<?= $total_results = $wp_query->found_posts; ?> -->
		
			</header>
			
			<?php 
			// twentytwelve_content_nav( 'nav-above' ); 

			// echo $_SERVER['REQUEST_URI'];
			$parse_url =  wp_parse_args($_SERVER['REQUEST_URI']);
			// var_dump($parse_url);


			// check to see what kind of post type and bring back listings depending on type.
			if ($parse_url['post_type'] == 'job_posting'){

				while ( have_posts() ) : the_post();
?>		
				<div class='search_post'>
					<a href="<?= get_permalink($the_ID);?>"><?= the_title(); ?></a>
					<br>
					Job Description:
					<p>
						<?= substr(strip_tags(job_description($the_ID)), 0, 320);?>...<a href="<?= get_permalink($the_ID);?>">Read Full Listing</a>
					</p>
					<br>
					<!-- returns list of all custom taxonomy with a link -->
<?php 				
				$taxonomies = array_map( 'strip_tags', get_the_taxonomies() );

				foreach ($taxonomies as $key => $value) {
					echo $value . "<br>";
				}
?>

				</div>
				<hr>
				<?php endwhile; 
			}
			elseif ($parse_url['post_type'] == 'opportunity_posting'){
				while ( have_posts() ) : the_post();
?>		
				<div class='search_post'>
					<a href="<?= get_permalink($the_ID);?>"><?= the_title(); ?></a>
					<br>
					What I'm looking for:
					<p>
						<?= substr(strip_tags(seeker_desired($the_ID)), 0, 320);?>...<a href="<?= get_permalink($the_ID);?>">Read Full Listing</a>
					</p>
					<br>
<?php 				
				$taxonomies = array_map( 'strip_tags', get_the_taxonomies() );

				foreach ($taxonomies as $key => $value) {
					echo $value . "<br>";
				}
?>
				</div>
				<hr>
				<?php endwhile; 
			}
			else{



			}

			?>

<?= search_pagination(); ?>

<br><br>
			<div>
				<h3>Make Another Search</h3>
				<br><br>
				<div id='job-listings' class='search-page-search-div'>
				<div class='listing-header'>
					Search For Job Listings
					<br>
					<?php echo job_search_form($something); ?>
				</div>
				</div>
				<div id='skills-listings' class='search-page-search-div alignright'  >
					<div class='listing-header'>
						Search for Opportunity Seekers
						<br>
						<?php echo opportunity_search_form(); ?>
					</div>			
				</div>
			</div>

			<!-- if there are no posts that match the query -->
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<!-- <?php get_search_form(); ?> -->
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
			<div>
				<div>
					Search For Job Listings
					<br>
					<?php echo job_search_form(); ?>

				</div>
				<div>
					Search For Skills Listings
					<?php echo opportunity_search_form(); ?>
				</div>
			</div>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>