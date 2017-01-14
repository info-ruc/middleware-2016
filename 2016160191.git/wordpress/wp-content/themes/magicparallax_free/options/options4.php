
 
  <?php
		    $word_t1=get_option('mytheme_word_t1');
			$word_t2=get_option('mytheme_word_t2');
			$word_t3=get_option('mytheme_word_t3');
		    $word_t4=get_option('mytheme_word_t4');
			$word_t5=get_option('mytheme_word_t5');
		    $word_t6=get_option('mytheme_word_t6');
			$word_t7=get_option('mytheme_word_t7');
			$word_t8=get_option('mytheme_word_t8');
			$word_t9=get_option('mytheme_word_t9');
			$word_t10=get_option('mytheme_word_t10');
			$word_t11=get_option('mytheme_word_t11');
			$word_t12=get_option('mytheme_word_t12');
			$word_t13=get_option('mytheme_word_t13');
			$word_t14=get_option('mytheme_word_t14');
			$word_t15=get_option('mytheme_word_t15');
			$word_t16=get_option('mytheme_word_t16');
			$word_t17=get_option('mytheme_word_t17');
			$word_t18=get_option('mytheme_word_t18');
			$word_t19=get_option('mytheme_word_t19');
			$word_t20=get_option('mytheme_word_t20');
			$word_t21=get_option('mytheme_word_t21');
			$word_t22=get_option('mytheme_word_t22');
			$word_t23=get_option('mytheme_word_t23');
			$word_t24=get_option('mytheme_word_t24');
			$word_t25=get_option('mytheme_word_t25');
			$word_t26=get_option('mytheme_word_t26');
			$word_t27=get_option('mytheme_word_t27');
			$word_t28=get_option('mytheme_word_t28');
			$word_t29=get_option('mytheme_word_t29');
			$word_t40=get_option('mytheme_word_t40');
		    $word_t41=get_option('mytheme_word_t41');
			$word_t42=get_option('mytheme_word_t42');
			$word_t43=get_option('mytheme_word_t43');
			$word_t44=get_option('mytheme_word_t44');
			$word_t50=get_option('mytheme_word_t50');
			$word_t51=get_option('mytheme_word_t51');
			$word_t52=get_option('mytheme_word_t52');
			$word_t53=get_option('mytheme_word_t53');
		
			
			
		    $language1=get_option('mytheme_language1');
			$language2=get_option('mytheme_language2');
			$language_link1=get_option('mytheme_language_link1');
			$language_link2=get_option('mytheme_language_link2');
			
			 $language3=get_option('mytheme_language3');
			$language4=get_option('mytheme_language4');
			$language_link3=get_option('mytheme_language_link3');
			$language_link4=get_option('mytheme_language_link4');
$language_title=get_option('mytheme_language_title'); 
		    ?>
  <div class="xiaot up">
<b class="bt">多语言翻译</b><br />
              <p>这里你可以自己把下面的一些固定的词语翻译成你想要的语言，或者改变他们，成为你想要的词语,下面上传国旗图标，并填写好连接到多语言的地址（默认中,美图标）。</p>
              <p>
               <label  for="language_title">语言选择标题（底部pc版，手机端请在在自定义移动设置中设定）：</label> 
             <input type="text" size="30"  name="language_title" id="language_title" value="<?php echo $language_title  ?>"/  />
              </p>
              <p> <label  for="case2_bt">语言1：</label> 
              <img src="<?php if($language1){ echo $language1;}else{echo get_bloginfo('template_url').'/images/china.gif';}  ?>" alt="language" />
           <input type="text" size="20"  name="language1" id="language1" value="<?php if($language1){ echo $language1;}else{echo get_bloginfo('template_url').'/images/china.gif';}  ?>"/  />
             <input type="button" name="upload_button" value="上传" id="upbottom"/>   
           <label  for="case2_bt">语言1的链接：</label> 
             <input type="text" size="30"  name="language_link1" id="language_link1" value="<?php echo $language_link1  ?>"/  />
            </p>
              <p> <label  for="case2_bt">语言2：</label> 
              <img src="<?php if($language2){ echo $language2;}else{echo get_bloginfo('template_url').'/images/usa.gif';}  ?>" alt="language" />
           <input type="text" size="20"  name="language2" id="language2" value="<?php if($language2){ echo $language2;}else{echo get_bloginfo('template_url').'/images/usa.gif';}  ?>"/  />
            <input type="button" name="upload_button" value="上传" id="upbottom"/>   
           <label  for="case2_bt">语言2的链接：</label> 
             <input type="text" size="30"  name="language_link2" id="language_link2" value="<?php echo $language_link2  ?>"/  />
            </p>
            
            
             <p> <label  for="case2_bt">语言3：</label> 
              <img src="<?php if($language3){ echo $language3;}else{echo get_bloginfo('template_url').'/images/france.gif';}  ?>" alt="language" />
           <input type="text" size="20"  name="language3" id="language3" value="<?php if($language3){ echo $language3;}else{echo get_bloginfo('template_url').'/images/france.gif';}  ?>"/  />
             <input type="button" name="upload_button" value="上传" id="upbottom"/>   
           <label  for="case2_bt">语言1的链接：</label> 
             <input type="text" size="30"  name="language_link3" id="language_link3" value="<?php echo $language_link3  ?>"/  />
            </p>
              <p> <label  for="case2_bt">语言4：</label> 
              <img src="<?php if($language4){ echo $language4;}else{echo get_bloginfo('template_url').'/images/japan.gif';}  ?>" alt="language" />
           <input type="text" size="20"  name="language4" id="language4" value="<?php if($language4){ echo $language4;}else{echo get_bloginfo('template_url').'/images/japan.gif';}  ?>"/  />
            <input type="button" name="upload_button" value="上传" id="upbottom"/>   
           <label  for="case2_bt">语言4的链接：</label> 
             <input type="text" size="30"  name="language_link4" id="language_link4" value="<?php echo $language_link4  ?>"/  />
            </p>
                      
                      
                      </div>
 <div class="xiaot">
<b class="bt">翻译</b><br />
 <p>对照左边的中文，你可以吧这些固定的词语替换成你想要的，如果你不是多语言网站，也可以使用这个功能改变你想要改变的文字。</p>
     
     
       
      <p> <label  for="word_t50">导航菜单：</label> 
     <input type="text" size="20"  name="word_t50" id="word_t50" value="<?php if($word_t50!=""){echo $word_t50;}else{echo '导航菜单';}  ?>"/  />        
   </p>  
       <p> <label  for="word_t51">发布时间：</label> 
     <input type="text" size="20"  name="word_t51" id="word_t51" value="<?php if($word_t51!=""){echo $word_t51;}else{echo '发布时间';}  ?>"/  />        
   </p>  
   
     <p> <label  for="word_t52">浏览次数：</label> 
     <input type="text" size="20"  name="word_t52" id="word_t52" value="<?php if($word_t52!=""){echo $word_t52;}else{echo '浏览次数';}  ?>"/  />        
   </p>  
     
      <p> <label  for="word_t42">上一篇（内页）：</label> 
     <input type="text" size="20"  name="word_t42" id="word_t42" value="<?php if($word_t42!=""){echo $word_t42;}else{echo '上一篇';}  ?>"/  />        
   </p>  
 
  <p> <label  for="word_t43">下一篇（内页）：</label> 
     <input type="text" size="20"  name="word_t43" id="word_t43" value="<?php if($word_t43!=""){echo $word_t43;}else{echo '下一篇';}  ?>"/  />        
   </p>  
                   
  <p> <label  for="word_t1">查看详细：</label> 
     <input type="text" size="20"  name="word_t1" id="word_t1" value="<?php if($word_t1!=""){echo $word_t1;}else{echo '查看详细';}  ?>"/  />        
   </p>  
   
    <p> <label  for="word_t26">播放视频：</label> 
     <input type="text" size="20"  name="word_t26" id="word_t26" value="<?php if($word_t26!=""){echo $word_t26;}else{echo '播放视频';}  ?>"/  />        
   </p> 
   
     <p> <label  for="word_t26">查看详细：</label> 
     <input type="text" size="20"  name="word_t27" id="word_t27" value="<?php if($word_t27!=""){echo $word_t27;}else{echo '查看详细';}  ?>"/  />        
   </p> 
   
    <p> <label  for="word_t28">电话：</label> 
     <input type="text" size="20"  name="word_t28" id="word_t28" value="<?php if($word_t28!=""){echo $word_t28;}else{echo '电话';}  ?>"/  />        
   </p> 
   
    <p> <label  for="word_t29">发送邮件：</label> 
     <input type="text" size="20"  name="word_t29" id="word_t29" value="<?php if($word_t29!=""){echo $word_t29;}else{echo '发送邮件';}  ?>"/  />        
   </p> 
   
     <p> <label  for="word_t2">版权所有：</label> 
     <input type="text" size="20"  name="word_t2" id="word_t2" value="<?php if($word_t2!=""){echo $word_t2;}else{echo '版权所有';}  ?>"/  />        
   </p>   
   
   
    <p> <label  for="word_t3">返回首页：</label> 
     <input type="text" size="20"  name="word_t3" id="word_t3" value="<?php if($word_t3!=""){echo $word_t3;}else{echo '返回首页';}  ?>"/  />        
   </p>   
   
     <p> <label  for="word_t4">上一页：</label> 
     <input type="text" size="20"  name="word_t4" id="word_t4" value="<?php if($word_t4!=""){echo $word_t4;}else{echo '上一页';}  ?>"/  />        
   </p>    
   
    <p> <label  for="word_t5">下一页：</label> 
     <input type="text" size="20"  name="word_t5" id="word_t5" value="<?php if($word_t5!=""){echo $word_t5;}else{echo '下一页';}  ?>"/  />        
   </p>     
   
      <p> <label  for="word_t6">最后一页：</label> 
     <input type="text" size="20"  name="word_t6" id="word_t6" value="<?php if($word_t6!=""){echo $word_t6;}else{echo '最后一页';}  ?>"/  />        
   </p> 
   
    <p> <label  for="word_t11">您现在的位置：</label> 
     <input type="text" size="20"  name="word_t11" id="word_t11" value="<?php if($word_t11!=""){echo $word_t11;}else{echo '您现在的位置：';}  ?>"/  />        
   </p>       
   
     <p> <label  for="word_t7">首页：</label> 
     <input type="text" size="20"  name="word_t7" id="word_t7" value="<?php if($word_t7!=""){echo $word_t7;}else{echo '首页';}  ?>"/  />        
   </p>  
   
    <p> <label  for="word_t8">Screening using labels article(使用标签筛选文章)：</label> 
     <input type="text" size="20"  name="word_t8" id="word_t8" value="<?php if($word_t8!=""){echo $word_t8;}else{echo 'Screening using labels article';}  ?>"/  />        
   </p> 
    <p> <label  for="word_t8">找到标签：</label> 
     <input type="text" size="20"  name="word_t12" id="word_t12" value="<?php if($word_t8!=""){echo $word_t12;}else{echo '找到标签';}  ?>"/  />        
   </p> 
   
    <p> <label  for="word_t9">搜索结果：</label> 
     <input type="text" size="20"  name="word_t9" id="word_t9" value="<?php if($word_t9!=""){echo $word_t9;}else{echo '搜索结果:';}  ?>"/  />        
   </p>
   
    <p> <label  for="word_t10">很遗憾，没有找到你要的信息：</label> 
     <input type="text" size="40"  name="word_t10" id="word_t10" value="<?php if($word_t10!=""){echo $word_t10;}else{echo '很遗憾，没有找到你要的信息';}  ?>"/  />        
   </p>
   
    <p> <label  for="word_t14">简介参数</label> 
     <input type="text" size="40"  name="word_t14" id="word_t14" value="<?php if($word_t14!=""){echo $word_t14;}else{echo '简介参数';}  ?>"/  />        
   </p>
    <p> <label  for="word_t15">联系咨询：</label> 
     <input type="text" size="40"  name="word_t15" id="word_t15" value="<?php if($word_t15!=""){echo $word_t15;}else{echo '联系咨询';}  ?>"/  />        
   </p>
   
   <p> <label  for="word_t15">详细参数：</label> 
     <input type="text" size="40"  name="word_t16" id="word_t16" value="<?php if($word_t16!=""){echo $word_t16;}else{echo '详细参数';}  ?>"/  />        
   </p>
   
    <p> <label  for="word_t15">姓  名：</label> 
     <input type="text" size="40"  name="word_t17" id="word_t17" value="<?php if($word_t17!=""){echo $word_t17;}else{echo '姓  名：';}  ?>"/  />        
   </p>
         
         <p> <label  for="word_t15">输入名称 ：</label> 
     <input type="text" size="40"  name="word_t18" id="word_t18" value="<?php if($word_t18!=""){echo $word_t18;}else{echo '输入名称 ';}  ?>"/  />        
   </p>    
   
         <p> <label  for="word_t15">邮箱：</label> 
     <input type="text" size="40"  name="word_t19" id="word_t19" value="<?php if($word_t19!=""){echo $word_t19;}else{echo '邮箱 ';}  ?>"/  />        
   </p>    
   
       <p> <label  for="word_t15">输入邮箱：</label> 
     <input type="text" size="40"  name="word_t20" id="word_t20" value="<?php if($word_t20!=""){echo $word_t20;}else{echo '输入邮箱 ';}  ?>"/  />        
   </p>  
        <p> <label  for="word_t15">留　言：</label> 
     <input type="text" size="40"  name="word_t21" id="word_t21" value="<?php if($word_t21!=""){echo $word_t21;}else{echo '留　言:';}  ?>"/  />        
   </p>   
         
               <p> <label  for="word_t15">提  交：</label> 
     <input type="text" size="40"  name="word_t22" id="word_t22" value="<?php if($word_t22!=""){echo $word_t22;}else{echo '提  交：';}  ?>"/  />        
   </p>   
   
      <p> <label  for="word_t23">联系电话</label> 
     <input type="text" size="40"  name="word_t23" id="word_t23" value="<?php if($word_t23!=""){echo $word_t23;}else{echo '联系电话';}  ?>"/  />        
   </p>   
             
       <p> <label  for="word_t24">多条件筛选</label> 
     <input type="text" size="40"  name="word_t24" id="word_t24" value="<?php if($word_t24!=""){echo $word_t24;}else{echo '多条件筛选';}  ?>"/  />        
   </p>         
   
       <p> <label  for="word_t25">你可以选择下面的条件并可以输入关键词点击开始搜索进行筛选</label> 
     <input type="text" size="80"  name="word_t25" id="word_t25" value="<?php if($word_t25!=""){echo $word_t25;}else{echo '你可以选择下面的条件并可以输入关键词点击开始搜索进行筛选';}  ?>"/  />        
   </p>    
   
   <p> <label  for="word_t40">关键词</label> 
     <input type="text" size="80"  name="word_t40" id="word_t40" value="<?php if($word_t40!=""){echo $word_t40;}else{echo '关键词：';}  ?>"/  />        
   </p>   
   
      <p> <label  for="word_t41">开始查询</label> 
     <input type="text" size="80"  name="word_t41" id="word_t41" value="<?php if($word_t41!=""){echo $word_t41;}else{echo '开始查询';}  ?>"/  />        
   </p>     
       
      <p> <label  for="word_t44">相关推荐</label> 
     <input type="text" size="80"  name="word_t44" id="word_t44" value="<?php if($word_t44!=""){echo $word_t44;}else{echo '相关推荐';}  ?>"/  />        
   </p>         
            
            
                     </div>