<?php 

class html extends WP_Widget {

	function html()
	{
		$widget_ops = array('classname'=>'html','description' => get_bloginfo('template_url').'/images/xuanxiang/12.gif');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="html",$name='文本模式，支持html以及js等前端代码',$widget_ops,$control_ops);  

	}

	function form($instance) { 
	
	    	
		 
		 
		  $htmls = esc_attr($instance['htmls']); 
		$showmove =esc_attr($instance['showmove']);
	
	?>

<br />




 
 



<p><label for="<?php echo $this->get_field_id('htmls'); ?>"><?php esc_attr_e('代码或者文字'); ?> 

<textarea style="width:96%" id="<?php echo $this->get_field_id('htmls'); ?>" name="<?php echo $this->get_field_name('htmls'); ?>"cols="52" rows="4" ><?php echo stripslashes($htmls); ?></textarea>    
</label>
<em>这里输入的内容支持html代码或者js代码，也支持文本<br />
文本输入时，可以外套P标签如< p> 关于我们< /p>，空行使用< br >(实际输入时，删除p之前的空格，删除br前后空格即可)</em>
</p>
<p>   

    <label  for="<?php echo $this->get_field_id('showmove'); ?>">移动版是否显示:</label><br />
             <select id="<?php echo $this->get_field_id('showmove'); ?>" name="<?php echo $this->get_field_name('showmove'); ?>" >
              <option value=''<?php if ($showmove== "" ) {echo "selected='selected'";}?> >显示</option>
	          <option value='1'<?php if ($showmove == "1" ) {echo "selected='selected'";}?>>不显示</option>
		
	</select>

</p>



	<?php
    }
	function update($new_instance, $old_instance) { // 更新保存
		return $new_instance;
	}
	function widget($args, $instance) { // 输出显示在页面上
	extract( $args );
	     $id =$instance['id'];
     
	    $htmls = apply_filters('widget_title', empty($instance['htmls']) ? __('') : $instance['htmls']);
			$showmove=apply_filters('widget_title', empty($instance['showmove']) ? __('') : $instance['showmove']);
		
	$detect = new Mobile_Detect();	
		if($showmove&&$detect->isMobile()||$showmove&&$detect->isTablet()){}else{
		?>
        
        
<div class="html  box">

 <?php echo html_entity_decode($htmls); ?>


</div>

 
        <?php
	}}
}
register_widget('html');
?>