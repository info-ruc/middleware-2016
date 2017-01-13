<?php 
$tags_m= get_option('mytheme_tags_m'); 
if($tags_m==""){
	include_once( 'category.php' ); 
 }else{
	include_once( $tags_m.'.php' ); 
	}  ?>
