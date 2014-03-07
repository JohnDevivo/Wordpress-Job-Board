<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php 

					// get_template_part( 'content',get_post_format() );

					// $something = query_posts('post_type=job_posting');

					// var_dump($something);

					// $args = array(
					// 	'post_type' => 'job_posting',
					// 	'page_id' => $id,
					// 	'meta_query' => array(
					//        array(
					//            'job_title' => 'asdasd'
					//        )
					//    )

					// );
					// $query = new WP_Query( $args );
					// var_dump($query);

					$meta_values = get_post_meta( $id);
					// var_dump($meta_values);
					echo $meta_values['job_title'][0];
					echo "<br>";
					echo $meta_values['job_description'][0];
					echo "<br>";
				// 	$post = &get_post($post->ID);
    // // get post type by post
    // $post_type = $post->post_type;
    // // get post type taxonomies
    // $taxonomies = get_object_taxonomies($post_type);
    // var_dump($taxonomies);
					
					$tax = get_object_taxonomies($id, 'objects');
					var_dump($tax);
				 ?>

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>