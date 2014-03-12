<?php
/*
 * Template Name: Test Template
 * Description: First try at custom template
 */


get_header();
 ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
<?php 


	// $job_listings_array = array();
	// $all_jobs = get_all_listings('job_posting', 1);
	// // var_dump($all_jobs);
	


	// foreach ($all_jobs as $key => $listing) {
	// 	$job_title = $listing->job_title;
	// 	$post_title = $listing->post_title;
	// 	$company_name =  $listing->company_name;
	// 	$job_description = $listing->job_description;
	// 	$post_id = $listing->ID;
	// 	$permalink = get_permalink($post_id);
	// 	$new_div = '<div class="listing-thumb">';
	// 	$new_div .= '<b>' . $post_title . '</b>';
	// 	$new_div .= '<p>' . $company_name .'</p>';
	// 	$new_div .= '<p>' .substr($job_description, 0,200) .'...</p>';
	// 	$new_div .='<a href="'. $permalink .'"> View Job Posting </a>';
	// 	$new_div .= '</div>';
	// 	array_push($job_listings_array, $new_div);

	// }
	

	
?>
	
	<!-- <?= $new_div; ?> -->
	<div id='listings-contain'>
		<div id='job-listings' class='listing-div'>
			<div class='listing-header'>
				<b>Job Listings</b>
				<br><br>
			
<?php 
	echo job_search_form($something); 

?>
					
			</div>
			<div class='thumb-contain'>
				
	
<?php
	
	$job_listings_array = get_recent_listings('job_posting');
	foreach ($job_listings_array as $key => $value) {
		echo $value;
	}



?>
			<br><br>
			<a href="?s=&post_type=job_posting">Browse All Job Listings</a>
			</div>
			
		</div>
		<div id='skills-listings' class='listing-div' >
			<h3>Skills Listings</h3>



		</div>

	</div>



		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>