<?php
/*
 * Template Name: Test Template
 * Description: First try at custom template
 */


get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
<?php 

	// while ( have_posts() ) : the_post(); 

	// get_template_part( 'content', 'page' ); 
	// comments_template( '', true ); 

	// endwhile; // end of the loop. 
	$job_listings_array = array();
	$all_jobs = $wpdb->get_results( "SELECT * FROM job_listings" );
	foreach ($all_jobs as $key => $listing) {
		$job_title = $listing->job_title;
		$company_name =  $listing->company_name;
		$job_description = $listing->job_description;
	
		$new_div = '<div class="listing-thumb">';
		$new_div .= '<b>' . $job_title . '</b>';
		$new_div .= '<p>' . $company_name .'</p>';
		$new_div .= '<p>' .$job_description .'</p>';
		$new_div .= '</div>';
		array_push($job_listings_array, $new_div);

	}
	// var_dump($all_jobs);
	
?>
	
	<!-- <?= $new_div; ?> -->
	<div id='listings-contain'>
		<div id='job-listings' class='listing-div'>
			<div class='listing-header'>
				<b>Job Listings</b>
				<form>
					<input placeholder='Search by Keyword'>
					<input type='submit'>
					<br>
					<a href="">Advanced Search Options</a>
				</form>
			</div>
			<div class='spacer'></div>
			<div class='thumb-contain'>
				<!-- <div class='listing-thumb'>
					<b><?= $job_title; ?></b>
					<p><?= $company_name; ?></p>
					<p><?= $job_description; ?></p>
					<span>Date Posted</span>
				</div> -->
<?php
				foreach ($job_listings_array as $key => $value) {
					echo $value;
				}
?>
			</div>
			
		</div>
		<div id='skills-listings' class='listing-div' >
			<h3>Skills Listings</h3>
			helasjd askdjas ldkjas dlkasjd aslkdj aslkdjas dlkasjd aslkdj asdlkjsa dlksaj dsalkdj asldkjas dlasdj aslkdjas oiddu oiduasodinasdasnmdaslkdj lkjs dlaskjd aaskdja sdlkajs dlaksjd aslkd
		</div>

	</div>
	


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>