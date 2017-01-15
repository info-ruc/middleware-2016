<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function opshui_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$opshui_settings = get_option( 'opshui' );
	$opshui_settings['id'] = $themename;
	update_option( 'opshui', $opshui_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */

function opshui_options() {

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'face' => 'yahei',
		'style' => 'normal',
		'color' => '#383121' );
		
	$typography_content = array(
		'size' => '13px',
		'face' => 'yahei',
		'style' => 'normal',
		'color' => '#000000' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	// $options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  THEME_URI . '/images/';
	$adsdesc =  __('可添加任意广告联盟代码或自定义代码', 'haoui');

	$rrr = ' / ';
	$nnn = ' / ';



	$options = array();




	/* 
	 * BASIC
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('基本', 'haoui'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'haoui').$rrr.__('图片', 'haoui'),
		'id' => 'logo_src',
		'desc' => __('尺寸：', 'haoui').'126*46',
		'std' => $imagepath.'logo.png',
		'type' => 'upload');


	$options[] = array(
		'name' => __("主题风格", 'haoui'),
		'desc' => __("13种颜色供选择，点击选择你喜欢的颜色，保存后前端展示会有所改变。", 'haoui'),
		'id' => "theme_skin",
		'std' => "be0008",
		'type' => "colorradio",
		'options' => array(
			'be0008' => 1,
			'2CDB87' => 2,
			'00D6AC' => 3,
			'16C0F8' => 4,
			'EA84FF' => 5,
			'FDAC5F' => 6,
			'FD77B2' => 7,
			'76BDFF' => 8,
			'C38CFF' => 9,
			'FF926F' => 10,
			'8AC78F' => 11,
			'C7C183' => 12,
			'555555' => 13
		)
	);

	$options[] = array(
		'id' => 'theme_skin_custom',
		'std' => "",
		'desc' => __('不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）', 'haoui'),
		'type' => "color");

	$options[] = array(
		'name' => __('全站连接符', 'haoui'),
		'id' => 'connector',
		'desc' => __('一经选择，切勿更改，对SEO不友好，一般为“-”或“_”', 'haoui'),
		'std' => _hui('connector') ? _hui('connector') : '-',
		'type' => 'text',
		'class' => 'mini');

	
	$options[] = array(
		'name' => __('jQuery底部加载', 'haoui'),
		'id' => 'jquery_bom',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__('（可提高页面内容加载速度，但部分依赖jQuery的插件可能失效）', 'haoui'));


	$options[] = array(
		'name' => __('Gravatar 头像获取', 'haoui'),
		'id' => 'gravatar_url',
		'std' => "ssl",
		'type' => "radio",
		'options' => array(
			'no' => __(' 原有方式', 'haoui'),
			'ssl' => __(' 从Gravatar官方ssl获取', 'haoui'),
			'duoshuo' => __(' 从多说服务器获取', 'haoui')
		));

	$options[] = array(
		'name' => __('JS文件托管（可大幅提速JS加载）', 'haoui'),
		'id' => 'js_outlink',
		'std' => "no",
		'type' => "radio",
		'options' => array(
			'no' => __(' 不托管', 'haoui'),
			'baidu' => __(' 百度', 'haoui'),
			'360' => __(' 360', 'haoui'),
			'he' => __(' 框架来源站点（分别引入jquery和bootstrap官方站点JS文件）', 'haoui')
		));

	$options[] = array(
		'name' => __('网站整体变灰', 'haoui'),
		'id' => 'site_gray',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__('（支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度）', 'haoui'));

	$options[] = array(
		'name' => __('分类url去除category字样', 'haoui'),
		'id' => 'no_categoty',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__('（该功能和no-category插件作用相同）', 'haoui'));

	/*$options[] = array(
		'name' => __('导航搜索框', 'haoui').'(v4.1+)',
		'id' => 'search_nav',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').' '.__('开启后会在导航区域增加搜索框，不同布局不同展示方式', 'haoui'));

	$options[] = array(
		'name' => __('移动端搜索框', 'haoui').'(v4.1+)',
		'id' => 'search_nav_m',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('顶部登录注册链接', 'haoui'),
		'id' => 'sign_f',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('头部菜单设置', 'haoui'),
		'desc' => __('案例：', 'haoui').'&lt;a href="'.site_url().'" title="'.__('网址', 'haoui').'01"&gt;'.__('网址', 'haoui').'01&lt;/a&gt;',
		'id' => 'menu_links',
		'std' => '<a href="'.site_url().'" title="'.__('网址', 'haoui').'01">'.__('网址', 'haoui').'01</a>|<a href="'.site_url().'" title="'.__('网址', 'haoui').'02">'.__('网址', 'haoui').'02</a>|<a href="'.site_url().'" title="'.__('网址', 'haoui').'03">'.__('网址', 'haoui').'03</a>',
		'type' => 'textarea');   调用 <?php echo _hui('menu_links') ?>
*/
	
	$options[] = array(
		'name' => __('网站底部信息', 'haoui'),
		'id' => 'footer_seo',
		'std' => '<a href="'.site_url('/sitemap.xml').'">'.__('网站地图', 'haoui').'</a>'."\n",
		'desc' => __('备案号可写于此，网站地图可自行使用sitemap插件自动生成', 'haoui'),
		'type' => 'textarea');

	




	/* 
	 * SEO
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('SEO', 'haoui'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('首页关键字(keywords)', 'haoui'),
		'id' => 'keywords',
		'std' => '123,12345',
		'desc' => __('关键字有利于SEO优化，建议个数在5-10之间，用英文逗号隔开', 'haoui'),
		'settings' => array(
			'rows' => 3
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => __('首页描述(description)', 'haoui'),
		'id' => 'description',
		'std' => __('123 一个高端大气上档次的网站', 'haoui'),
		'desc' => __('描述有利于SEO优化，建议字数在30-70之间', 'haoui'),
		'settings' => array(
			'rows' => 4
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => __('分类关键字', 'haoui'),
		'id' => 'cat_keyworks_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__(' 开启后分类的关键字将自动获取分类中的“图像描述”中的一部分，请用“::::::”6个英文冒号隔开关键字和描述，比如：<br>关键字1,关键字2<br>::::::<br>描述描述描述描述描述描述描述', 'haoui'));

	$options[] = array(
		'name' => __('网站自动添加关键字和描述', 'haoui'),
		'id' => 'site_keywords_description_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui').__('（开启后所有页面将自动使用主题配置的关键字和描述，具体规则可以自行查看页面源码得知）', 'haoui'));

	$options[] = array(
		'name' => __('文章关键字和描述自定义', 'haoui'),
		'id' => 'post_keywords_description_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__('（开启后你需要在编辑文章的时候书写关键字和描述，如果为空，将自动使用主题配置的关键字和描述；开启这个必须开启上面的“网站自动添加关键字和描述”开关）', 'haoui'));


	$options[] = array(
		'name' => __('文章发布时间格式', 'haoui'),
		'id' => 'post_date_format',
		'type' => "text",
		'std' => 'Y-m-d',
		'desc' => __(' Y=年，m=月，d=日，H=小时，i=分钟，s=秒，默认：Y-m-d', 'haoui'));

	$options[] = array(
		'id' => 'post_date_ago',
		'type' => "checkbox",
		'std' => false,
		'desc' => __(' 使用“xx以前”的展示方式，一旦使用，将不使用上面设置的时间格式', 'haoui'));





	/* 
	 * LIST
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('列表', 'haoui'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('新窗口打开文章', 'haoui'),
		'id' => 'target_blank',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));


	$options[] = array(
		'name' => __('小部件开启', 'haoui'),
		'id' => 'post_plugin',
		'std' => array(
			'view' => 1,
			'like' => 1,
			'comm' => 1
		),
		'type' => "multicheck",
		'options' => array(
			'view' => __(' 阅读量', 'haoui'),
			'like' => __(' 点赞', 'haoui'),
			'comm' => __(' 列表评论数 ', 'haoui'),
			'siteauthor' => __(' 列表作者名字 ', 'haoui')
		));

	$options[] = array(
		'name' => __('作者加链接', 'haoui'),
		'id' => 'author_link',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui').__(' （列表和文章有作者的地方都会加上链接） ', 'haoui'));


	$options[] = array(
		'name' => __('分页', 'haoui').$rrr.__('模式', 'haoui'),
		'id' => 'paging_type',
		'std' => "next",
		'type' => "radio",
		'options' => array(
			'next' => __(' 上一页 和 下一页', 'haoui'),
			'multi' => __(' 显示页码，如：上一页 1 2 3 4 5 下一页', 'haoui')
		));


	$options[] = array(
		'name' => __('分页', 'haoui').$rrr.__('PC端无限加载', 'haoui'),
		'id' => 'ajaxpager_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('分页', 'haoui').$rrr.__('手机端无限加载', 'haoui'),
		'id' => 'ajaxpager_s_m',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('分页', 'haoui').$rrr.__('无限加载页数', 'haoui'),
		'id' => 'ajaxpager',
		'std' => 5,
		'class' => 'mini',
		'desc' => __('为0时表示不开启分页无限加载功能，默认为5', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('列表模式', 'haoui'),
		'id' => 'list_type',
		'std' => "four",
		'type' => "radio",
		'options' => array(
		/*	'more' => __(' 12图（如果有特色图就会采取单图模式；其次调取文章中图片，文章图片个数大于12张就会显示前12张，在8-12张之间就会显示8张，在4-8张之间就会显示4张，在1-4张之间就会显示1张；如果文章中也没图就是无图模式） ', 'haoui'),
			'multi' => __(' 8图（如果有特色图就会采取单图模式；其次调取文章中图片，文章图片个数大于8张就会显示前8张，在4-8张之间就会显示4张，在1-4张之间就会显示1张；如果文章中也没图就是无图模式） ', 'haoui'),*/
			'four' => __(' 4图（如文章设置了特色图就会采取单图模式，其次调取文章中前4张图片，小于4张图采取单图模式，再没有就是无图模式） ', 'haoui'),
			'thumb' => __(' 1图（调取文章特色图，如果没有就调取文章中的第一张图，再没有就是无图模式） ', 'haoui'),
			'none' => __(' 无图 ', 'haoui')
		));


	$options[] = array(
		'id' => 'list_thumb_out',
		'type' => "checkbox",
		'std' => false,
		'desc' => __(' 缩略图使用外链图片', 'haoui'));

	/* 
	 * SIDEBAR
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('侧栏', 'haoui'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('侧栏随动', 'haoui').$rrr.__('首页', 'haoui'),
		'id' => 'sideroll_index_s',
		'std' => true,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_index',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块 ', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动', 'haoui').$rrr.__('分类|标签|搜索页', 'haoui'),
		'id' => 'sideroll_list_s',
		'std' => true,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_list',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块 ', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动', 'haoui').$rrr.__('文章页', 'haoui'),
		'id' => 'sideroll_post_s',
		'std' => true,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_post',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块 ', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('侧栏随动', 'haoui').$rrr.__('页面', 'haoui'),
		'id' => 'sideroll_page_s',
		'std' => true,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'id' => 'sideroll_page',
		'std' => '1 2',
		'class' => 'mini',
		'desc' => __(' 设置随动模块，多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块 ', 'haoui'),
		'type' => 'text');




	/* 
	 * HOME
	 * ====================================================================================================
	 */

	$options[] = array(
		'name' => __('首页', 'haoui'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('首页不显示该分类下文章', 'haoui'),
		'id' => 'notinhome',
		'options' => $options_categories,
		'type' => 'multicheck');

	$options[] = array(
		'name' => __('首页近期发布文章数目', 'haoui'),
		'id' => 'recent_posts_number',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui').$nnn.__('显示样式：24小时更新：5篇 &nbsp; 一周更新：5篇最近更新', 'haoui'));


	$options[] = array(
		'name' => __('首页最新发布标题', 'haoui'),
		'id' => 'index_list_title',
		'std' => __('最新发布', 'haoui'),
		'type' => 'text');


/*	$options[] = array(
		'name' => __('热门排行', 'haoui'),
		'id' => 'most_list_s',
		'std' => true,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('热门排行', 'haoui').$rrr.__('模式', 'haoui'),
		'id' => 'most_list_style',
		'std' => "comment",
		'type' => "radio",
		'options' => array(
			'comment' => __('按文章评论数', 'haoui'),
			'view' => __('按文章阅读数', 'haoui')
		));

	$options[] = array(
		'name' => __('热门排行', 'haoui').$rrr.__('标题', 'haoui'),
		'id' => 'most_list_title',
		'std' => __('一周热门排行', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('热门排行', 'haoui').$rrr.__('最近多少天内的文章', 'haoui'),
		'id' => 'most_list_date',
		'std' => 7,
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('热门排行', 'haoui').$rrr.__('显示数量', 'haoui'),
		'id' => 'most_list_number',
		'std' => 5,
		'class' => 'mini',
		'type' => 'text');




	$options[] = array(
		'name' => __('置顶推荐', 'haoui'),
		'id' => 'sticky_s',
		'std' => true,
		'desc' => __('开启', 'haoui').$nnn.__('调取置顶文章，设置置顶文章方法：后台-文章-快速编辑-置顶选中即可', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('置顶推荐', 'haoui').$rrr.__('显示在文章页面', 'haoui'),
		'id' => 'sticky_post_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('置顶推荐', 'haoui').$rrr.__('标题', 'haoui'),
		'id' => 'sticky_title',
		'std' => __('热门推荐', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('置顶推荐', 'haoui').$rrr.__('显示数量', 'haoui'),
		'id' => 'sticky_limit',
		'std' => 4,
		'class' => 'mini',
		'type' => 'text');




	$options[] = array(
		'name' => __('焦点图', 'haoui'),
		'id' => 'focus_s',
		'std' => true,
		'desc' => __('开启', 'haoui').$nnn.__('以下设置将显示在焦点图的第一张，其它位置调用的是置顶文章，设置置顶文章方法：后台-文章-快速编辑-置顶选中即可', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('焦点图', 'haoui').$rrr.__('标题', 'haoui'),
		'id' => 'focus_title',
		'std' => get_bloginfo('name'),
		'type' => 'text');

	$options[] = array(
		'name' => __('焦点图', 'haoui').$rrr.__('链接到', 'haoui'),
		'id' => 'focus_href',
		'std' => site_url(),
		'type' => 'text');

	$options[] = array(
		'name' => __('焦点图', 'haoui').$rrr.__('图片', 'haoui'),
		'id' => 'focus_src',
		'desc' => __('尺寸：', 'haoui').'360*266',
		'std' => $imagepath.'thumbnail.png',
		'type' => 'upload');
*/

	$options[] = array(
		'name' => __('轮换图', 'haoui'),
		'id' => 'focusslide_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('轮换图', 'haoui').$rrr.__('显示在移动端', 'haoui'),
		'id' => 'focusslide_s_m',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('轮换图', 'haoui').$rrr.__('排序', 'haoui'),
		'id' => 'focusslide_sort',
		'desc' => __('默认：', 'haoui').'1 2 3 4 5',
		'std' => '1 2 3 4 5',
		'type' => 'text');

	for ($i=1; $i <= 5; $i++) { 
		
	$options[] = array(
		'name' => __('轮换图', 'haoui').$rrr.__('图', 'haoui').$i,
		'id' => 'focusslide_title_'.$i,
		'desc' => __('标题', 'haoui'),
		'std' => get_bloginfo('name'),
		'type' => 'text');

	$options[] = array(
		'id' => 'focusslide_href_'.$i,
		'desc' => __('链接', 'haoui'),
		'std' => site_url(),
		'type' => 'text');

	$options[] = array(
		'id' => 'focusslide_blank_'.$i,
		'std' => true,
		'desc' => __('新窗口打开', 'haoui'),
		'type' => 'checkbox');
	
	$options[] = array(
		'id' => 'focusslide_src_'.$i,
		'desc' => __('图片，尺寸：', 'haoui').'860*320',
		'std' => $imagepath.'thumbnail.png',
		'type' => 'upload');


	}



	/* 
	 * POST
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('文章页', 'haoui'),
		'type' => 'heading');


	
	$options[] = array(
		'name' => __('面包屑导航', 'haoui'),
		'id' => 'breadcrumbs_single_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('面包屑导航', 'haoui').$rrr.__('用“正文”替代标题', 'haoui'),
		'id' => 'breadcrumbs_single_text',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('相关文章', 'haoui'),
		'id' => 'post_related_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('相关文章', 'haoui').$rrr.__('模式', 'haoui').'(ver4.1+)',
		'id' => 'post_related_model',
		'type' => "radio",
		'std' => 'thumb',
		'options' => array(
			'thumb' => __(' 图文模式 ', 'haoui'),
			'text' => __(' 文字链模式 ', 'haoui')
		));

	$options[] = array(
		'name' => __('相关文章', 'haoui').$rrr.__('显示数量', 'haoui'),
		'id' => 'post_related_n',
		'std' => 8,
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('相关文章', 'haoui').$rrr.__('标题', 'haoui'),
		'id' => 'related_title',
		'std' => __('精彩推荐', 'haoui'),
		'type' => 'text');


	$options[] = array(
		'name' => __('文章来源', 'haoui'),
		'id' => 'post_from_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));
	
	$options[] = array(
		'name' => __('文章来源', 'haoui').$rrr.__('显示字样', 'haoui'),
		'id' => 'post_from_h1',
		'std' => __('来源：', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('文章段落缩进', 'haoui'),
		'id' => 'post_p_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));



	$options[] = array(
		'name' => __('文章页尾版权', 'haoui'),
		'id' => 'post_copyright_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('文章页尾版权', 'haoui').$rrr.__('提示文字', 'haoui'),
		'id' => 'post_copyright',
		'std' => __('未经允许不得转载', 'haoui'),
		'type' => 'text');

	

	$options[] = array(
		'name' => __('文章评论', 'haoui').$rrr.__('标题', 'haoui'),
		'id' => 'comment_title',
		'std' => __('评论', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('文章评论', 'haoui').$rrr.__('评论框默认字符', 'haoui'),
		'id' => 'comment_text',
		'std' => __('请输入评论', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('文章评论', 'haoui').$rrr.__('评论提交按钮字符', 'haoui'),
		'id' => 'comment_submit_text',
		'std' => __('发布', 'haoui'),
		'type' => 'text');







	/* 
	 * PAGE
	 * ====================================================================================================
	
 */	

	$options[] = array(
		'name' => __('页面', 'haoui'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('读者墙', 'haoui'),
		'id' => 'readwall_limit_time',
		'std' => 200,
		'class' => 'mini',
		'desc' => __('限制在多少月内，单位：月', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'id' => 'readwall_limit_number',
		'std' => 200,
		'class' => 'mini',
		'desc' => __('显示个数', 'haoui'),
		'type' => 'text');

	$options[] = array(
		'name' => __('页面左侧菜单设置', 'haoui'),
		'id' => 'page_menu',
		'options' => $options_pages,
		'desc' => __('这是个控制页面模板“Page Has Menu”左侧菜单的选项，如果你还没有页面使用“Page Has Menu”页面模板，请先新建一个页面并选择该页面模版。', 'haoui'),
		'type' => 'multicheck');

	




	/* 
	 * LINK
	 * ====================================================================================================
	 
	
	$options[] = array(
		'name' => __('直达链接', 'haoui'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('在文章列表显示', 'haoui'),
		'id' => 'post_link_excerpt_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('在文章页面显示', 'haoui'),
		'id' => 'post_link_single_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('新窗口打开链接', 'haoui'),
		'id' => 'post_link_blank_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('链接添加 nofollow', 'haoui'),
		'id' => 'post_link_nofollow_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('开启', 'haoui'));

	$options[] = array(
		'name' => __('自定义显示文字', 'haoui'),
		'id' => 'post_link_h1',
		'type' => "text",
		'std' => '直达链接',
		'desc' => __(' 默认为“直达链接” ', 'haoui'));


*/


	/* 
	 * ACCOUNT
	 * ====================================================================================================
	
	
	$options[] = array(
		'name' => __('社交', 'haoui'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('微博', 'haoui'),
		'id' => 'weibo',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('腾讯微博', 'haoui'),
		'id' => 'tqq',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'haoui'),
		'id' => 'twitter',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook', 'haoui'),
		'id' => 'facebook',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('微信帐号', 'haoui'),
		'id' => 'wechat',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'id' => 'wechat_qr',
		'std' => $imagepath . 'ads_default.jpg',
		'desc' => __('微信二维码，建议图片尺寸：', 'haoui').'200x200px',
		'type' => 'upload');

	$options[] = array(
		'name' => __('RSS订阅', 'haoui'),
		'id' => 'feed',
		'std' => get_feed_link(),
		'type' => 'text');


 */


	/* 
	 * ADS
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('广告位', 'haoui'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('首页内容最上', 'haoui'),
		'id' => 'ads_index_01_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_index_01',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_index_01_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('首页文章列表上', 'haoui'),
		'id' => 'ads_index_02_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_index_02',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_index_02_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('首页分页下', 'haoui'),
		'id' => 'ads_index_03_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_index_03',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_index_03_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('文章页正文上', 'haoui'),
		'id' => 'ads_post_01_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_post_01',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_post_01_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('文章页正文下', 'haoui'),
		'id' => 'ads_post_02_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_post_02',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_post_02_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('文章页评论上', 'haoui'),
		'id' => 'ads_post_03_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_post_03',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_post_03_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('分类页列表上', 'haoui'),
		'id' => 'ads_cat_01_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_cat_01',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_cat_01_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('标签页列表上', 'haoui'),
		'id' => 'ads_tag_01_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_tag_01',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_tag_01_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('搜索页列表上', 'haoui'),
		'id' => 'ads_search_01_s',
		'std' => false,
		'desc' => __('开启', 'haoui'),
		'type' => 'checkbox');
	$options[] = array(
		'desc' => __('非手机端', 'haoui').' '.$adsdesc,
		'id' => 'ads_search_01',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'id' => 'ads_search_01_m',
		'std' => '',
		'desc' => __('手机端', 'haoui').' '.$adsdesc,
		'type' => 'textarea');




	/* 
	 * CODE
	 * ====================================================================================================
	 */
	
	$options[] = array(
		'name' => __('自定义代码', 'haoui'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('自定义CSS样式', 'haoui'),
		'desc' => __('位于</head>之前，直接写样式代码，不用添加&lt;style&gt;标签', 'haoui'),
		'id' => 'csscode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('自定义头部代码', 'haoui'),
		'desc' => __('位于</head>之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的<meta>标签、全站头部JS等需要提前加载的代码', 'haoui'),
		'id' => 'headcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('自定义底部代码', 'haoui'),
		'desc' => __('位于&lt;/body&gt;之前，这部分代码是在主要内容加载完毕加载，通常是JS代码', 'haoui'),
		'id' => 'footcode',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('网站统计代码', 'haoui'),
		'desc' => __('位于底部，用于添加第三方流量数据统计代码，如：Google analytics、百度统计、CNZZ、51la，国内站点推荐使用百度统计，国外站点推荐使用Google analytics', 'haoui'),
		'id' => 'trackcode',
		'std' => '',
		'type' => 'textarea');
		
	return $options;
}



/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('opshui_custom_scripts', 'opshui_custom_scripts');

function opshui_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});
	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}
	
	$('#show_top_teaser').click(function() {
  		$('#section-top_teaser').fadeToggle(400);
	});
	if ($('#show_top_teaser:checked').val() !== undefined) {
		$('#section-top_teaser').show();
	}
	
	$('#show_megamenu').click(function() {
  		$('#section-megamenu, #section-megamenu_title').fadeToggle(400);
	});
	if ($('#show_megamenu:checked').val() !== undefined) {
		$('#section-megamenu, #section-megamenu_title').show();
	}
	
	$('#autoplay').click(function() {
  		$('#section-autoplay_timer').fadeToggle(400);
	});
	if ($('#autoplay:checked').val() !== undefined) {
		$('#section-autoplay_timer').show();
	}

	// Custom Fonts
	$("#heading_typography_face").change(function(){
		if ($(this).val() === 'custom') {
			console.log("hi");
			$('#section-custom_heading_font, #section-custom_heading_font_url').show(400);
		}
		else {
			$('#section-custom_heading_font, #section-custom_heading_font_url').hide(400);
		}
		
	});
	if ($('#heading_typography_face').val() == 'custom') {
		$('#section-custom_heading_font, #section-custom_heading_font_url').show();
	}
	
	$("#content_typography_face").change(function(){
		// console.log($(this).val());
		if ($(this).val() === 'custom') {
			console.log("hi");
			$('#section-custom_content_font, #section-custom_content_font_url').show(400);
		}
		else {
			$('#section-custom_content_font, #section-custom_content_font_url').hide(400);
		}
		
	});
	if ($('#content_typography_face').val() == 'custom') {
		$('#section-custom_content_font, #section-custom_content_font_url').show();
	}

	

});
</script>

<?php
}