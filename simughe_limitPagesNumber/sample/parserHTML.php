<?php
	add_filter( 'the_content', 'wrap_nongallery_aside' );
	function wrap_nongallery_aside($content){
	if(is_admin()){
		return  $content;
	}
	 $template = get_post_meta(get_the_ID(), '_wp_page_template', true);
	 
    if ($template !== 'page-search.php'){
        return $content;
    }
	
    /*
    Do something to $content
    */
    
    $dom = new DOMDocument();
	$dom->encoding = 'UTF-8';
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'),LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	$list = $dom->getElementsByTagName('li');
	foreach ($list as $li) {
		$links=$li->getElementsByTagName('a');
		if($links->count()>0 ){
				$a=$links[0];
				$a->setAttribute('href',$a->getAttribute('href'));
				//echo "<a href=".$a->getAttribute('href').">".$a->nodeValue."</a><br>\n";
			
		}
		else{
			$a=$dom->createElement('a',$li->nodeValue);
			//echo $li->nodeValue."<br>\n";
			$a->setAttribute('href',"http://google.com");
			//$a->nodeValue=$li->nodeValue;
			$li->nodeValue="";
			$li->appendChild($a);
			
		}
	}
     
    return $dom->saveHTML($dom->documentElement);

}
?>