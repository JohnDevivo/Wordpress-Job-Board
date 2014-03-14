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
	
?>
	<header class="page-header index-header">
		<h1>Welcome to the Whiteboard Job Board</h1>	
		<h3>Find jobs. Find talent. Find the right startup opportunity.</h3>
	</header>
	
	<div id='listings-contain'>
		<!-- for job listings -->
		<div id='job-listings' class='listing-div'>
			<!-- has the job search form -->
			<div class='listing-header'>
				<b>Job Listings</b>
				<br><br>
			
<?php 
	echo job_search_form(); 

?>
					
			</div>
			<!-- displays the most recent job listings -->
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

		<!-- container for opportunity seekers -->
		<div id='opportunity-listings' class='listing-div' >
			<!-- shows the opportunity seeker search bar -->
			<div class='listing-header'>
			<b>Opportunity Seekers</b>
			<br><br>	
<?php 
	// echo job_search_form($something); 
	echo opportunity_search_form();
?>				
			</div>
			<!-- lists recent opportunity seeker listing -->
			<div class='thumb-contain'>
				
<?php
	$opportunity_listings_array = get_recent_listings('opportunity_posting');
	foreach ($opportunity_listings_array as $key => $value) {
		echo $value;
	}

?>
			<br><br>
			<a href="?s=&post_type=opportunity_posting">Browse All Opportunity Seekers</a>
			</div>


		</div>

	</div>



		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>