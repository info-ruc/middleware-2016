      <?php
                    $picss=get_option('mytheme_picss'); 
				   
				     $pic1=get_option('mytheme_pic1'); 
					 $pic_content1=get_option('mytheme_pic_content1'); 
					 $pic_link1=get_option('mytheme_pic_link1'); 
					 $pic_taget1=get_option('mytheme_pic_taget1');  
					 $pic_move1=get_option('mytheme_pic_move1');  
					 
					  $pic2=get_option('mytheme_pic2'); 
					 $pic_content2=get_option('mytheme_pic_content2'); 
					 $pic_link2=get_option('mytheme_pic_link2'); 
					 $pic_taget2=get_option('mytheme_pic_taget2'); 
					  $pic_move2=get_option('mytheme_pic_move2');
					 
					  $pic3=get_option('mytheme_pic3'); 
					 $pic_content3=get_option('mytheme_pic_content3'); 
					 $pic_link3=get_option('mytheme_pic_link3'); 
					 $pic_taget3=get_option('mytheme_pic_taget3'); 
					  $pic_move3=get_option('mytheme_pic_move3');
					  
					  $pic4=get_option('mytheme_pic4'); 
					 $pic_content4=get_option('mytheme_pic_content4'); 
					 $pic_link4=get_option('mytheme_pic_link4'); 
					 $pic_taget4=get_option('mytheme_pic_taget4'); 
					  $pic_move4=get_option('mytheme_pic_move4');
					  
					  $picss=get_option('mytheme_picss'); 
					
					 ?>

<div class="new_pic">
    <b class="bt">产品菜单上的小图切换</b>
     
     <p>
      <label  for="picss">图高度（默认150px）:</label>
      <input type="text" size="80"  name="picss" id="picss" value="<?php echo $picss; ?>"/>   
      
    </p>
   <p>你可以在上面的选项选择不显示，从自定义添加焦点图的方式加入全屏轮播的焦点图从而替换掉目前这个标准宽度的焦点图，图片尺寸为*（353*高度自定）</p>
    <span> <a class="chouws" id="pics_1">图1</a> <a id="pics_2">图2</a>  <a id="pics_3">图3</a>  <a id="pics_4">图4</a></span>
  
   
   
    <div class="pocss up opne" id="picss1">
    
     <label  for="pic1">图片上传上传（尺寸：960*535）</label>
     <input type="text" size="80"  name="pic1" id="pic1" value="<?php echo $pic1; ?>"/>   
     <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /><br />
  
     

      <label  for="pic_link1">链接</label>
      <input type="text" size="80"  name="pic_link1" id="pic_link1" value="<?php echo $pic_link1 ?>"/> <br /><br />
       </select>
       
         <label  for="pic_content1">图片描述（文字描述）</label>
     <input type="text" size="80"  name="pic_content1" id="pic_content1" value="<?php echo $pic_content1; ?>"/>   <br />
    
     
    </div>            
                
                
    <div class="pocss up" id="picss2">
    
     <label  for="pic2">图片上传上传（尺寸：960*535）</label>
     <input type="text" size="80"  name="pic2" id="pic2" value="<?php echo $pic2; ?>"/>   
     <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /><br />

  
    
      <label  for="pic_link2">链接</label>
      <input type="text" size="80"  name="pic_link2" id="pic_link2" value="<?php echo $pic_link2 ?>"/> <br /><br />
       </select>
       
        <label  for="pic_content2">图片描述（文字描述）</label>
     <input type="text" size="80"  name="pic_content2" id="pic_content2" value="<?php echo $pic_content2; ?>"/><br />
       
    </div>            
    
    
    <div class="pocss up" id="picss3">
    
     <label  for="pic3">图片上传上传（尺寸：960*535）</label>
     <input type="text" size="80"  name="pic3" id="pic3" value="<?php echo $pic3; ?>"/>   
     <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /><br />

     
   
   
    

      <label  for="pic_link3">链接</label>
      <input type="text" size="80"  name="pic_link3" id="pic_link3" value="<?php echo $pic_link3 ?>"/> <br /><br />
       </select>
       
        <label  for="pic_content3">图片描述（文字描述）</label>
     <input type="text" size="80"  name="pic_content3" id="pic_content3" value="<?php echo $pic_content3; ?>"/><br />
       
       
    </div>            
    
    
    <div class="pocss up" id="picss4">
    
     <label  for="pic4">图片上传上传（尺寸：960*535）</label>
     <input type="text" size="80"  name="pic4" id="pic4" value="<?php echo $pic4; ?>"/>   
     <input type="button" name="upload_button" value="上传" id="upbottom"/>  <br /><br />

     
    
    
         
      <label  for="pic_link4">链接</label>
      <input type="text" size="80"  name="pic_link4" id="pic_link4" value="<?php echo $pic_link4 ?>"/> <br /><br />
       </select>
       
        <label  for="pic_content4">图片描述（文字描述）</label>
     <input type="text" size="80"  name="pic_content4" id="pic_content4" value="<?php echo $pic_content4; ?>"/><br />
     
    </div>  
 