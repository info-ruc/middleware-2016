<?php
/*
Plugin Name: Pinyin SEO(拼音SEO)
Plugin URI: http://www.xuewp.com/pinyin-seo/
Description: 拼音SEO插件可在文章发布时将中文标题将或者分类目录以及标签的永久链接转换成拼音格式，当前拼音数据库包含20966字，繁简通用，多音字词库需要扩充，2.0以上的版本均包含多音字功能。This plugin will convert Chinese characters to Pinyin(Latin alphabet for the romanization of Mandarin Chinese)Permalinks for SEO purpose.
Author: Chao Wang<webmaster@xuewp.com>
Version: 2.0
Author URI: http://www.xuewp.com/
*/
/*Copyright 2012 Chao Wang (email: webmaster@xuewp.com )

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License along
  with this program; if not, write to the Free Software Foundation, Inc.,
  51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
define('PINYINSEO_VERSION', '2.0');
 if ( ! defined( 'WP_CONTENT_DIR' ) )
       define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
 if ( ! defined( 'WP_PLUGIN_DIR' ) )
       define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

$pinyin_seo_option_defaults=array('pinyin_separator'=>'-','pinyin_format'=>'lower','pinyin_slugs'=>'true','pinyin_duoyinzi'=>'true');
if(!get_option('pinyin_seo')){
add_option('pinyin_seo', $pinyin_seo_option_defaults, '', 'yes');}
$pinyin_seo_options=get_option('pinyin_seo');
$pinyin_seo_options= array_merge($pinyin_seo_option_defaults, $pinyin_seo_options);
$pinyinseparator=$pinyin_seo_options['pinyin_separator'];
$pinyinformat=$pinyin_seo_options['pinyin_format'];

function PinyinSEO($chinese)
{
global $pinyin_seo_options;
if (get_bloginfo('charset')!="UTF-8") {
	$chinese= iconv(get_bloginfo('charset'), "UTF-8", $chinese);
	}
    $pinyin = array();
    $retitle = '';
	$dat = WP_PLUGIN_DIR .'/pinyin-seo/data/pinyin.dat';
    $chinese = trim($chinese);
	if ($pinyin_seo_options['pinyin_duoyinzi']=='true'){
	$chinese = Duo_Yin_Zi($chinese);}
    if(count($pinyin)==0 && is_file($dat))//判断pinyin.dat是否存在，若不存在则跳过，以免出现死循环
    {
        $fp = fopen($dat,'r');
        while(!feof($fp))
        {
            $line = trim(fgets($fp));
            $pinyin[$line[0].$line[1].$line[2]] = substr($line,3,strlen($line)-3);//unicode中汉字为3个字节
        }
        fclose($fp);
    }
    for($i=0;$i<strlen($chinese);$i++)//按字节遍历
    {
        if(ord($chinese[$i])>128)//判断是否属于东亚字符集
        {
            $a = $chinese[$i].$chinese[$i+1].$chinese[$i+2];
            if(isset($pinyin[$a]))//如果该汉字的拼音存在
            {
                $retitle.='-'.$pinyin[$a].'-';
            }
			$i+=2;//跳过这个汉字余下的2个字节
        }
		else if( preg_match('/[a-z0-9]/i',$chinese[$i]) )//非汉字的只保留字母和数字
        {
            $retitle .= $chinese[$i];
        }
        else
        {
            $retitle .= '-';
        }
    } 
    $retitle=trim(preg_replace('/-+/', '-', $retitle),'-');
	return $retitle;
}

function Duo_Yin_Zi($str){
    $retitle='';
	$dat_duo=WP_PLUGIN_DIR .'/pinyin-seo/data/duoyinzi.dat';
	$duoyinzi= array();
	$slen=strlen($str);
	if(count($duoyinzi)==0 && is_file($dat_duo)){
        $fp = fopen($dat_duo,'r');
        while(!feof($fp)){
            $line = trim(fgets($fp));
            $duoyinzi[$line[0].$line[1].$line[2].$line[3].$line[4].$line[5]] = substr($line,6,strlen($line)-6);
        }
        fclose($fp);
    }
    for($i=0;$i<$slen;$i++){
        if(ord($str[$i])>128){
            if ($i<($slen-3)){
            $c = $str[$i].$str[$i+1].$str[$i+2].$str[$i+3].$str[$i+4].$str[$i+5];
			}
			else{$c = $str[$i].$str[$i+1].$str[$i+2];}
            if(isset($duoyinzi[$c])){
                $retitle.='-'.$duoyinzi[$c].'-';$i+=5;
            }
			else {$retitle.=$str[$i].$str[$i+1].$str[$i+2];$i+=2;}
        }
		else{
		$retitle .= $str[$i];
		}
	}
return $retitle;
}

function pinyin_seo_specials($title){
    global $pinyinformat,$pinyinseparator;
	if($pinyinformat=='ucwords'){
	$title=str_replace('-',' ',$title);
	$title=ucwords($title);
	$title=str_replace(' ','-',$title);
	}
	if($pinyinformat=='upper'){
	$title=strtoupper($title);
	}
	if($pinyinseparator=='_'){
	$title=str_replace('-','_',$title);
	}
	if($pinyinseparator=='no'){
	$title=str_replace('-','',$title);
	}
    return $title; 
}

function pinyin_seo_slugs($slug) {
	if ($slug) return $slug;
	$title = $_POST['post_title'];
	$title = PinyinSEO($title);
	return $title;
}

function Add_Duo_Yin_Zi($duoyinzi){
$dat_duo=WP_PLUGIN_DIR .'/pinyin-seo/data/duoyinzi.dat';
$add_duoyinzi = "\r\n".$duoyinzi;
// 检测多音字词库是否可写
if (is_writable($dat_duo)) {
    // 使用添加模式打开，指针在文件末尾
    if (!$handle = fopen($dat_duo, 'a')) {
       echo "<div class=\"updated\"><p>操作失败：不能打开多音字词库 <strong>$filename</strong></p></div>";
       exit;
    }
    // 将$add_duoyinzi写入
    if (fwrite($handle, $add_duoyinzi) === FALSE) {
        echo "<div class=\"updated\"><p>操作失败：不能写入到多音字词库 <strong>$filename</strong></p></div>";
        exit;
    }
    echo "<div class=\"updated\"><p>操作成功：成功地将 <strong>$add_duoyinzi</strong> 写入到多音字词库$dat_duo</p></div>";
    fclose($handle);
} else {
    echo "<div class=\"updated\"><p>操作失败：文件 <strong>$dat_duo</strong> 不可写</p></div>";
}
}

if ($pinyin_seo_options['pinyin_slugs']=='true'){
add_filter('sanitize_title', 'PinyinSEO', 1);}
else{
add_filter('name_save_pre', 'pinyin_seo_slugs', 0);}
if ($pinyinseparator!='-' || $pinyinformat!='lower'){
add_filter('sanitize_title', 'pinyin_seo_specials',99);}
add_action('admin_menu', 'PinyinSEO_menu');

function PinyinSEO_menu(){
add_options_page('拼音SEO','拼音SEO', 'manage_options', 'PinyinSEO', 'PinyinSEO_options');
}
function PinyinSEO_options() {
global $pinyin_seo_options,$pinyin_seo_option_defaults;
 require_once('pinyin-seo-admin.php');
}
function delete_pinyinseo_options() {
      delete_option('pinyin_seo');
}
register_deactivation_hook(__FILE__, 'delete_pinyinseo_options');
?>