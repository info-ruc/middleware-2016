<?php 

class news_index extends WP_Widget {

	function news_index()
	{
		$widget_ops = array('classname'=>'news_index','description' => get_bloginfo('template_url').'/images/xuanxiang/4.gif');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="news_index",$name='新闻模块【内容排版区模块】',$widget_ops,$control_ops);  

	}

	function form($instance) { 
	
	    	
	
		 $left_right=esc_attr($instance['left_right']);
		 $first_mod = esc_attr($instance['first_mod']);
		 $my_b_images = esc_attr($instance['my_b_images']);
		 $my_b_images_ad = esc_attr($instance['my_b_images_ad']);
      	 $nnmber = esc_attr($instance['nnmber']); 
		  $nnmber2 = esc_attr($instance['nnmber2']); 
	     $w_cat = esc_attr($instance['w_cat']);
		  $my_text2 = esc_attr($instance['my_text2']);
		 $title = esc_attr($instance['title']);

	?>
<p style="display:block; width:100%; border-bottom:1px #333333 solid; padding:5px; margin:5px;"><strong>模块属性设置</strong></p>






<p>
 <label  for="<?php echo $this->get_field_id('my_text2'); ?>">文字模块-标题:</label>
 <input type="text" size="40" value="<?php echo $my_text2 ; ?>" name="<?php echo $this->get_field_name('my_text2'); ?>" id="<?php echo $this->get_field_id('my_text2'); ?>"/>
 </p>
<p>
 <label  for="<?php echo $this->get_field_id('title'); ?>">文字模块-副标题:</label> 
<input type="text" size="40" value="<?php echo $title ; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"/>
</p>



<p>
<label  for="<?php echo $this->get_field_id('w_cat'); ?>">选择分类1:</label><br />
             <select id="<?php echo $this->get_field_id('w_cat'); ?>" name="<?php echo $this->get_field_name('w_cat'); ?>" >
              <option value=''>不显示</option>
<?php 
		 $categorys = get_categories();
		$sigk_cat2= $w_cat;
		foreach( $categorys AS $category ) { 
		 $category_id= $category->term_id;
		 $category_name=$category->cat_name;
		?>
       
			<option 
				value='<?php echo  $category_id; ?>'
				<?php
					if ( $sigk_cat2 == $category_id ) {
						echo "selected='selected'";
					}
				?>><?php echo  $category_name; ?></option>
		<?php } ?>
	</select>

</p>


<p><label for="<?php echo $this->get_field_id('nnmber2'); ?>"><?php esc_attr_e('显示数量(默认4):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('nnmber2'); ?>" name="<?php echo $this->get_field_name('nnmber2'); ?>" type="text" value="<?php echo $nnmber2; ?>" /></label></p>


<p>
  <label  for="<?php echo $this->get_field_id('my_b_images'); ?>">背景图片:</label><br />
 <input type="text" size="40" value="<?php echo $my_b_images ; ?>" name="<?php echo $this->get_field_name('my_b_images'); ?>" id="<?php echo $this->get_field_id('my_b_images'); ?>"/>
 
 <a id="ashu_upload" class="left_right_upload_button button" href="#">上传</a>
 
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">（尺寸宽度为1920，高度取决于你的的内容，建议上传可以无限重复的背景图片）</em>
 
</p> 


	<?php
    }
	function update($new_instance, $old_instance) { // 更新保存
		return $new_instance;
	}
	function widget($args, $instance) { // 输出显示在页面上
	extract( $args );
	     $id =$instance['id'];
        $before_content = $instance['before_content'];
        $after_content = $instance['after_content'];
		$left_right = apply_filters('widget_title', empty($instance['left_right']) ? __('') : $instance['left_right']);
		$first_mod = apply_filters('widget_title', empty($instance['first_mod']) ? __('') : $instance['first_mod']);
		$my_b_images  = apply_filters('widget_title', empty($instance['my_b_images']) ? __('') : $instance['my_b_images']);
        $my_b_images_ad  = apply_filters('widget_title', empty($instance['my_b_images_ad']) ? __('') : $instance['my_b_images_ad']);
	    $w_cat = apply_filters('widget_title', empty($instance['w_cat']) ? __('') : $instance['w_cat']);
	    $nnmber = apply_filters('widget_title', empty($instance['nnmber']) ? __('4') : $instance['nnmber']);
	   $my_text2  = apply_filters('widget_title', empty($instance['my_text2']) ? __('') : $instance['my_text2']);
		$title  = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title']);
	
	 $args = array( 'cat' => $w_cat , 'showposts' => $nnmber , 'post__in' =>$post__in );     $query = new WP_Query( $args );  
	 	if($my_b_images){
			
			$my_b_imagess='background: center url('.$my_b_images.');';
			$modle_style='style="'.$my_hights.$my_b_imagess.'"';
			
			}

 ?> 




<div  class="news_tuoch"<?php echo $modle_style ?>>
             
             
             
             <div class="news_touch_in">
             <div class="news_touch_title">
             
              <?php if($my_text2){ ?> <a href="<?php echo get_category_link($w_cat); ?>"> <?php echo $my_text2; ?></a><?php } ?>
             <?php if($title){ ?>  <h2><?php echo html_entity_decode( $title); ?></h2><?php } ?>
             </div> 
             
             <ul>
             
                <?php  while ( $query->have_posts() ) :$query->the_post();  
					 $tit= get_the_title();
		             $id =get_the_ID(); 
	                 
					 $linkss=get_post_meta($id,"hoturl", true); 
		             if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();}; 
					
					  ?>     
                <li>
                <a class="news_pics" href="<?php echo $links1 ; ?>" target="_blank"><?php themepark_thumbnails('news'); ?></a>
               <div class="news_textss">
                <strong><a href="<?php echo $links1 ; ?>" target="_blank" ><?php  echo mb_strimwidth(strip_tags(apply_filters('the_title', $tit)),  0,45,"...",'utf-8'); ?></a></strong>
                <em><?php echo get_the_time('Y/m/d') ; ?></em>
               <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,120,"...",'utf-8'); ?></p>
                </div>
                </li>
                
                
               <?php endwhile; ?>
             
             </ul>
             
             
             
             
             
             </div>
             
             
             
 </div>
 
        <?php
	}
}
register_widget('news_index');
?>