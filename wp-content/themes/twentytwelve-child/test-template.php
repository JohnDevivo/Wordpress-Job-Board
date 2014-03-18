<?php
/*
 * Template Name: Test Template
 * Description: First try at custom template
 */


get_header();
 ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<h1>Test Page</h1>

<?php
			$array = test_post_expiration();
			// $current_time = date('Y-m-d H:i:s');
			$current_time = date_create('now');
			// var_dump($array);
			$days_active = 30;
			foreach ($array as $key => $value) {
				// var_dump($value);

				// retrieves the post date and then changes it to a DateTime
				$post_date = $value->post_date;
				$post_date = date_create($post_date);

				//$interval is how much time it's been since the original post date. 
				$interval = date_diff($current_time, $post_date);

				// echo "Day:" . $interval->d . "Hours:". $interval->h ."Minutes:".$interval->i ."Seconds:" . $interval->s . "<br>" ;

				// if $interval is more than $days_active then make it pending and send an email to admin & poster letting them know the post has expired.
				if ($interval > $days_active){

					$post_id = $value->ID;
					$update_post = array(
						'ID'  => $post_id,
						'post_status' => 'pending'

						);
					
					// uncomment when it's ready to go live
					// wp_update_post(add update post here);

				}
				else{
					// stop the loop here
					// $post_id = $value->ID;
					// $stuff = get_post_meta($post_id);
					// var_dump($stuff);

				}

			}

?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>