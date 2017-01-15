<?php 
/* 
 * recent post most
 * ====================================================
*/
function hui_recent_posts_most() { 
    global $wpdb;
    // $days=400;
    $days=_hui('most_list_date');
    $limit=_hui('most_list_number');
    $output = '';
    
    if( !_hui('most_list_style') || _hui('most_list_style')=='comment' ){

        $today = date("Y-m-d H:i:s");
        $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );  
        $result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' AND post_status='publish' AND post_type='post' ORDER BY comment_count DESC LIMIT 0 , $limit");
        if(empty($result)) {
            $output = '<li>'.__('暂无文章！', 'haoui').__('近期有评论的文章才会显示在这里，你也可以在主题设置中选择按阅读数排行。', 'haoui').'</li>';
        } else {
            $i = 1;
            foreach ($result as $topten) {
                $postid = $topten->ID;
                $title = $topten->post_title.get_the_subtitle();
                $commentcount = $topten->comment_count;
                if ($commentcount != 0) {
                    $output .= '<li><p class="text-muted"><span class="post-comments">'.__('评论', 'haoui').' ('.$commentcount.')</span>'.hui_get_post_like($class='post-like', $pid=$postid).'</p><span class="label label-'.$i.'">'.$i.'</span><a'.hui_target_blank().' href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a></li>';
                    $i++;
                }
            }
        }

    }else if( _hui('most_list_style')=='view' ){

        global $post;
        $limit_date = current_time('timestamp') - ($days*86400);
        $limit_date = date("Y-m-d H:i:s",$limit_date);
        $where = '';
        $mode = 'post';

        if(!empty($mode) && $mode != 'both') {
            $where = "post_type = '$mode'";
        } else {
            $where = '1=1';
        }

        $most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");

        if($most_viewed) {
            $i = 1;
            foreach ($most_viewed as $post) {
                $title = get_the_title().get_the_subtitle();
                $post_views = intval($post->views);
                // $output .= '<li class="item-'.$i.'"><a target="_blank" href="'.get_permalink($postid).'">'._get_post_thumbnail(array()).'<h2>'.$post_title.'</h2><p>'.hui_get_post_date( get_the_time('Y-m-d H:i:s') ).'<span class="post-views">阅读('.$post_views.')</span></p></a></li>';
                $output .= '<li><p class="text-muted"><span class="post-comments">'.__('阅读', 'haoui').' ('.$post_views.')</span>'.hui_get_post_like($class='post-like', $pid=$postid).'</p><span class="label label-'.$i.'">'.$i.'</span><a'.hui_target_blank().' href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a></li>';
                $i++;
            }
        } else {
            $output = '<li>'.__('暂无文章！', 'haoui').'</li>';
        }
    }

    echo '<div class="most-comment-posts">
            <h3 class="title"><strong>'._hui('most_list_title').'</strong></h3>
            <ul>'.$output.'</ul>
        </div>';
}