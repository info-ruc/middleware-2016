

  <div class="xiaot">
                     <b class="bt">模板微调</b><br />
                    <p>这里你可以设定各个页面、分类目录的显示数量、顶部图片</p>
                 
  </div>
    <div class="xiaot">
                     <b class="bt">内页布局替换</b><br />
                    <p>你可以调换内页布局左右的位置</p>
                      <?php $left_right =get_option('mytheme_left_right') ?>
                    <label  for="left_right ">是否显示多重筛选:</label>
                  <select name="left_right" id="left_right">
                   <option value=''<?php if ( $left_right ==="" ) {echo "selected='selected'";}?>>默认（右边显示主要内容）</option>
                    <option value='none'<?php if ( $left_right ==="none" ) {echo "selected='selected'";}?>>对调（左边显示主要内容）</option>
	             </select>  
                 
  </div>
            
            <div class="xiaot">
            
            
              
 
             <label  for="fenxiang">文章底部的固定文字、图片以及连接等：</label> 
           
              
              <?php  echo wp_editor(stripslashes(get_option('mytheme_fenxiang')),  "fenxiang"); ?>
              <p>在这里编辑一些图文、链接等信息，可以是您的网站固定推荐信息，他们会显示在每一篇文章的结尾。</p><br />

         
                      <?php $show_page =get_option('mytheme_show_page'); ?>
                    <label  for="show_page">固定文字显示方式:</label>
                  <select name="show_page" id="show_page">
                   <option value=''<?php if ( $show_page ==="" ) {echo "selected='selected'";}?>>默认页面和文章都显示</option>
                    <option value='none'<?php if ( $show_page ==="none" ) {echo "selected='selected'";}?>>只在文章显示</option>
	             </select>  
                 

              
               <br />
<br />
<br />
<label  for="fenxiang2">文章底部的分享代码：</label> 
              
               <textarea name="fenxiang2" cols="86" rows="4" id="fenxiang2"><?php echo stripslashes(get_option('mytheme_fenxiang2')); ?></textarea>    
               
              <p>此处是文章内页和单页的百度分享代码替换框，若你想要使用其他的分享代码，可以获取代码粘贴到此处（如台湾、香港、澳门地区和海外地区用户不需要分享中国大陆的社交网站，可以使用此功能粘贴本地的分享代码，若不想使用此功能，可以打一些空格在里面即可）留空则显示默认的百度分享 </p>  
           
           
           <b class="bt">内页顶部以及底部图片文字设定</b>
            
            <p><strong>内页（分类目录、文章页以及页面）的顶部图片设定</strong></p>
            <div class="up">
            <label  for="top_pic">【pc以及平板电脑端的顶部图片】(尺寸：1920*320)</label> 
              <input type="text" size="60"  name="top_pic" id="top_pic" value="<?php echo get_option('mytheme_top_pic'); ?>"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div> 
            
             <div class="up">
            <label  for="top_pic_move">【手机端的顶部图片】(尺寸：700*158)</label> 
              <input type="text" size="60"  readonly="true" value="付费版兼容手机访问"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div>
            
    
                
                
            </div>  
             <?php
		    $list_nmber1=get_option('mytheme_list_nmber1');
			$list_nmber2=get_option('mytheme_list_nmber2');
			$list_nmber3=get_option('mytheme_list_nmber3');
			$list_nmber4=get_option('mytheme_list_nmber4');
			$list_nmber5=get_option('mytheme_list_nmber5');
			
			$list_nmber_k1=get_option('mytheme_list_nmber_k1');
			$list_nmber_k2=get_option('mytheme_list_nmber_k2');
			$list_nmber_k3=get_option('mytheme_list_nmber_k3');
			$list_nmber_k4=get_option('mytheme_list_nmber_k4');
			$list_nmber_k5=get_option('mytheme_list_nmber_k5');
			

		    ?>    
                      
              <div class="xiaot">
            <p>显示文章数量自定义，在设定分类目录的列表页现实的数量时，记得要把默认的WordPress数量设为1，否则会出现404错误，设置方法请在 “设置” -- “阅读”中 ，将现实的文章数量设为1，即可。</p>
               
              
               <p> <label  for="list_nmber2">默认模板（小图片加上文字）：</label> 
                <input type="text" size="20"  name="list_nmber2" id="list_nmber2" value="<?php if($list_nmber2!=""){echo $list_nmber2;}else{echo '12';}  ?>"/  />
                
                      
              </p> 
              <p> <label  for="list_nmber3">大图文列表：</label> 
                <input type="text" size="20"  name="list_nmber3" id="list_nmber3" readonly="true" /> 
                 
              </p> 
              
             
              
               <p> <label  for="list_nmber5">图片列表（大图一栏）：</label> 
                <input type="text" size="20"  name="list_nmber5" id="list_nmber5" readonly="true" />   </p>
                
                <p> <label  for="list_nmber4">图片列表（大图两栏）：</label> 
                <input type="text" size="20"  name="list_nmber5" id="list_nmber5" readonly="true" />   </p><br />


   <p class="tishiwenzi">当前使用的主题为免费版，付费版可以解锁分类目录、页面、文章多模板选择功能<a target="_blank" href="http://www.themepark.com.cn/msmhwordpressqyzt.html"> 查看付费版详情</a></p>
            </div>          
                      
           <div class="xiaot">
              
              
                <b class="bt">各尺寸略缩图默认图片</b>
            
            <p><strong>在首页、侧边栏和列表页有的列表会调用一个封面图片，如果没有设置，而你的文章中也没有图片，那么将会调用一张默认的图片，你可以在此处上传各个尺寸的默认图片。</strong></p>
            <p class="tishiwenzi">当前使用的主题为免费版，免费版只有一种尺寸的略缩图产生<a target="_blank" href="http://www.themepark.com.cn/msmhwordpressqyzt.html"> 查看付费版详情</a></p> 
    <?php if(get_option('mytheme_case_thumbnails')){$case_thumbnails=get_option('mytheme_case_thumbnails');}else{$case_thumbnails= get_bloginfo('template_url').'/thumbnails/case.jpg';} 
		  if(get_option('mytheme_fang_thumbnails')){$fang_thumbnails=get_option('mytheme_fang_thumbnails');}else{$fang_thumbnails= get_bloginfo('template_url').'/thumbnails/fang.jpg';}
		  if(get_option('mytheme_four_s_thumbnails')){$four_s_thumbnails=get_option('mytheme_four_s_thumbnails');}else{$four_s_thumbnails= get_bloginfo('template_url').'/thumbnails/four_s.jpg';}
		  if(get_option('mytheme_news_thumbnails')){$news_thumbnails=get_option('mytheme_news_thumbnails');}else{$news_thumbnails= get_bloginfo('template_url').'/thumbnails/news.jpg';}
		  if(get_option('mytheme_case_full_thumbnails')){$case_full_thumbnails=get_option('mytheme_case_full_thumbnails');}else{$case_full_thumbnails= get_bloginfo('template_url').'/thumbnails/case_full.jpg';}
			
			
			
			?>
            <div class="up"><img style="width:100px; height:auto;"  src="<?php echo $case_thumbnails; ?>"/><br />

            <label  for="case_thumbnails">图片：307, 204</label> 
            
              <input type="text" size="60"  name="case_thumbnails" id="case_thumbnails" value="<?php echo $case_thumbnails; ?>"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div> 
            
             <div ><img  style="width:100px; height:auto;"src="<?php echo $fang_thumbnails; ?>"/><br />
            <label  for="case_thumbnails">图片：307, 307,</label> 
            
              <input type="text" size="60"  name="fang_thumbnails" id="fang_thumbnails" readonly="true"  value="付费版可用尺寸"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div> 
            
           
            
            
               <div >      <img style="width:100px; height:auto;" src="<?php echo $news_thumbnails; ?>"/><br />
            <label  for="news_thumbnails">图片：400, 266</label> 
      
                           <input type="text" size="60"  name="fang_thumbnails" id="fang_thumbnails" readonly="true"  value="付费版可用尺寸"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div> 
            
              <div class="up">
               
                <img style="width:100px; height:auto;" src="<?php echo $case_full_thumbnails; ?>"/><br />
            <label  for="case_full_thumbnails">图片：287, 320</label> 
           
              <input type="text" size="60"  name="case_full_thumbnails" id="case_full_thumbnails" readonly="true"   value="付费版可用尺寸"/>   
              <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
            </div> 
              
              
              </div>
            
             <div class="xiaot">
                <b class="bt">侧边栏悬浮模块设置</b><br />
                <?php $kefu_on =  get_option('mytheme_kefu_on'); ?>
                 <label  for="kefu_on">是否显示悬浮:</label>
                  <select name="kefu_on" id="kefu_on">
                   <option value=''<?php if ( $kefu_on ==="" ) {echo "selected='selected'";}?>>显示</option>
                    <option value='none'<?php if ( $kefu_on ==="none" ) {echo "selected='selected'";}?>>不显示</option>
	             </select>   
                  <div class="up">
                      <label  for="about_pic">二维码上传（尺寸：210*210）</label> 
                      <input type="text" size="40"  name="kefu_weixin" id="kefu_weixin" value="<?php echo get_option('mytheme_kefu_weixin'); ?>"/>   
                      <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
                  </div> 
                  
                   <div class="up">
                      <label  for="qq_tu">客服头部图片替换(180宽度)</label> 
                      <input type="text" size="40"  name="qq_tu" id="qq_tu" value="<?php echo get_option('mytheme_qq_tu'); ?>"/>   
                      <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /> 
                  </div> 
                    <div class="up">
                    <label  for="kefu_qq">客服qq代码添加</label>
                    <textarea name="kefu_qq" cols="86" rows="4" id="kefu_qq"><?php echo stripslashes(get_option('mytheme_kefu_qq')); ?></textarea>
                    <p>登录QQ，并且进入QQ互联<a href="http://connect.qq.com/intro/wpa" target="_blank">http://shang.qq.com/widget/consult.php</a>,将获取的代码粘贴进来，支持多个qq客服代码添加</p>
                      </div>    
               </div>                                        
            
           
                   
                     
           
                   
                     