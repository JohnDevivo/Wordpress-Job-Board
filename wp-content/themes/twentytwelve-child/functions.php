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
 	  		<textarea cols="50" rows="8" name="job_description"><?php echo $job_description; ?></textarea>
 	  		<?php 

 	  		// revisit wp_editor
 	 //  		$contents1 = '';
			// $editor_id = 'jobdescription';
			// $settings = array(
			// 	'media_buttons' => false);
			
			// wp_editor( $contents1, $editor_id, $settings );
			// var_dump($contents1);
 	  		
 	  		
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
 	  		<textarea cols="50" rows="8" name="job_apply"><?php echo $job_apply; ?></textarea>
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



}



 ?>