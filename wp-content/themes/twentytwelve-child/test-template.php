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
	$all_jobs = get_all_listings('job_posting');
	// var_dump($all_jobs);


	foreach ($all_jobs as $key => $listing) {
		$job_title = $listing->job_title;
		$post_title = $listing->post_title;
		$company_name =  $listing->company_name;
		$job_description = $listing->job_description;
		$post_id = $listing->ID;
		$permalink = get_permalink($post_id);
		$new_div = '<div class="listing-thumb">';
		$new_div .= '<b>' . $post_title . '</b>';
		$new_div .= '<p>' . $company_name .'</p>';
		$new_div .= '<p>' .substr($job_description, 0,200) .'...</p>';
		$new_div .='<a href="'. $permalink .'"> View Job Posting </a>';
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
				<br><br>
					<!-- <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">

						<input  type="text" name="s" id="s" placeholder="Search by keywords" value="" />
						<input type="hidden" name="post_type" value="job_posting" />
						<select name="region">
							<option value=" ">All Regions</option>
							<option value="hartford">Hartford</option>
							<option value="post_type_b">Post Type B</option>
							 <option value="post_type_c">Post Type C</option>
						</select><br />
						<input type="submit" id="searchsubmit" value="Search" />
					</form> -->
<?php echo job_search_form($something); ?>
					
			</div>
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
			<!-- helasjd askdjas ldkjas dlkasjd aslkdj aslkdjas dlkasjd aslkdj asdlkjsa dlksaj dsalkdj asldkjas dlasdj aslkdjas oiddu oiduasodinasdasnmdaslkdj lkjs dlaskjd aaskdja sdlkajs dlaksjd aslkd -->


		</div>

	</div>



		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>