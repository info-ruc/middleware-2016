
<div class="xiaot">
 <input type="checkbox" readonly="true" />
 <label for="cache_open">开启内存缓存菜单功能【付费版功能】</label>
 <p>若你的服务器没有支持memcache应用，请勿开启,否则在菜单处保存时会出现报错，但不影响使用，若服务器支持memcache，开启此应用之后会缓存菜单，大大降低查数据库询次数。服务器是否开启此应用请咨询你的服务器商，或者开启这个功能去菜单处保存一次菜单，如果没有报错警告，那么就是可用的。</p>
</div>

<div class="xiaot">

    <input type="checkbox" value="shop_ok" name="theme_shop_open" id="theme_shop_open" <?php if(get_option('mytheme_theme_shop_open')=="shop_ok"){echo "checked='checked'";} ?> />
    <label for="theme_shop_open">开启兼容购物盒子插件</label>
    <p>开启购物盒子插件之后，首页调用文章模块中如果文章启用了插件中的是商品模式，会显示价格、原价、包邮等信息。分类目录中的《大图文列表》《图片列表》以及内页《产品展示模板（一栏模式以及默认模式）》均会显示商品信息，内页模板点击购买按钮会出现提交订单表单和商品评分和评价模块。 <br />
购物盒子（shoppingbox）是WEB主题公园开发的一款能够支持在线付款的插件，本主题已经优化兼容，详情请见购物盒子的使用教程：<a target="_blank" href="http://www.themepark.com.cn/shoppingbox-wordpress-plugins.html">点击弹出查看</a><br />
<strong>请第一次使用这个插件的用户参考教程设置，购物盒子自带前端用户注册、登录和个人中心，需要初始化手动设置之后才能生效。</strong></p>
<p><strong>注意，现在分类目录模板的“图片列表（大图一栏）”和“大图文列表”支持商品模式！ 内页的两个产品模板支持商品模式！</strong></p>

  <b class="bt">社区内页模板选择</b>
               <p>付费版主题可选2种模板</p>
              <?php $bbs_mo =get_option('mytheme_bbs_mo') ?>
              <p>
            <label  for="bbs_mo "readonly="true" >社区模板选择:</label>
                  <select>
                   <option value=''<?php if ( $bbs_mo ==="" ) {echo "selected='selected'";}?>>默认模板</option>
              
	             </select>  
 <p class="tishiwenzi">当前使用的主题为免费版，付费版可以解锁选取社区模板功能<a target="_blank" href="http://www.themepark.com.cn/msscwordpressqyzt.html"> 查看付费版详情</a></p> 
 </div>

 <div class="xiaot">
 
              <b class="bt">多重筛选模块功能控制【付费版功能】</b>
               <p>多重筛选模块，添加了这个模块请在菜单的“<strong>搜索菜单（搜索和标签页面显示）</strong>”中按照要求建立好菜单，教程请看：<a target="_blank" href="http://www.themepark.com.cn/wordpressdzsxgnjs.html">WEB主题公园多筛选功能教程</a></p>
             
              <p>
            <label  for="list_nmber_nav ">是否显示多重筛选:</label>
                  <select readonly="true"  >
                 
                    <option value='none'>不显示</option>
	             </select>  
</p>

<p>多重筛选结果模板选择<strong>[小贴士：付费版可使用多个分类目录列表模板，并可试用多重筛选]</strong></p>
<p><?php $tags_m= get_option('mytheme_tags_m');  ?>  
 <label  for="tags_m">多重筛选结果模板选择【付费版功能】:</label>
                  <select name="tags_m" id="tags_m">
                   <option value=''>付费版可使用多重筛选</option>
                  
	             </select>  

</p>
     <p><?php $tags_moshi= get_option('mytheme_tags_moshi');  ?>  
 <label  for="tags_moshi">多重筛标签筛选模式选项:</label>
                  <select name="tags_moshi" id="tags_moshi">
                  
                     <option value=''>付费版可使用多重筛选</option>
	             </select> <br />
 
<em>选择标签并集之后，比如筛选两个标签，那么只要文章拥有其中一个标签就会显示，选择标签越多，显示文章越多，选择标签交集，比如选择2个标签，那么文章必须带有这2个标签才会显示，标签选择越多，文章显示越少</em>
 <p class="tishiwenzi">当前使用的主题为免费版，付费版可以解锁选取社区模板功能<a target="_blank" href="http://www.themepark.com.cn/msscwordpressqyzt.html"> 查看付费版详情</a></p> 
</p>         



  <p><?php $stickys= get_option('mytheme_stickys');  ?>  
 <label  for="tags_moshi">置顶是否显示“推荐”图标:</label>
                  <select name="stickys" id="stickys">
                   <option value=''<?php if ( $stickys ==="" ) {echo "selected='selected'";}?>>显示</option>
                    <option value='jiao'<?php if ( $stickys ==="jiao" ) {echo "selected='selected'";}?>>不显示</option>
                   
	             </select> <br />
 
<em>主题在1.08版本增加了置顶功能，现在WordPress默认的置顶会优先显示在列表的最前面，并默认显示“推荐”字样的小图标，你可以选择显示或者不显示，如果你想要更改小图标，可以在自定义css中id为tuijian_loop的css类添加自己的样式。（默认为css类，我们为你预留了id类以覆盖。）</em>
</p>        
              </div>
 
               
                <div class="up">
                 
                     
                     <div class="up">
                 
                     
                    <b class="bt">ICO图标上传</b>
                    <input type="text" size="80"  name="ico" id="ico" value="<?php echo get_option('mytheme_ico'); ?>"/>   
                    <input type="button" name="upload_button" value="上传" id="upbottom"/>   
                    <p><a href="http://www.themepark.com.cn/icotpssmrhzzicowj.html" target="_blank">ico是什么？ico图片制作教程</a></p>
                </div>     
                
                        
                
     
              
                              
   
                
             	 <div class="up">
                    <b class="bt">选择焦点图下方的菜单</b>
                    <p>滚轴焦点图下方有一个菜单项目栏和搜索栏，你可以在此处指定一个菜单</p>
                    
                    <label  for="from_page">选择菜单:</label><br />
             <select id="from_page" name="from_page" >
              <option value=''>请选择</option>
<?php   $menus = wp_get_nav_menus( array( 'orderby' => 'name' ) ); $from_page=get_option('mytheme_from_page');
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected(  $from_page, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
	
	</select>

                </div>    	
      
              <b class="bt">焦点图下方的搜索设置</b><br />

                <label  for="big_search_key">选择搜索推荐分类</label>
 <textarea name="big_search_key" cols="86" rows="3" id="big_search_key"><?php echo get_option('mytheme_big_search_key'); ?></textarea> <br />
  <em style="padding:3px; background:#FCF3E4; border:solid 1px #F0D8BF; display:block;">设置热门搜索词，一行一个</em><br />
   
    <label  for="big_search_cat">选择搜索推荐分类</label>
             <select id="big_search_cat" name="big_search_cat" >
              <option value=''>请选择</option>
<?php 
		 $categorys = get_categories();
		foreach( $categorys AS $category ) { 
		 $category_id= $category->term_id;
		 $category_name=$category->cat_name;
		?>
			<option 
				value='<?php echo  $category_id; ?>'
				<?php
					if ( $big_search_cat== $category_id ) {
						echo "selected='selected'";
					}
				?>><?php echo  $category_name; ?></option>
		    <?php } ?>
	       </select>      
    </div>
    
    </div>
     

                                         
            
            
            
           
                   
                         
           
                   
                     