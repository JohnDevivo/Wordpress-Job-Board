<?php 

// redirects blank search from index page to show all posts
add_filter( 'request', 'blank_search' );
function blank_search( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}


function change_default_title( $title ){
 
    $screen = get_current_screen();
 
    if ( 'job_posting' == $screen->post_type ){
        $title = 'Enter Description Here - This is what will show up in Search';
    }
    if ('opportunity_posting' == $screen->post_type){
    	$title = 'Enter Description Here - This is what will show up in Search';
    }
 
    return $title;
}
 
add_filter( 'enter_title_here', 'change_default_title' );

// adds a custom post type for job posting
add_action('init', 'create_job_posting');
 
function create_job_posting() {
 
	$labels = array(
		'name' => _x('Job Postings', 'post type general name'),
		'singular_name' => _x('New Job Post', 'post type singular name'),
		'add_new' => _x('Add New', 'job posting'),
		'add_new_item' => __('Add New Job Posting'),
		'edit_item' => __('Edit Job Posting'),
		'new_item' => __('New Job Posting'),
		'view_item' => __('View Job Posting'),
		'search_items' => __('Search Job Listings'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/thumb.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail')
	  ); 

	register_post_type( 'job_posting' , $args );
	// flush_rewrite_rules();

	
	register_taxonomy("career_fields", array("job_posting"), array("hierarchical" => true, "label" => "Career Fields", "singular_label" => "Career Field", "rewrite" => true));
	register_taxonomy("regions", array("job_posting"), array("hierarchical" => true, "label" => "Regions", "singular_label" => "Region", "rewrite" => true));
	register_taxonomy("job_types", array("job_posting"), array("hierarchical" => true, "label" => "Job Types", "singular_label" => "Job Type", "rewrite" => true));

	add_action("admin_init", "custom_job_form");

	function custom_job_form(){
	  		
	  	add_meta_box("job_form_meta", "Job Posting Form", "job_form", "job_posting", "normal", "low");
	}

	function job_form() {
  	global $post;
  	$custom = get_post_custom($post->ID);
	  $job_title = $custom["job_title"][0];
	  $job_description = $custom["job_description"][0];
	  $company_name = $custom['company_name'][0];
	  $contact_name = $custom['contact_name'][0];
	  $contact_email = $custom['contact_email'][0];
	  $job_apply = $custom['job_apply'][0];
 	  ?>
 	  <p>Please fill out the form with the job information and publish when completed. All fields below are required. Optional fields are on the right sidebar. Your listing will be reviewed by our Administrator before listed on the job board.</p>
 	  <p>
 	  	<label>Job Title* <br>
 	  		<input type='text' name="job_title" value=
 	  			'<?php echo $job_title; ?>'
 	  		>
 	  		</input>
 	  	</label>
 	  </p>
 	  <p>
 	  	<label>Job Description* <br>
 	  		<?php 

 	  		
			$editor_id = 'job_description';
			$settings = array(
				'media_buttons' => false);
			
			wp_editor( $job_description , $editor_id, $settings );
		
 	  		
 	  		?> 
 	  	</label>
 	  </p>
 	  <p>
 	  	<label>Company Name* <br>
 	  		<input type='text' name='company_name' value=
 	  			"<?php echo $company_name; ?>"
 	  		>
 	  		</input>
 	  	</label>
 	  </p>
 	  <p>Contact Information*<br>
 	  	<label>Name <br>
 	  		<input type='text' name='contact_name' value=
 	  			"<?php echo $contact_name; ?>"
 	  		>
 	  		</input>
 	  	</label>
 	  	<br>
 	  	<label>Email <br>
 	  		<input type='text' name='contact_email' value=
 	  			"<?php echo $contact_email; ?>"
 	  		>
 	  		</input>
 	  	</label>		
 	  </p>

 	  <p>
 	  	<label>How to Apply* <br>
 	  		<p>Enter links or contact information where applications should be sent.</p>
 	  		<!-- <textarea cols="50" rows="8" name="job_apply"><?php echo $job_apply; ?></textarea> -->

 	  		<?php 

 	  		
			$editor_id = 'job_apply';
			$settings = array(
				'media_buttons' => false);
			
			wp_editor( $job_apply , $editor_id, $settings );
		
 	  		
 	  		?> 
 	  	</label>
 	  </p>
   <?php
	}

	

	function save_job_postings(){
  	global $post;
 
	  update_post_meta($post->ID, "job_title", $_POST["job_title"]);
	  update_post_meta($post->ID, "job_description", $_POST["job_description"]);
	  update_post_meta($post->ID, "company_name", $_POST["company_name"]);
	  update_post_meta($post->ID, "contact_name", $_POST["contact_name"]);
	  update_post_meta($post->ID, "contact_email", $_POST["contact_email"]);
	  update_post_meta($post->ID, "job_apply", $_POST["job_apply"]);
	}

	add_action('save_post', 'save_job_postings');
} //create_job_posting end


/**
 * List the taxonomies and terms for a given post
 * 
 * @param int $post_id
 * @return string
 */
function get_the_current_tax_terms_jobs( $post_id )
{
    // get taxonomies for the current post type
    $taxonomies = get_object_taxonomies( get_post_type( $post_id ) );

    // creates a subheading for each custom taxonomy that is a part of the listing
    foreach ( (array) $taxonomies as $taxonomy) {
    	echo "<span class='posting_subheading'>";
    	switch ($taxonomy) {
		    case 'career_fields':
		        echo "Career Fields</span> <br><br>";
		        break;
		    case 'regions':
		        echo "Regions</span> <br><br>";
		        break;
		    case 'job_types':
		        echo "Job Types</span> <br><br>";
		        break;
		    case 'regions_opportunity':
		        echo "Regions</span> <br><br>";
		        break;
		    case 'skills_opportunity':
		        echo "Skills</span> <br><br>";
		        break;
		    case 'time_commitment_opportunity':
		        echo "Time Commitment Desired</span> <br><br>";
		        break;
		}

		// finds the taxonomy terms for the specified post. if it finds taxonomy terms it will list them as links
    	$terms = get_the_terms( $post->ID, $taxonomy );
    	if ($terms == false){
        		echo 'N/A <br>';
        	}
    	if ( !empty( $terms ) )
        {
        	foreach ($terms as $term) {
        		$term_link =  get_term_link( $term->slug, $taxonomy );
        		echo "<a href=". $term_link. ">".  $term->name . '</a><br>';
        	}

	    }
	    echo "<br>";

    }  
}

// gets recent listings for the home page
function get_recent_listings($post_type)
{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'posts_per_page'   => 20,
	'offset'           => 0,
	'category'         => '',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'include'          => '',
	'paged' 		   => $paged,
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => "'". $post_type ."'",
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish',
	'suppress_filters' => true );

	$posts_array = get_posts( $args );

	// for job_posting
	if ($post_type == 'job_posting'){
		$job_listings_array = array();
	
	// creates a formated listing for each entry
		foreach ($posts_array as $key => $listing) {
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
			$new_div .='<a href="'. $permalink .'"> View Job Opening </a>';
			$new_div .= '</div>';
			array_push($job_listings_array, $new_div);
		}
		return $job_listings_array;
	}

	// for opportunity seekers
	if ($post_type == 'opportunity_posting'){
		$opportunity_listings_array = array();

		foreach ($posts_array as $key => $listing) {
			$post_title = $listing->post_title;
			$poster_name =  $listing->poster_name;
			$poster_desired = $listing->poster_desired;
			$post_id = $listing->ID;
			$permalink = get_permalink($post_id);

			$new_div = '<div class="listing-thumb">';
			$new_div .= '<b>' . $post_title . '</b>';
			$new_div .= '<p>' . $poster_name .'</p>';
			$new_div .= '<p>' .substr($poster_desired, 0,200) .'...</p>';
			$new_div .='<a href="'. $permalink .'"> View Profile </a>';
			$new_div .= '</div>';
			array_push($opportunity_listings_array, $new_div);
		}
		return $opportunity_listings_array;
	}
	

}

// creates job search form to use used through the site
function job_search_form(){

	echo $form = '<form role="search" method="get" id="searchform" action=' . home_url( '/' ) . 

 	'> ';
 	?>
		<input  type="text" name="s" id="s" placeholder="Search by keywords" value="" />
		<input type="hidden" name="post_type" value="job_posting" />
		<br><br>
		<select name="regions">
			<option value="">All Regions</option>
			<option value="hartford">Hartford</option>
			<option value="fairfield">Fairfield</option>
			 <option value="litchfield">Litchfield</option>
			 <option value="middlesex">Middlesex</option>
			 <option value="new_haven">New Haven</option>
			 <option value="new_london">New London</option>
			 <option value="tolland">Tolland</option>
			 <option value="windham">Windham</option>
		</select>
		<select name="career_fields">
			<option value="">All Career Fields</option>
			<option value="administrative">Administrative</option>
			<option value="biotech">biotech</option>
			 <option value="food_ag">Food & Agriculture</option>
			 <option value="healthcare">Health Care</option>
			 <option value="it">Technology</option>
			 <option value="media">Media</option>
		</select>
		<select name="job_types">
			<option value="">All Job Types</option>
			<option value="contract">Contract</option>
			<option value="full_time">Full Time</option>
			 <option value="internship">Internship</option>
			 <option value="part_time">Part Time</option>
		</select>
		<br /><br>
		<input type="submit" id="searchsubmit" value="Search" />
	</form>


<?php
	

    return $form;
}

add_filter( 'get_search_form', 'job_search_form' );

// returns job description for post
function job_description($id){
	$post = get_post_custom($id);
	return $post['job_description'][0];

}



// create custom post for opportunity seekers

	add_action('init', 'create_seeker_posting');
 
function create_seeker_posting() {
 
	$labels = array(
		'name' => _x('Opportunity Seekers', 'post type general name'),
		'singular_name' => _x('Opportunity Seeker Post', 'post type singular name'),
		'add_new' => _x('Add New', 'Opportunity Seeker Post'),
		'add_new_item' => __('Add Post'),
		'edit_item' => __('Edit Post'),
		'new_item' => __('New Post'),
		'view_item' => __('View Post'),
		'search_items' => __('Search Opportunity Seeker Postings'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/thumb.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail')
	  ); 
 
	register_post_type( 'opportunity_posting' , $args );


	register_taxonomy("skills_opportunity", array("opportunity_posting"), array("hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));
	register_taxonomy("regions_opportunity", array("opportunity_posting"), array("hierarchical" => true, "label" => "Regions", "singular_label" => "Region", "rewrite" => true));
	register_taxonomy("time_commitment_opportunity", array("opportunity_posting"), array("hierarchical" => true, "label" => "Time Commitment", "singular_label" => "Time Commitment", "rewrite" => true));

	add_action("admin_init", "admin_init");

	function admin_init(){
  	add_meta_box("opportunity_form_meta", "Opportunity Seeker Posting Form", "opportunity_form", "opportunity_posting", "normal", "low");
	}

	function opportunity_form(){
	global $post;
  	$custom = get_post_custom($post->ID);
	  $poster_name = $custom["poster_name"][0];
	  $poster_email = $custom['poster_email'][0];
	  $poster_background = $custom['poster_background'][0];
	  $poster_portfolio = $custom['poster_portfolio'][0];
	  $poster_desired = $custom['poster_desired'][0];

?>
	<p>Please fill out the form with some information about yourself and publish when completed. Required fields are listed and all fields are on the right sidebar are optional. Your listing will be reviewed by our Administrator before listed on the site.</p>

	<p>
		<label>Name:
			<br>
			<input type='text' name='poster_name' value='<?= $poster_name; ?>' >

		</label>
		<br>
		<label>Email:
			<br>
			<input type='text' name='poster_email' value='<?= $poster_email; ?>' >

		</label>
		<br><br>
		<label>Background/Experience: <br>
 	  		<?php 
	
			$editor_id = 'poster_background';
			$settings = array(
				'media_buttons' => false);
			
			wp_editor( $poster_background , $editor_id, $settings );
		
 	  		?> 
 	  	</label>
 	  	<br><br>
 	  	<label>Portfolio: <br>
 	  		Enter links, images, examples of your work.
 	  		<?php 
	
			$editor_id = 'poster_portfolio';
			$settings = array(
				'media_buttons' => false);
			
			wp_editor( $poster_portfolio , $editor_id, $settings );
		
 	  		?> 
 	  	</label>
 	  	<br><br>
 	  	<label>
 	  		Describe the experience or the situation you are looking for: <br>
 	  		<?php 
	
			$editor_id = 'poster_desired';
			$settings = array(
				'media_buttons' => false);
			
			wp_editor( $poster_desired , $editor_id, $settings );
		
 	  		?> 
 	  	</label>
	</p>


<?php 
	
	}

	add_action('save_post', 'save_opportunity_posting');

	function save_opportunity_posting(){
  	global $post;
 
	  update_post_meta($post->ID, "poster_name", $_POST["poster_name"]);
	  update_post_meta($post->ID, "poster_email", $_POST["poster_email"]);
	  update_post_meta($post->ID, "poster_background", $_POST["poster_background"]);
	  update_post_meta($post->ID, "poster_portfolio", $_POST["poster_portfolio"]);
	  update_post_meta($post->ID, "poster_desired", $_POST["poster_desired"]);
	}
} //create_opportunity_listing end


// Search bar for all opportunity seekers - to be used throughout the site
function opportunity_search_form(){
echo $form = '<form role="search" method="get" id="searchform" action=' . home_url( '/' ) . 

 	'> ';
 	?>
		<input  type="text" name="s" id="s" placeholder="Search by keywords" value="" />
		<input type="hidden" name="post_type" value="opportunity_posting" />
		<br><br>
		<select name="regions_opportunity">
			<option value="">All Regions</option>
			<option value="hartford">Hartford</option>
			<option value="fairfield">Fairfield</option>
			 <option value="litchfield">Litchfield</option>
			 <option value="middlesex">Middlesex</option>
			 <option value="new_haven">New Haven</option>
			 <option value="new_london">New London</option>
			 <option value="tolland">Tolland</option>
			 <option value="windham">Windham</option>
		</select>
		<select name="skills_opportunity">
			<option value="">All Skills</option>
			<option value="administrative-opportunity">Administrative</option>
			<option value="front-end">Front End Web Dev</option>
			 <option value="back-end">Back End Web Dev</option>
			 <option value="photo">Photography</option>
			 <option value="writing">Writing</option>
			 <option value="video-opportunity">Videography</option>
			 <option value="marketing">Marketing</option>
			 <!-- <option value=""></option>
			 <option value=""></option> -->
		</select>
		<select name="time_commitment_opportunity">
			<option value="">All Job Types</option>
			<option value="contract">Contract</option>
			<option value="full_time">Full Time</option>
			 <option value="internship">Internship</option>
			 <option value="part_time">Part Time</option>
		</select>
		<br /><br>
		<input type="submit" id="searchsubmit" value="Search" />
	</form>


<?php
	

    return $form;

}

function seeker_desired($id){
	$post = get_post_custom($id);
	return $post['poster_desired'][0];

}

function search_pagination() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link('Previous Page') );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link('Next Page') );

	echo '</ul></div>' . "\n";

}

function register_my_menu() {
  register_nav_menu('jb-menu',__( 'Job Board Menu' ));
}
add_action( 'init', 'register_my_menu' );

// function job_board_menu(){


?>
<!-- 	<div id='job_board_menu'>
 		<ul>
 			<li><a href="<?= home_url('?s=&post_type=job_posting')?>">Browse Jobs</a></li>
 			<li><a href="<?= home_url('?s=&post_type=opportunity_posting')?>">Browse Opportunity Seekers</a></li>
 			<li><a href="<?= home_url('post-a-listing')?>">Post a Listing</a></li>
 			<li><a href="<?= home_url('register')?>">Register</a></li>
 			<li><a href="<?= home_url('contact-us')?>">Contact Us</a></li>
 			<li><a href="">Login/Logout</a></li>
 		</ul>
 	</div>  -->



<?php	

// }

function job_board_menu(){

?>
	<nav id="job-navigation" class="main-navigation" role="navigation">
	<h3 id='job_board_menu' class="menu-toggle job_menu"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
	<?php wp_nav_menu( array( 'theme_location' => 'jb-menu', 'menu_class' => 'nav-menu job_menu' ) ); ?>

</nav>

<?php
}

 ?>