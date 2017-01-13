<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php 
ob_start();
?>
    <?php if (get_option('mytheme_eso_jr') == ""){ ?>
   
<meta name="keywords" content=" <?php if(is_front_page() || is_home()) { 
	echo get_option('mytheme_keywords');} else if( is_page()) {
        if(get_post_meta($post->ID, "关键字",true)){
		echo get_post_meta($post->ID, "关键字",true);}
		else{
		echo get_post_meta($post->ID, "关键字",true);
		}
	} else if(is_single()) {
  if(get_post_meta($post->ID, "关键字",true)){
		 if(get_post_meta($post->ID, "关键字",true)){
		echo get_post_meta($post->ID, "关键字",true);}
		else{
			echo get_option('mytheme_keywords');
		}
		}
	// 如果是类目页面, 显示类目表述
	}  else {
		echo get_option('mytheme_keywords');
	}?>   " />
<meta name="description" content="<?php if(is_front_page() || is_home()) { 
	echo get_option('mytheme_description');
 
	// 如果是文章详细页面和独立页面
	}
 else if(is_page() ) {
		if(get_post_meta($post->ID, "描述",true)){
		echo get_post_meta($post->ID, "描述",true);}
		else{
			echo  substr(strip_tags($post->post_content), 0, 420);
		}
	// 如果是类目页面, 显示类目表述
	} 
	 else if(is_single() ) {
		 if(get_post_meta($post->ID, "描述",true)){
		echo get_post_meta($post->ID, "描述",true);}
		else{
			echo  substr(strip_tags($post->post_content), 0, 420);
		}
	
	// 如果是类目页面, 显示类目表述
	}  else {
		echo   get_option('mytheme_description');
	}
?>" />

	<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" /> 
	<?php } };?>

<title><?php
		   if(get_option('mytheme_word_t12')==""){$word_t12='找到标签';}else{ $word_t12=get_option('mytheme_word_t12');};
		   if(get_option('mytheme_word_t9')!=""){$word_t9=get_option('mytheme_word_t9');}else{$word_t9='搜索结果：';}  
		     if(get_option('mytheme_word_t10')!=""){$word_t10=get_option('mytheme_word_t10');}else{$word_t9='很遗憾，没有找到你要的信息：';}  
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title($word_t12."&quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo '  - '; }
		      elseif (is_search()) {
		         echo $word_t9.' &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo $word_t10.'- '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged;echo ' - '; bloginfo('description'); }
		   ?></title>
<?php  $logo= get_option('mytheme_logo') ; $ico= get_option('mytheme_ico');


?>
<link rel="shortcut icon" href="<?php echo $ico; ?>" type="image/x-icon" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head();echo $debug; ?>

 

</head>

<?php
  $language1=get_option('mytheme_language1');
			$language2=get_option('mytheme_language2');
			$language_link1=get_option('mytheme_language_link1');
			$language_link2=get_option('mytheme_language_link2');
			
			 $language3=get_option('mytheme_language3');
			$language4=get_option('mytheme_language4');
			$language_link3=get_option('mytheme_language_link3');
			$language_link4=get_option('mytheme_language_link4');
				$language_title=get_option('mytheme_language_title');  if (!is_user_logged_in()) {
	   global $current_user;    get_currentuserinfo();
			  $user_ID = $current_user->id ;
	      if( !current_user_can( 'manage_options' ) ) {

      $header_over='style="top:0;"';

    }
	  }

 ?>

<body <?php body_class();?> >
    <div class="header">
  
         <div class="header_in">
               <div class="header_center">
                <?php if(is_home()){ ?>  <h1 class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php echo  bloginfo('name'); ?>"> <img src="<?php  if(get_option('mytheme_logo')){echo get_option('mytheme_logo');}else{echo get_bloginfo('template_url').'/images/logo.jpg';}; ?>" alt="<?php echo  bloginfo('name'); ?>"/></a></h1><?php }else{ ?>
                 <div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php echo  bloginfo('name'); ?>"> <img src="<?php  if(get_option('mytheme_logo')){echo get_option('mytheme_logo');}else{echo get_bloginfo('template_url').'/images/logo.jpg';}; ?>" alt="<?php echo  bloginfo('name'); ?>"/></a></div>
                 <?php } ?>
                 
               
                 
                   <?php get_template_part( 'inc/nav' ); ?>
               
               
               <div class="top">
               
                    <?php 
				
			  		 $theme_shop_open = get_option('mytheme_theme_shop_open'); 
		 	$shop_login = get_option('shop_login');
		    $shop_register = get_option('shop_register');
	      	$shop_profile = get_option('shop_profile');
			$shop_edit_profile = get_option('shop_edit_profile'); 
			$shop_bbs_open=get_option('shop_bbs_open');
			$bbs_my_page=get_option('bbs_my_page');
			
 if($theme_shop_open){
	 
	 if (is_user_logged_in()) {
		  global $current_user;    get_currentuserinfo();
			  $user_ID = $current_user->id ;
			   ?>
              
               <a class="profie" href="<?php echo get_page_link( $shop_profile );  ?>">我的个人中心</a>
                <a class=" loginout" href="<?php echo wp_login_url(); ?>">登出</a>
              <?php }else{ ?>
              
              <a class="login" href="<?php echo get_page_link( $shop_login );  ?>">登录</a>
               <a class="reg" href="<?php echo get_page_link($shop_register );  ?>">注册</a>
            <?php } } ?>
                <?php if($language_title){ ?> <a class="language"><?php echo $language_title; ?> <div class="smaill_dwon"></div></a> 
			 <?php } ?>
                </div>
                
          
               </div> 
             
       
         </div>
     
    
       </div>