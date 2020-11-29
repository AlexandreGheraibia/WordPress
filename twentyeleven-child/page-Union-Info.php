<?php
/*
Template name: UnionMenu Template
*/

get_header(); 

echo '<style>

</style>';
function display($param){
	echo $param."</br>";
	
}

function getPostCount($name,$id){
	if(($query=getPostByName( $name,$id,0,-1))!=null){
		return sizeof($query);
	}
	return 0;
}

function getPostByName( $name,$id,$offset,$nbPostPerPage) {
	global $wpdb;
	$search_query = "SELECT ID FROM $wpdb->posts
                         WHERE post_type = 'attachment'
						 AND post_title LIKE '%$name%'
						 ";
	$results = $wpdb->get_results($search_query, ARRAY_N);

	foreach($results as $array){
		 $attachment_ids[] = $array[0];
	}
	
	return !isset($attachment_ids)?null:get_posts(array('offset'=>$offset,'posts_per_page' =>$nbPostPerPage,'post_type'=>'attachment','category'=>$id, 'post__in' =>  $attachment_ids));
}
?>
		<div id="primary" class="uq" >
			<div id="content" >
				<div id="uq_list_container">
					<?php dynamic_sidebar( 'nouvelle_zone' );?>
				</div>
			 <?php //include dirname( __FILE__ ).'/template/content-subMenu.php';?>
			 <div class="uq_menu_tab"></div>
				<?php //if ( has_nav_menu( 'cluq-menu' ) ) ://
				if ( is_active_sidebar( 'nouvelle_zone' ) ) :?>
					<div class="widget-area" role="complementary">
						<aside id="nouvelle-zone" class="widget">
						<?php dynamic_sidebar( 'nouvelle_zone' );?>
						 </aside>
					</div><!-- .widget-area -->
				<?php endif; ?>
				<?php
				if($_GET['uID']==null&&$_GET['sID']==null){
					$_GET['uID']=76;
					$_GET['sID']=77;
					
				}
				if(isset($_GET['uID'])){//uID is UQ category id
					
					if(isset($_GET['sID'])){//siD for subcategory id
						//get the id of a category by her name	
						//check cat here and sanetize siD same for uID
						$idCat=$_GET['sID'];
						//check cat here and sanetize siD same for uID
						$offset=isset($_GET['offset'])&&$_GET['offset']!=''?$_GET['offset']:0;
						$category = get_category($idCat);
						if($category->cat_name=="Photos"){
							
								$nbPostPerPage=16;
								
								$features= array(
									'post_type' =>'attachment',
									'offset'=>$offset,
									'posts_per_page' =>$nbPostPerPage,
									'cat'=> $idCat,
									'orderby' => 'date',
									'order'   => 'DESC',
									
								//	'exclude'     =get_post_thumbnail_id()
								);
								if(isset($_GET['lfp'])){//mots clés recherchés
									$count=getPostCount($_GET['lfp'],$idCat);
									$attachments=getPostByName($_GET['lfp'],$idCat,$offset,$nbPostPerPage);
								}
								else{
									$count=$category ->count;
									$attachments=get_posts($features);
								}
								if ( $attachments ) {
									$wrapperContent="";
									echo '<div class="type-post">';
										echo '<div class="uq-gallerie center">';
											echo '<div class="row">';
												echo '<div class="row-right">';
												get_template_part( "template/content-uq-searchform", get_post_format() );
												echo '</div>';
											echo '</div>';
											$i=0;
											foreach ( $attachments as $attachment ) {
												if($i%4==0){
													if($i!=0){
														echo '</div>';
													}
													echo '<div class="row ">';
												}
												
												$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
												$pictureLink = wp_get_attachment_image($attachment->ID,'thumbnail',false,array( "onclick"=>"myFunction(this);") );
												//$pictureLink =wp_get_attachment_link( $attachment->ID, 'thumbnail', true );
												echo '<div class="column ' . $class.' ">' . $pictureLink . '</div>';
												$wrapperContent.='<li>'.wp_get_attachment_link( $attachment->ID, 'default', true );
												$wrapperContent.='<div class="sb-description">';
												$wrapperContent.='<h3>'.sanitize_title(get_the_title($attachment)).'</h3>';
												$wrapperContent.='</div>';
												$wrapperContent.='</li>';
												$i++;
											} 
										echo '</div>';
										echo '<div class="wrapper ">';
											echo '<div class="slider">';
											echo '<ul id="sb-slider" class="sb-slider">';
											echo $wrapperContent;
											echo '</ul>';
											echo'
														<div id="nav-arrows" class="nav-arrows">
															<a href="#">Next</a>
															<a href="#">Previous</a>
														</div>	
												</div>
										</div><!-- /wrapper -->';
									echo '</div>';
								}
								else {
										_e( 'Désolé, aucune photo ne correspond à vos critères.', 'twentyeleven' );
									}
							}
						
						else{
							$nbPostPerPage=5;
							$count=$category ->count;
									$args = array(
										'offset'=>$offset,
										'posts_per_page'=> $nbPostPerPage,
										'cat'=> $idCat,
										'post_status' => 'publish',
										'orderby' => 'date',
										'order'   => 'DESC',
									);
									// The Query
									$the_query = new WP_Query( $args );
									//echo $myCount = $the_query->found_posts;
									// The Loop
									if ( $the_query->have_posts() ) {
										
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
											$contentStyle="template/content-uq-single";
											if($category->cat_name=="Partenaires"){
												$contentStyle="template/content-uq-page";
											}
											
											
											get_template_part( $contentStyle, get_post_format() );
											
										
										}
										/* Restore original Post Data */
										wp_reset_postdata();
									} else {
										_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
									}
							
							}
								$navPage='';
								if($offset-$nbPostPerPage>=0){
									$navPage.='<a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($offset-$nbPostPerPage).(isset($_GET['lfp'])?('&lfp='.$_GET['lfp']):'').'" rel="précédent" >&laquo;</a>';
								}
								if($count>$nbPostPerPage){
									//display($count);
									for($i=0;$i<ceil($count/$nbPostPerPage);$i++){
										$navPage.='<a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($i*$nbPostPerPage).(isset($_GET['lfp'])?('&lfp='.$_GET['lfp']):'').'" rel="index page" '.($i*$nbPostPerPage==$offset?'class="ui-active"':'').'>'.($i+1).'</a>';
									}
								}
								
								if($offset+$nbPostPerPage<$count){
									$navPage.='<a href="?uID='.$_GET['uID'].'&sID='.$_GET['sID'].'&offset='.($offset+$nbPostPerPage).(isset($_GET['lfp'])?('&lfp='.$_GET['lfp']):'').'" rel="next" >&raquo;</a>';
								}
								if($navPage!=""){
									echo '<div class="pagination" >'.$navPage.'</div>';
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