<div class="xiaot"> 
                	
              
                </div>

 <div class="up">
                    <b class="bt">首页title替换（pc）</b>
                    <textarea name="title" cols="86" rows="3" id="title" readonly="true"></textarea>   
                    <p>默认调用的是设置--常规中的站点标题+副标题</p>
                </div> 

   <div class="up">
                    <b class="bt">网站关键字填写（pc）</b>
                    <textarea name="keywords" cols="86" rows="3" id="keywords"><?php echo get_option('mytheme_keywords'); ?></textarea>   
                    <p>请填写网站的关键字，使用“ , ”分开，一个网站的关键字一般不超过100个字符。</p>
                </div>   
                
                 <div class="up">
                    <b class="bt">网站描述填写（中文）</b>
                    <textarea name="description" cols="86" rows="3" id="description"><?php echo get_option('mytheme_description'); ?></textarea>    
                    <p>请填写网站的描述，使用,分开，一个网站的描述一般不超过200个字符。</p>
                </div>   
                
                
                
 <div class="up">
                    <b class="bt">首页title替换（移动版）</b>
                    <textarea name="title_p" cols="86" rows="3" id="title_p"readonly="true"></textarea>   
                    <p>默认调用的是设置--常规中的站点标题+副标题</p>
                </div> 

   <div class="up">
                    <b class="bt">网站关键字填写（移动版）</b>
                    <textarea name="keywords_p" cols="86" rows="3" id="keywords_p"readonly="true"></textarea>   
                    <p>请填写网站的关键字，使用“ , ”分开，一个网站的关键字一般不超过100个字符。</p>
                </div>   
                
                 <div class="up">
                    <b class="bt">网站描述填写（移动版）</b>
                    <textarea name="description_p" cols="86" rows="3" id="description_p"readonly="true"></textarea>    
                    <p>请填写网站的描述，使用,分开，一个网站的描述一般不超过200个字符。</p>
                </div>   
                   

                      <div class="up">    
                    <b class="bt">网站统计代码添加</b>
                    <textarea name="analytics" cols="86" rows="4" id="analytics"><?php echo stripslashes(get_option('mytheme_analytics')); ?></textarea>    
                 
                 <a href="http://www.themepark.com.cn/wordpresswzseohj.html">网站的seo应该如何去做？ 我们给你一些文章作为参考</a>
                   <p class="tishiwenzi">当前使用的主题为免费版，付费版可以解锁主题的seo功能（包括独立的移动版seo设置）<a target="_blank" href="http://www.themepark.com.cn/msscwordpressqyzt.html"> 查看付费版详情</a></p>
  </div>  

  <div class="xiaot">
            <b class="bt">网站底部设定</b><br />
            <p>网站首页底部联系我们的一些设定</p>
                     <?php   
					 $contact_title= get_option('mytheme_contact_title');
					 $contact_title_2= get_option('mytheme_contact_title_2');
					 $tell = get_option('mytheme_tell');
					 $email= get_option('mytheme_email');
					 $icp_b=get_option('mytheme_icp_b');
					 $icp_b=get_option('mytheme_icp_b');
					 $two_code_title=get_option('mytheme_two_code_title');
					 $two_code_title2=get_option('mytheme_two_code_title2');
					 $two_code=get_option('mytheme_two_code');
					 $maps=get_option('mytheme_maps');
					 $maps_link=get_option('mytheme_maps_link');
					 $message_title= get_option('mytheme_message_title');
					 $message_title_2= get_option('mytheme_message_title_2'); 
				
				     $Socialmedia1=get_option('mytheme_Socialmedia1'); 
					 $Socialmedia2=get_option('mytheme_Socialmedia2'); 
					 $Socialmedia3=get_option('mytheme_Socialmedia3'); 
					 $Socialmedia4=get_option('mytheme_Socialmedia4'); 
					 
					 $Socialmedia_link1=get_option('mytheme_Socialmedia_link1'); 
					 $Socialmedia_link2=get_option('mytheme_Socialmedia_link2'); 
					 $Socialmedia_link3=get_option('mytheme_Socialmedia_link3'); 
					 $Socialmedia_link4=get_option('mytheme_Socialmedia_link4'); 
					 
					
		               ?>
            
                  <div class="xiaot">
                  <b class="bt">底部社交媒体设置</b>
                  <p>这些是底部默认为社交媒体的图标链接。图标的大小为30X30像素，你也可以使用这个功能作为其他的用途。</p>
                   <div class="up">
                 
                     
                    <label for="Socialmedia1">模块1（默认淘宝）</label>
                    <input type="text" size="59"  name="Socialmedia1" id="Socialmedia1" value="<?php if($Socialmedia1){echo $Socialmedia1;}else{echo get_bloginfo('template_url').'/images/taobao.png';}; ?>"/>   
                    <input type="button" name="upload_button" value="上传" id="upbottom"/>   <br />

                     <label for="Socialmedia_link1">模块1链接</label>
                    <input type="text" size="80"  name="Socialmedia_link1" id="Socialmedia_link1" value="<?php echo get_option('mytheme_Socialmedia_link1'); ?>"/>   <br /><br />


                 
                    <label for="Socialmedia2">模块2（默认新浪微博）</label>
                    <input type="text"  size="59" name="Socialmedia2" id="Socialmedia2" value="<?php if($Socialmedia2){echo $Socialmedia2;}else{echo get_bloginfo('template_url').'/images/weibo.png';}; ?>"/>   
                    <input type="button" name="upload_button" value="上传" id="upbottom"/>   <br />

                     <label for="Socialmedia_link2">模块2链接</label>
                    <input type="text" size="80"  name="Socialmedia_link2" id="Socialmedia_link2" value="<?php echo get_option('mytheme_Socialmedia_link2'); ?>"/>   <br /><br />

                    
                    
                     <label for="Socialmedia3">模块3（默认腾讯微博）</label>
                    <input type="text"  size="59"  name="Socialmedia3" id="Socialmedia3" value="<?php if($Socialmedia3){echo $Socialmedia3;}else{echo get_bloginfo('template_url').'/images/tengxunweibo.png';}; ?>"/>   
                    <input type="button" name="upload_button" value="上传" id="upbottom"/>   <br />

                     <label for="Socialmedia_link3">模块3链接</label>
                    <input type="text" size="80"  name="Socialmedia_link3" id="Socialmedia_link3" value="<?php echo get_option('mytheme_Socialmedia_link3'); ?>"/>   <br /><br />

                    
                     <label for="Socialmedia4">模块4（默认百度）</label>
                    <input type="text" size="59"  name="Socialmedia4" id="Socialmedia4" value="<?php if($Socialmedia4){echo $Socialmedia4;}else{echo get_bloginfo('template_url').'/images/tengxunweibo.png';}; ?>"/>   
                    <input type="button" name="upload_button" value="上传" id="upbottom"/>   <br />

                     <label for="Socialmedia_link4">模块4链接</label>
                    <input type="text" size="80"  name="Socialmedia_link4" id="Socialmedia_link4" value="<?php echo get_option('mytheme_Socialmedia_link4'); ?>"/>   <br />
                    
                </div>     
                
                  
                  
                  </div>
       
               
           
            
            
            <div class="xiaot">

          
    
      
        <b class="bt">ICP备案</b><br />
      <label  for="two_code_title">icp备案号，没有可以不填：</label>        
       <input type="text" size="60"  name="icp_b" id="icp_b" value="<?php echo $icp_b;?>"/>  <br />

                  
     
        </div>
                  
</div>
 </div>
   