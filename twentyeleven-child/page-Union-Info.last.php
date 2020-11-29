<?php
/*
Template name: UnionMenu Template
*/

get_header(); 
function display($param){
	echo $param."</br>";
}
?>
		<div id="primary" class="newsletter">
			<div id="content" role="main">
			 <?php //include dirname( __FILE__ ).'/template/content-subMenu.php';?>
				<?php //if ( has_nav_menu( 'cluq-menu' ) ) ://
				if ( is_active_sidebar( 'nouvelle_zone' ) ) :?>
					<div class="widget-area" role="complementary">
						<?php dynamic_sidebar( 'nouvelle_zone' );?>
						 
					</div><!-- .widget-area -->
				<?php endif; ?>
				<?php
				if(isset($_GET['uID'])){//uID is UQ category id
					
					if(isset($_GET['sID'])){//siD for subcategory id
						//get the id of a category by her name	
						//check cat here and sanetize siD same for uID
						$idCat=$_GET['sID'];
						//check cat here and sanetize siD same for uID
						$offset=isset($_GET['offset'])?$_GET['offset']:0;
						$category = get_category($idCat);
						if($category->cat_name=="Photos"){
						
							$args =array(
									'post_type' =>'attachment',
									'posts_per_page' =>-1,
									'cat'=> $idCat,
									'post_status' => 'any'
								//	'exclude'     =get_post_thumbnail_id()
								);
						}
						else{
							$args = array(
										'offset'=>$offset,
										'posts_per_page'=> $nbPostPerPage,
										'cat'=> $idCat,
										'post_status' => 'publish',
									);
						}
							$nbPostPerPage=5;
							$count=$category ->count;
								display($count);	
									// The Query
									$the_query = new WP_Query( $args );
									//echo $myCount = $the_query->found_posts;
									// The Loop
									if ( $the_query->have_posts() ) {
										
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
											$contentStyle="content-single";
											if($category->cat_name=="Partenaires"){
											$contentStyle="content-page";
										}
										elseif($category->cat_name=="Photos"){
											$contentStyle="content-image";
										
										}
											
											
											get_template_part( $contentStyle, get_post_format() );
											
											echo '<a name="fb_share" type="button_count" expr:share_url=\'data:post.url\' href="http://www.facebook.com/sharer.php">Partager</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>';
								
										}
										/* Restore original Post Data */
										wp_reset_postdata();
									} else {
										_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
									}
								$navPage='';
								if($offset-$nbPostPerPage>=0){
									$navPage.='<span><a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($offset-5).'" rel="previous" >précédent</a></span>';
								}
								if($count>$nbPostPerPage){
									for($i=0;$i<=$count;$i+=$nbPostPerPage){
										$navPage.='<span><a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($i).'" rel="next" >'.($i/$nbPostPerPage+1).'</a></span>';;
									}
								}
								
								if($offset+$nbPostPerPage<$count){
									$navPage.='<span><a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($offset+5).'" rel="next" >suivant</a></span>';
								}
								if($navPage!=""){
									echo '<p>'.$navPage.'</p>';
								}
							
						}
						
					} 
			
				/*else{
					_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
				}*/
				?>
				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>