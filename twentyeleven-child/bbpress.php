<?php
/*
Template name: Newsletter Template
*/

get_header(); ?>

		<div id="primary" class="bbpress-template-page">
		
			<div id="content" role="main">
				 <?php include dirname( __FILE__ ).'/template/content-subMenu.php';?>
				<?php if ( is_active_sidebar( 'bbp-sidebar' ) ) :
						
				?>
					<div class="widget-area" role="complementary">	
						<?php dynamic_sidebar( 'bbp-sidebar' ); ?>
						
					</div><!-- .widget-area -->
				<?php endif; ?>
				<?php
				
				if ( have_posts() ) : 
					while ( have_posts() ) :
						the_post();
						?>

						<?php
						/*
						 * We are using a heading by rendering the_content
						 * If we have content for this page, let's display it.
						 */
						if ( '' != get_the_content() ) {
							 include dirname( __FILE__ ).'/template/content-newsletter.php';
							//get_template_part( 'content', 'template/newsletter');
						}
						?>
						
					<?php
					endwhile;
				else :
					_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
				endif;
				?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>