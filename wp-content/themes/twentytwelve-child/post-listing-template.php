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
			<br><br>
			<a href="<?= home_url( '/attach-link-file' ) ?>"><button>View Form</button></a>
			</div>
			<div class='third-space'>
			Post a listing without registration
			<br><br>
			<a href="<?= home_url( '/post-a-job-listing' ) ?>"><button>Post a Job Listing</button></a>
			<br><br>
			<a href="<?= home_url( '/post-op-seeker-listing' ) ?>"><button>Post an Opportunity Seeker Listing</button></a>
			</div>
			<div class='third-space'>
			Register and have full control of your posts
			<br><br>
			<a href="<?= home_url( '/register' ) ?>"><button>Register Here</button></a>
			<br><br>
			<a href="<?= home_url( '/login' ) ?>"><button>Log In</button></a>
			</div>
			
			

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>