<?php
/*
Plugin Name:简单广告框
Plugin slug :themepark-advertisement
Plugin URI:http://www.themepark.com.cn
Description:这是WEB主题公园所开发的一款广告弹出框插件，插件十分简单，可以在首页弹出一个广告框，并可以选择用户打开之后的多少时间以内不再显示，并且支持独立制作一个移动版的广告，移动版广告支持响应式主题和服务器端Mobile_Detect判断支持的主题。
Version: 1.0
Author: WEB主题公园
Author URI: http://www.themepark.com.cn
*/

/* plugin-update-checker */

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = new PluginUpdateChecker(
    'http://www.themepark.com.cn/upthemes_themepark/themepark_advertisement/themepark_advertisement.json',
    __FILE__,
    'themepark-advertisement'
);


add_action('admin_menu', 'themepark_advertisement');
function themepark_advertisement() {
	if(function_exists('add_menu_page')) {
		add_menu_page('themepark_advertisement', '简单广告框', 'administrator', plugin_dir_path(__FILE__).'/themepark_advertisement_settings.php', '', plugins_url('themepark_advertisement.png', __FILE__ ));
	}
	
}

function themepark_advertisement_style() {
	
	
$themepark_advertisement_time  = get_option('themepark_advertisement_time');
$themepark_advertisement_pc_width  = get_option('themepark_advertisement_pc_width');
$themepark_advertisement_pc_height  = get_option('themepark_advertisement_pc_height');
$themepark_advertisement_pc_magie  = get_option('themepark_advertisement_pc_magie');


$themepark_advertisement_mo_width  = get_option('themepark_advertisement_mo_width');
$themepark_advertisement_mo_height  = get_option('themepark_advertisement_mo_height');
$themepark_advertisement_mo_magie  = get_option('themepark_advertisement_mo_magie');

	if(!$themepark_advertisement_pc_width){$themepark_advertisement_pc_width='auto';};
	if(!$themepark_advertisement_pc_height){$themepark_advertisement_pc_height='auto';};
	if(!$themepark_advertisement_pc_magie){$themepark_advertisement_pc_magie='15%';};
	
	if(!$themepark_advertisement_mo_width){$themepark_advertisement_mo_width='auto';};
	if(!$themepark_advertisement_mo_height){$themepark_advertisement_mo_height='auto';};
	if(!$themepark_advertisement_mo_magie){$themepark_advertisement_mo_magie='10%';};
	
	
	$themepark_advertisement_style.='
	
<style>
.themepark_advertisement img{max-width:100%;height:auto;}	
.themepark_advertisement .alignleft {
   display:inline;
   float:left;
   margin-right:0;
}
.themepark_advertisement .alignright {
   display:inline;
   float:right;
   margin-left:0;
}
.themepark_advertisement .aligncenter {
   clear:both;
   display:block;
   margin-left:auto;
   margin-right:auto;
}
.themepark_advertisement{ width:100%; height:1000px; position:fixed; overflow:hidden;top:0; left:0; z-index:100000; text-align:center;}
.themepark_advertisement_ba{width:100%; height:100%; position: absolute; top:0; left:0; z-index:1; overflow:hidden; background:#000; opacity:0.5;filter:Alpha(opacity=40);}
.themepark_advertisement_in{ max-width:90%; width:'.$themepark_advertisement_pc_width.'; height:'.$themepark_advertisement_pc_height.'; background:#FFF; padding:0 10px 10px 10px; position:relative; margin-top:'.$themepark_advertisement_pc_magie.'; box-shadow:0 0 5px #000000;display:inline-block ;z-index:2; }
.themepark_advertisement_in_mo{ display:none;}
.themepark_advertisement_close{ width:100%;  height:30px; position:relative; }
.themepark_advertisement_close_in{ width:30px; height:20px; background:#F60; position:absolute; color:#FFF; line-height:20px; text-align:center; top:0; right:-10px; font-family:Arial, Helvetica, sans-serif;cursor:pointer;}
@media screen and (min-width:200px) and (max-width:700px){
#themepark_advertisement_in_mo{ display:block;}	
#themepark_advertisement_in_pc{ display:none;}
#themepark_advertisement_in{ width:'.$themepark_advertisement_mo_width.'; height:'.$themepark_advertisement_mo_height.';  margin-top:'.$themepark_advertisement_mo_magie.';  }
}
</style>

	';
	if(is_home()&&!$_COOKIE['themepark_advertisement']){echo $themepark_advertisement_style;}
	}
add_action( 'wp_head', 'themepark_advertisement_style');


function themepark_advertisement_post() {
$themepark_advertisement_show  = get_option('themepark_advertisement_show');
$themepark_advertisement_pc_content  = wpautop( stripslashes(get_option('themepark_advertisement_pc_content')));
$themepark_advertisement_mo_content  = wpautop( stripslashes(get_option('themepark_advertisement_mo_content')));
if(!$themepark_advertisement_mo_content){$themepark_advertisement_mo_content =wpautop( stripslashes(get_option('themepark_advertisement_pc_content')));}

if(!$themepark_advertisement_show){
	$themepark_advertisement_cookies_scrpt='<script>
	$(document).ready(function(){ 
    $(".themepark_advertisement_in").click(function(){
	$.cookie("themepark_advertisement", "donotopen");  
  });
  
   $(".themepark_advertisement_close_in").click(function(){
	$(".themepark_advertisement").fadeOut();
  });
  });
	
	</script>';

	}else{
		$themepark_advertisement_cookies_scrpt='<script>
	$(document).ready(function(){ 
    $(".themepark_advertisement_close_in").click(function(){
	$(".themepark_advertisement").fadeOut();
  });
  });
	
	</script>';
		
		}
	
	$themepark_advertisement_post.='
	
	    <div class="themepark_advertisement">
		
		<div id="themepark_advertisement_in" class="themepark_advertisement_in">
		 <div class="themepark_advertisement_close"><div class="themepark_advertisement_close_in">X</div></div>
		<div id="themepark_advertisement_in_pc" >'.$themepark_advertisement_pc_content.'</div>
		<div id="themepark_advertisement_in_mo" class="themepark_advertisement_in_mo" >'.$themepark_advertisement_mo_content.'</div>
		
		</div>
		
		<div id="themepark_advertisement_ba" class="themepark_advertisement_ba"></div>
		
		</div>
		<script language="javascript"  src="'. plugins_url('/themepark-advertisement/jquery.cookie.js').'" ></script>
	'.$themepark_advertisement_cookies_scrpt.'

	
	';
	if(is_home()&& !$_COOKIE['themepark_advertisement']){echo $themepark_advertisement_post;}
	
	}

add_action( 'wp_footer', 'themepark_advertisement_post');


?>