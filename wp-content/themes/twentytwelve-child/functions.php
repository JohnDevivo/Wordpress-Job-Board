<?php 




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
		 // 'supports' => array('title','editor','thumbnail')
		'supports' => array('title', 'thumbnail')
	  ); 

	register_post_type( 'job_posting' , $args );
	flush_rewrite_rules();

	
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

	

	function save_details(){
  	global $post;
 
	  update_post_meta($post->ID, "job_title", $_POST["job_title"]);
	  update_post_meta($post->ID, "job_description", $_POST["job_description"]);
	  update_post_meta($post->ID, "company_name", $_POST["company_name"]);
	  update_post_meta($post->ID, "contact_name", $_POST["contact_name"]);
	  update_post_meta($post->ID, "contact_email", $_POST["contact_email"]);
	  update_post_meta($post->ID, "job_apply", $_POST["job_apply"]);
	}

	add_action('save_post', 'save_details');
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

    foreach ( (array) $taxonomies as $taxonomy) {
    	switch ($taxonomy) {
		    case 'career_fields':
		        echo "<span class='posting_subheading'>Career Fields </span> <br><br>";
		        break;
		    case 'regions':
		        echo "<span class='posting_subheading'>Regions </span> <br><br>";
		        break;
		    case 'job_types':
		        echo "<span class='posting_subheading'>Job Types </span> <br><br>";
		        break;
		}
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

function change_default_title( $title ){
 
    $screen = get_current_screen();
 
    if ( 'job_posting' == $screen->post_type ){
        $title = 'Enter Description Here - This is what will show up in Search';
    }
 
    return $title;
}
 
add_filter( 'enter_title_here', 'change_default_title' );


function get_all_listings($post_type){
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'posts_per_page'   => -1,
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

	 // foreach ($posts_array as  $value) {
	 // 	echo $value->post_title ."<br>";
	 // }

	return $posts_array;
	
}

// redirects blank search from index page to show all posts
add_filter( 'request', 'blank_search' );
function blank_search( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}


function job_search_form($form){

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

 ?>