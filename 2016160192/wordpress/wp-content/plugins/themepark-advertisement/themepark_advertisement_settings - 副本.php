<?php

$base_name = plugin_basename( __FILE__ );
$base_page = 'admin.php?page='.$base_name;
$themepark_advertisement_show  = get_option('themepark_advertisement_show');
$themepark_advertisement_time  = get_option('themepark_advertisement_time');
$themepark_advertisement_pc_width  = get_option('themepark_advertisement_pc_width');
$themepark_advertisement_pc_height  = get_option('themepark_advertisement_pc_height');
$themepark_advertisement_pc_magie  = get_option('themepark_advertisement_pc_magie');
$themepark_advertisement_pc_content  = get_option('themepark_advertisement_pc_content');

$themepark_advertisement_mo_width  = get_option('themepark_advertisement_mo_width');
$themepark_advertisement_mo_height  = get_option('themepark_advertisement_mo_height');
$themepark_advertisement_mo_magie  = get_option('themepark_advertisement_mo_magie');
$themepark_advertisement_mo_content  = get_option('themepark_advertisement_mo_content');

if($_POST['Submit']) {

$themepark_advertisement_show   = trim($_POST['themepark_advertisement_show']);
$themepark_advertisement_time   = trim($_POST['themepark_advertisement_time']);
$themepark_advertisement_pc_width   = trim($_POST['themepark_advertisement_pc_width']);
$themepark_advertisement_pc_height   = trim($_POST['themepark_advertisement_pc_height']);
$themepark_advertisement_pc_magie   = trim($_POST['themepark_advertisement_pc_magie']);
$themepark_advertisement_pc_content   = trim($_POST['themepark_advertisement_pc_content']);

$themepark_advertisement_mo_width   = trim($_POST['themepark_advertisement_mo_width']);
$themepark_advertisement_mo_height   = trim($_POST['themepark_advertisement_mo_height']);
$themepark_advertisement_mo_magie   = trim($_POST['themepark_advertisement_mo_magie']);
$themepark_advertisement_mo_content   = trim($_POST['themepark_advertisement_mo_content']);

	$update_ali_queries = array();
	$update_ali_text    = array();
	
$update_ali_queries[] = update_option('themepark_advertisement_show', $themepark_advertisement_show );
$update_ali_queries[] = update_option('themepark_advertisement_time', $themepark_advertisement_time );
$update_ali_queries[] = update_option('themepark_advertisement_pc_width', $themepark_advertisement_pc_width );
$update_ali_queries[] = update_option('themepark_advertisement_pc_height', $themepark_advertisement_pc_width );
$update_ali_queries[] = update_option('themepark_advertisement_pc_magie', $themepark_advertisement_pc_magie );
$update_ali_queries[] = update_option('themepark_advertisement_pc_content', $themepark_advertisement_pc_content );

$update_ali_queries[] = update_option('themepark_advertisement_mo_width', $themepark_advertisement_mo_width );
$update_ali_queries[] = update_option('themepark_advertisement_mo_height', $themepark_advertisement_mo_width );
$update_ali_queries[] = update_option('themepark_advertisement_mo_magie', $themepark_advertisement_mo_magie );
$update_ali_queries[] = update_option('themepark_advertisement_mo_content', $themepark_advertisement_mo_content );

	$update_ali_text[] = '显示设置';
	$update_ali_text[] = 'cookies保存时间';
	
	$i = 0;
	$text = '';
	foreach($update_ali_queries as $update_ali_query) {
		if($update_ali_query) {
			$text .= '<font color="green">'.$update_ali_text[$i].' 更新成功！</font><br />';
		}
		$i++;
	}
	if(empty($text)) {
		$text = '<font color="red">您对设置没有做出任何改动...</font>';
	}

}

?>
<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<div class="wrap">
  <h2>简单广告框</h2>
  <div id="message" class="updated fade">
  <p>这是WEB主题公园所开发的一款广告弹出框插件，插件十分简单，可以在首页弹出一个广告框，并可以选择用户打开之后的多少时间以内不再显示，并且支持独立制作一个移动版的广告，移动版广告支持响应式主题和服务器端Mobile_Detect判断支持的主题。<br />
你可以参考这个插件的教程，这能够让你快速的了解插件是如何使用的：<a target="_blank" href="http://www.themepark.com.cn/wordpressdcggcjjdggkyccj.html">WordPress弹窗广告插件：简单广告框【原创插件】使用教程</a><br />
你想要更多好看好用的主题和插件，可以访问WEB主题公园的官网，若你有好的想法也可以和我说，我们会以此出品更多好用的插件和主题。ps:这款插件是网友提出的来的想法，我们在进行功能的拓展而开发的。
  </p>
  </div> 
  
 <form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>" style="width:70%;float:left;">
  
  <table class="form-table">
          
       
    
    
    
    
     <tr>
                <td valign="top" width="200px"><strong>显示设置</strong><br />
                </td>
                <td>
                 <select id="themepark_advertisement_show" name="themepark_advertisement_show">
                  <option value ="" <?php if(!$themepark_advertisement_show) {echo "selected='selected'";} ?>>用户第一次打开时显示</option>
                  <option value ="everytime" <?php if($themepark_advertisement_show=='everytime') {echo "selected='selected'";} ?>>每次都显示</option>
                </select>
                <p>这里可选弹出框显示的模式，默认为用户第一次打开网站首页时显示，之后打开就不再显示了，这是通过cookies进行判断的，cookies保存的时间为12小时，意味着，第一次访问之后12小时内用户再次访问将不会弹出，你可以在下面的选项修改cookies保存的时间。</p>
                </td>
            </tr>
    
      <tr>
                <td valign="top" width="200px"><strong>cookies保存的时间</strong><br />
                </td>
                <td>
                 <input type="text" size="60"  name="themepark_advertisement_time" id="themepark_advertisement_time" value="<?php echo $themepark_advertisement_time; ?>"/>
                 <p>默认为12小时，填写数字，单位为小时</p>
                </td>
            </tr>
     <tr>
                <td valign="top" width="200px"><h3>PC端广告设置</h3>
                </td>
                <td>
              
                </td>
            </tr>
    
    
      <tr>
    
    
      <tr>
                <td valign="top" width="200px"><strong>【pc端】广告的宽度</strong><br />
                </td>
                <td>
               <input type="text" size="60"  name="themepark_advertisement_pc_width" id="themepark_advertisement_pc_width" value="<?php echo $themepark_advertisement_pc_width; ?>"/> 
                 <p>单独控制pc端广告区域的宽度，单位为像素（px）或者百分比（%）,默认自动宽度（随着图片大小而定）.</p>
                </td>
            </tr>
    
    
      <tr>
                <td valign="top" width="200px"><strong>【pc端】广告的高度</strong><br />
                </td>
                <td>
                <input type="text" size="60"  name="themepark_advertisement_pc_height" id="themepark_advertisement_pc_height" value="<?php echo $themepark_advertisement_pc_height; ?>"/> 
                 <p>单独控制pc端广告区域的宽度，单位为像素（px）或者百分比（%）默认自动宽度（随着图片大小而定）.</p>
                </td>
            </tr>
            
             <tr>
                <td valign="top" width="200px"><strong>【pc端】广告距离顶部的距离</strong><br />
                </td>
                <td>
                <input type="text" size="60"  name="themepark_advertisement_pc_magie" id="themepark_advertisement_pc_magie" value="<?php echo $themepark_advertisement_pc_magie; ?>"/> 
                  <p>单独控制pc端广告区域的宽度，单位为像素（px）或者百分比（%）,默认15%.</p>
                </td>
            </tr>
            
    
           <tr>
                <td valign="top" width="200px"><strong>【pc端】广告距离顶部的距离</strong><br />
                </td>
                <td>
                 <?php  echo wp_editor( stripslashes(get_option('themepark_advertisement_pc_content')),  "themepark_advertisement_pc_content"); ?>
                  <p>pc版的广告内容，你可以通过编辑器上传图片，切换到文本模式支持html代码。</p>
                </td>
            </tr>
    
      <tr>
                <td valign="top" width="200px"><h3>移动端广告设置</h3></td>
                <td>
              
                </td>
            </tr>
    
    
    
     <tr>
                <td valign="top" width="200px"><strong>【移动端】广告的宽度</strong><br />
                </td>
                <td>
               <input type="text" size="60"  name="themepark_advertisement_mo_width" id="themepark_advertisement_mo_width" value="<?php echo $themepark_advertisement_mo_width; ?>"/> 
                 <p>单独控制移动端广告区域的宽度，单位为像素（px）或者百分比（%）,默认自动宽度（随着图片大小而定）.</p>
                </td>
            </tr>
    
    
      <tr>
                <td valign="top" width="200px"><strong>【移动端】广告的高度</strong><br />
                </td>
                <td>
                <input type="text" size="60"  name="themepark_advertisement_mo_height" id="themepark_advertisement_mo_height" value="<?php echo $themepark_advertisement_mo_height; ?>"/> 
                 <p>单独控制移动端广告区域的宽度，单位为像素（px）或者百分比（%），默认自动宽度（随着图片大小而定）.</p>
                </td>
            </tr>
            
             <tr>
                <td valign="top" width="200px"><strong>【移动端】广告距离顶部的距离</strong><br />
                </td>
                <td>
                <input type="text" size="60"  name="themepark_advertisement_mo_magie" id="themepark_advertisement_mo_magie" value="<?php echo $themepark_advertisement_mo_magie; ?>"/> 
                  <p>单独控制移动端广告区域的宽度，单位为像素（px）或者百分比（%）,默认15%.</p>
                </td>
            </tr>
            
    
           <tr>
                <td valign="top" width="200px"><strong>【移动端】广告距离顶部的距离</strong><br />
                </td>
                <td>
                 <?php  echo wp_editor( stripslashes(get_option('themepark_advertisement_mo_content')),  "themepark_advertisement_mo_content"); ?>
                  <p>移动版的广告内容，你可以通过编辑器上传图片，切换到文本模式支持html代码。</p>
                </td>
            </tr>
    
      <tr>
    
    
            
    </table>
        <br /> <br />
        <table> <tr>
        <td><p class="submit">
            <input type="submit" name="Submit" value="保存设置" class="button-primary"/>
            </p>
        </td>

        </tr> </table>
        
    
        <style>
        .themepark_advertisement_close{ width:100%;  height:30px; position:relative; }
		.themepark_advertisement_close_in{ width:20px; height:20px; background:#F60; position:absolute; color:#FFF; line-height:20px; text-align:center; top:0; right:-10px; font-family:Arial, Helvetica, sans-serif; cursor:pointer;}
        </style>
        

</form>

 
   

  
     
</div>
