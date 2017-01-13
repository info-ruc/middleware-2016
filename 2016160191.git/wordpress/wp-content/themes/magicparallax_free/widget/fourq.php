<?php 

class fourq extends WP_Widget {

	function fourq()
	{
		$widget_ops = array('classname'=>'fourq','description' =>get_bloginfo('template_url').'/images/xuanxiang/66.gif');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="fourq",$name='两栏多功能模块',$widget_ops,$control_ops);  

	}

	function form($instance) { 
	
	     $my_text1 = esc_attr($instance['my_text1']);
		 $my_text3 = esc_attr($instance['my_text3']);
		 $my_images = esc_attr($instance['my_images']);
		 $my_b_images = esc_attr($instance['my_b_images']);
		 $my_code = esc_attr($instance['my_code']);
		 $my_hight = esc_attr($instance['my_hight']);
		 $my_text_width = esc_attr($instance['my_text_width']);
		 $my_text_top = esc_attr($instance['my_text_top']);
		  $title = esc_attr($instance['title']);
		 $my_text_url = esc_attr($instance['my_text_url']);
		 
		 $my_img_top= esc_attr($instance['my_img_top']);
		 $my_text_color= esc_attr($instance['my_text_color']);
	     $my_text_alpha=esc_attr($instance['my_text_alpha']);
		 $left_right=esc_attr($instance['left_right']);
	    $ipad=esc_attr($instance['ipad']); 
		
		$my_pingjia_t=esc_attr($instance['my_pingjia_t']);
		$my_pingjia_t2=esc_attr($instance['my_pingjia_t2']);
		$my_pingjia_t3=esc_attr($instance['my_pingjia_t3']);
		$themepark_comment=esc_attr($instance['themepark_comment']);
		$my_table_title=esc_attr($instance['my_table_title']);
	?>


<p>   
    <label  for="">图/视频和文字是顺序：</label><br />
             <select readonly="true"  >
              <option value=''<?php if ($left_right == "" ) {echo "selected='selected'";}?> >付费版可选左右顺序对调</option>
	         
	</select><br />

</p>


<p>
 <label  for="<?php echo $this->get_field_id('my_text1'); ?>">标题:</label>
 <input type="text" size="40" value="<?php echo $my_text1 ; ?>" name="<?php echo $this->get_field_name('my_text1'); ?>" id="<?php echo $this->get_field_id('my_text1'); ?>"/>

 </p>
 
 <p>
 <label  for="<?php echo $this->get_field_id('title'); ?>">标题2:</label>
 <input type="text" size="40" value="<?php echo $title ; ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>"/>

 </p>

 
 
<p>
 <label  for="<?php echo $this->get_field_id('my_text3'); ?>">文字段落:</label>
<textarea style="width:98%;" id="<?php echo $this->get_field_id('my_text3'); ?>" name="<?php echo $this->get_field_name('my_text3'); ?>"cols="52" rows="4" ><?php echo stripslashes($my_text3); ?></textarea>  
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;"><?php esc_attr_e('使用代码 <br />进行分行,也支持html代码');?></em>
</p>


<p>
 <label  for="<?php echo $this->get_field_id('my_text_url'); ?>">链接:</label>
 <input type="text" size="40" value="<?php echo $my_text_url ; ?>" name="<?php echo $this->get_field_name('my_text_url'); ?>" id="<?php echo $this->get_field_id('my_text_url'); ?>"/>
</p>

   
<?php 	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) ); ?>
   <label for="<?php echo $this->get_field_id('my_text_top'); ?>">选择一个菜单</label>
			<select id="<?php echo $this->get_field_id('my_text_top'); ?>" name="<?php echo $this->get_field_name('my_text_top'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $my_text_top, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>

</p> 







<p>   
    <label  for="<?php echo $this->get_field_id('my_img_top'); ?>">菜单显示的模式【付费版可选三种模式】：</label><br />
             <select readonly="true" >
              <option value=''<?php if ($my_img_top == "" ) {echo "selected='selected'";}?> >文字+默认图标模式</option>  
	</select><br />

</p>
<?php if ($my_img_top == "cunst_nav_p" ){ ?>

<p>
 <label  for="<?php echo $this->get_field_id('my_pingjia_t'); ?>">用户评价标题:</label>
 <input type="text" size="40"readonly="true"  value="付费版可输出用户评价" />
</p>

<p>
 <label  for="<?php echo $this->get_field_id('my_pingjia_t2'); ?>">更多评价:</label>
 <input type="text" size="40"readonly="true"  value="付费版可输出用户评价" />
</p>

<p>
 <label  for="<?php echo $this->get_field_id('my_pingjia_t3'); ?>">更多评价链接:</label>
<input type="text" size="40"readonly="true"  value="付费版可输出用户评价" />
</p>
<?php } ?>


<p>   
    <label  for="<?php echo $this->get_field_id('my_text_color'); ?>">文字颜色选择：</label><br />
             <select id="<?php echo $this->get_field_id('my_text_color'); ?>" name="<?php echo $this->get_field_name('my_text_color'); ?>" >
              <option value=''<?php if ($my_text_color == "" ) {echo "selected='selected'";}?> >黑色</option>
	          <option value='1'<?php if ($my_text_color == "1" ) {echo "selected='selected'";}?>>白色</option>
	</select><br />

</p>

<p>   
    <label  for="<?php echo $this->get_field_id('my_text_alpha'); ?>">文字颜色透明度：</label><br />
             <select id="<?php echo $this->get_field_id('my_text_alpha'); ?>" name="<?php echo $this->get_field_name('my_text_alpha'); ?>" >
              <option value=''<?php if ($my_text_alpha == "" ) {echo "selected='selected'";}?> >100%</option>
	          <option value='90'<?php if ($my_text_alpha == "90" ) {echo "selected='selected'";}?>>90%</option>
               <option value='80'<?php if ($my_text_alpha == "80" ) {echo "selected='selected'";}?>>80%</option>
                <option value='70'<?php if ($my_text_alpha == "70" ) {echo "selected='selected'";}?>>70%</option>
                 <option value='60'<?php if ($my_text_alpha == "60" ) {echo "selected='selected'";}?>>60%</option>
                  <option value='50'<?php if ($my_text_alpha == "50" ) {echo "selected='selected'";}?>>50%</option>
	</select><br />

</p>



<p>
  <label  for="<?php echo $this->get_field_id('my_images'); ?>">配给的图片:</label><br />
 <input type="text" size="40" value="<?php echo $my_images ; ?>" name="<?php echo $this->get_field_name('my_images'); ?>" id="<?php echo $this->get_field_id('my_images'); ?>"/>
 
 <a id="ashu_upload" class="left_right_upload_button button" href="#">上传</a>
 
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">这张图片是这个模块默认靠右显示的，你可以选择相反的顺序排列，也可以使用下面的html代码选项进行替换，填写相应的代码之后，图片将不会显示</em>
</p> 

<p>
 <label  for="<?php echo $this->get_field_id('my_code'); ?>">视频代码或者超级留言板代码:</label>
<textarea style="width:98%;" id="<?php echo $this->get_field_id('my_code'); ?>" name="<?php echo $this->get_field_name('my_code'); ?>"cols="52" rows="4" ><?php echo stripslashes($my_code); ?></textarea>  
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">仅限输入视频代码或者超级留言板代码</em>
</p>
<p>   
    <label  for="<?php echo $this->get_field_id('themepark_comment'); ?>">是否使用超级留言板：</label><br />
             <select readonly="true"  >
              <option value=''<?php if ($themepark_comment == "" ) {echo "selected='selected'";}?> >使用视频（超级留言板功能限于付费版）</option>
            
   
	</select><br />
<em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">你可以使用超级留言板插件建立一个表单，将制作好的表单代码粘贴到上面的代码选项中，然后上方选择使用超级留言板的选项选择一个页面（因为首页不能留言），这样就可以插入一个自定义表单了。【付费版功能】</em>


<p>
  <label  for="<?php echo $this->get_field_id('my_table_title'); ?>">表单的标题:</label><br />
 <input type="text" size="40" value="付费版可输出一个表单"  readonly="true"/>
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">这个模块的付费版可以使用<a target="_blank" href="http://www.themepark.com.cn/wordpressbdcjcjlyb.html">超级留言板</a>插件输出一个表单在首页上</em>
</p> 
</p>








<p>
  <label  for="<?php echo $this->get_field_id('my_b_images'); ?>">背景图片:</label><br />
 <input type="text" size="40" value="<?php echo $my_b_images ; ?>" name="<?php echo $this->get_field_name('my_b_images'); ?>" id="<?php echo $this->get_field_id('my_b_images'); ?>"/>
 
 <a id="ashu_upload" class="left_right_upload_button button" href="#">上传</a>
 
 <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">（尺寸宽度为1920，高度取决于你的图片和文字大小，若选择了表单模式高度为640px,建议上传可以无限重复的背景图片）</em>
 
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
	  
		$my_text1  = apply_filters('widget_title', empty($instance['my_text1']) ? __('') : $instance['my_text1']);
		$my_text3  = apply_filters('widget_title', empty($instance['my_text3']) ? __('') : $instance['my_text3']);
        $my_images  = apply_filters('widget_title', empty($instance['my_images']) ? __('') : $instance['my_images']);
	    $my_b_images = apply_filters('widget_title', empty($instance['my_b_images']) ? __('') : $instance['my_b_images']);
		$my_code = apply_filters('widget_title', empty($instance['my_code']) ? __('') : $instance['my_code']);
		$my_hight = apply_filters('widget_title', empty($instance['my_hight']) ? __('') : $instance['my_hight']);
		$my_text_top =apply_filters('widget_title', empty($instance['my_text_top']) ? __('') : $instance['my_text_top']);
		$my_img_top =apply_filters('widget_title', empty($instance['my_img_top']) ? __('') : $instance['my_img_top']);
		$my_text_width =apply_filters('widget_title', empty($instance['my_text_width']) ? __('') : $instance['my_text_width']);
		$my_text_color  = apply_filters('widget_title', empty($instance['my_text_color']) ? __('') : $instance['my_text_color']);
        $my_text_alpha  = apply_filters('widget_title', empty($instance['my_text_alpha']) ? __('') : $instance['my_text_alpha']);
		$left_right= apply_filters('widget_title', empty($instance['left_right']) ? __('') : $instance['left_right']);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title']);
		$my_text_url = apply_filters('widget_title', empty($instance['my_text_url']) ? __('') : $instance['my_text_url']);
		$ipad= apply_filters('widget_title', empty($instance['ipad']) ? __('') : $instance['ipad']);
		$my_pingjia_t=apply_filters('widget_title', empty($instance['my_pingjia_t']) ? __('') : $instance['my_pingjia_t']);
		$my_pingjia_t2=apply_filters('widget_title', empty($instance['my_pingjia_t2']) ? __('') : $instance['my_pingjia_t2']);
		$my_pingjia_t3=apply_filters('widget_title', empty($instance['my_pingjia_t3']) ? __('') : $instance['my_pingjia_t3']);
		$themepark_comment=apply_filters('widget_title', empty($instance['themepark_comment']) ? __('') : $instance['themepark_comment']);
		$my_table_title=apply_filters('widget_title', empty($instance['my_table_title']) ? __('') : $instance['my_table_title']);
	if($my_hight||$my_b_images){
			
			$my_b_imagess='background: center url('.$my_b_images.');';
			$modle_style='style="'.$my_hights.$my_b_imagess.'"';
			
			}
		?>
        
 <div id="<?php echo 'cunst'.$my_text_top; ?>" class="cunst_modle"<?php echo $modle_style ?> >
  <div class="cunst_modle_in" <?php echo  $left_rights.$modle_style;?> >
        
         
          
              <div class="cunst_text  <?php echo $my_text_alphas.'   '.$my_text_colors ?>" <?php echo $text_style; ?>>
                 <h2><b> <?php echo $my_text1 ?></b> <?php if($title){ ?><a href="<?php echo $my_text_url ?>" ><?php echo $title; ?></a><?php } ?></h2>
                 <p> <?php echo html_entity_decode($my_text3); ?></p>
              
               <div class="cunst_nav">
                <?php if($my_text_top){ ob_start(); wp_nav_menu(array( 'walker' => new header_menu(),'container' => false,'menu' => $my_text_top ,'items_wrap' => '<div >%3$s</div>'  ) ); }?>          </div>
                 
    </div>
             <div class="cunst_code" <?php echo $img_style; ?>>
                <?php if($my_code||$my_images){ echo '<div class="cunst_vedio">'.html_entity_decode($my_code).'</div>';if(!$my_code&&$my_text_url!='#'){$vediourl='href="'.$my_text_url.'"';} ?> 
                <?php 
				
				if($my_images){echo '<a '.$vediourl.'><img src="'.$my_images.'" alt="'.$my_text1 .'" /></a>'; }?>
              </div>
              <?php } ?>
          </div>
 
 </div>

 </div>
 <script> $(window).scroll(function () {$(".donghuaopen <?php echo '#cunst'.$my_text_top; ?>").cunst();}); </script>
 
        <?php
	}
}
register_widget('fourq');
?>