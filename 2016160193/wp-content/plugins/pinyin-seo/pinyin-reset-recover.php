<?php
/*
Pinyin SEO
http://www.xuewp.com/pinyin-seo/
拼音SEO插件可在文章发布时自动将文章标题由中文转换成拼音格式，当前拼音数据库包含20966字，繁简通用，更有利于百度SEO,baidu就是最好的证明。已包含简单多音字功能。This plugin will convert Chinese characters to Pinyin(Latin alphabet for the romanization of Mandarin Chinese)in post title for SEO purpose.
Author: Chao Wang
http://www.xuewp.com/
*/
function reset_posts_name_to_pinyin(){
    set_time_limit(0);
	global $wpdb;
	$posts = $wpdb->get_results("SELECT ID,post_title,post_name FROM $wpdb->posts WHERE post_status='publish' AND post_type='post' ORDER BY id ASC");
	$i=0;
	foreach ($posts as $post) {
		$new_postname = pinyin_seo_specials(PinyinSEO($post->post_title));
		$sql = "UPDATE $wpdb->posts SET `post_name` = '{$new_postname}' WHERE id = '$post->ID'";
		$update = $wpdb->query($sql);
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有文章(post)的永久链接都已经扫描过! (一共有:<strong> $num </strong>篇文章的永久链接被改写成拼音格式)</p></div>";
}

function reset_pages_name_to_pinyin(){
    set_time_limit(0);
	global $wpdb;
	$posts = $wpdb->get_results("SELECT ID,post_title,post_name FROM $wpdb->posts WHERE post_status='publish' AND post_type='page' ORDER BY id ASC");
	$i=0;
	foreach ($posts as $post) {
		$new_postname = pinyin_seo_specials(PinyinSEO($post->post_title));
		$sql = "UPDATE $wpdb->posts SET `post_name` = '{$new_postname}' WHERE id = '$post->ID'";
		$update = $wpdb->query($sql);
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有页面(page)的永久链接都已经扫描过! (一共有:<strong> $num </strong>个页面的永久链接被改写成拼音格式)</p></div>";
}

function reset_category_slug_to_pinyin(){
    set_time_limit(0);
    $categories = get_terms('category',array(hide_empty=>'0'));
	$num = 0;
	foreach ($categories as $category) {
		wp_update_term($category->term_id, 'category', array('slug' => PinyinSEO($category->name) ) );
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有分类目录(category)的别名都已经扫描过! (一共有:<strong> $num </strong>个分类目录的别名被改写成拼音格式)</p></div>";
}

function reset_tag_slug_to_pinyin(){
    set_time_limit(0);
    $tags = get_terms('post_tag',array(hide_empty=>'0'));
	$num = 0;
	foreach ($tags as $tag) {
		wp_update_term($tag->term_id, 'post_tag', array('slug' => PinyinSEO($tag->name) ) );
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有标签(tag)的别名都已经扫描过! (一共有:<strong> $num </strong>个标签的别名被改写成拼音格式)</p></div>";
}

function recover_category_slug_to_pinyin(){
    set_time_limit(0);
    $categories = get_terms('category',array(hide_empty=>'0'));
	$num = 0;
	foreach ($categories as $category) {
		wp_update_term($category->term_id, 'category', array('slug' => sanitize_title($category->name) ) );
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有分类目录(category)的别名都已经扫描过! (一共有:<strong> $num </strong>个分类目录的别名被改写成中文格式)</p></div>";
}

function recover_tag_slug_to_pinyin(){
    set_time_limit(0);
    $tags = get_terms('post_tag',array(hide_empty=>'0'));
	$num = 0;
	foreach ($tags as $tag) {
		wp_update_term($tag->term_id, 'post_tag', array('slug' => sanitize_title($tag->name) ) );
		$num += 1;
	}
	echo " <div class=\"updated\"><p>操作成功：所有标签(tag)的别名都已经扫描过! (一共有:<strong> $num </strong>个标签的别名被改写中文格式)</p></div>";
}
?>