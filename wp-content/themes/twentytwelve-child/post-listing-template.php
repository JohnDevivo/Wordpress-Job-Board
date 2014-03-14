<?php
/*
 * Template Name: Post a Listing Template
 * Description: Template for posting a listing options
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<p>Three Options to Post</p>
			<br><br><br>
			<div class='third-space'>
			Send us a link or attach a file
			</div>
			<div class='third-space'>
			Fill out our form without registration
			<br><br>
			<a href="<?= home_url( '/?page_id=261' ) ?>"><button>Post a Job Listing</button></a>
			</div>
			<div class='third-space'>
			Register and have full control of your posts
			<br><br>
			<a href="<?= home_url( '/?page_id=31' ) ?>"><button>Register Here</button></a>
			<br><br>
			<a href="<?= home_url( '/?page_id=29' ) ?>"><button>Log In</button></a>
			</div>
			
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>