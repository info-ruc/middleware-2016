=== Pinyin SEO ===
Contributors: Chao Wang
Donate link: http://www.xuewp.com/pinyin-seo/
Tags: pinyin,SEO,slug,permalink,chinese romanization,Chinese characters
Requires at least: 2.1
Tested up to: 3.3.1
Stable tag: /trunk/

拼音SEO插件将文章标题，分类目录以及标签的永久链接转换成拼音。Convert Chinese characters to Pinyin Permalinks. 

== Description ==

拼音SEO插件可在文章发布时将中文标题将或者分类目录以及标签的永久链接转换成拼音格式。

*   可以设定单独对文章的永久链接使用拼音，而不对分类目录和标签使用拼音，之前使用中文标签的需要设置一下，选择标签和分类不使用拼音，否则默认设置下会原来的中文url会出现404错误。
*   **繁简通用**，港澳台同胞也可以使用，更有利于百度SEO，拼音域名都已经四拼时代拉,如参考消息。
*   当前单字拼音数据库共收录**20966个汉字，繁简通用**，已包括中日韩统一表意文字U+4E00..U+9FA5范围所有汉字，韩国和日本造的汉字，均按形声字方法注音。
*   拼音SEO 2.0以上版已包括**多音字功能**，当前多音字词库共收录751个双字词，不包含重复的繁体词，用户可以自行填加多音字双字词，取得更好的SEO效果。

This plugin will convert Chinese characters to Pinyin(Latin alphabet for the romanization of Mandarin Chinese)Permalinks and slugs for SEO purpose.

*   Setting using Pinyin SEO for categories and tags or not.
*   Including 20966 chinese characters in CJK unicode range U+4E00..U+9FA5.
*   Support nearly all Simplified Chinese charaters and Traditional Chinese charaters which can print in computer with default fonts.
*   Enables polyphones(duō yīn zì) function in Pinyin SEO v2.0 now,allow user to add new polyphones words for better SEO performance.

包含功能：

*   设定拼音分隔符。
*   设定拼音大小写格式。
*   简单多音字功能，自定义添加多音字功能。
*   某些用户觉得中文的tag标签SEO效果更好，为此新增加了功能，如果您以前使用的是中文标签，那么就必须设定不对分类目录和标签使用拼音。
*   **以下两项功能涉及数据库操作，建议先备份数据库后在本地操作**。
*   重置所有文章或者页面的永久链接(post_name)，把wp_posts表中post_name字段写成拼音格式。
*   重置所有分类目录或标签的永久链接(slug)，把wp_terms表中slug字段写成拼音格式。
*   恢复所有分类目录或标签的永久链接(slug)为中文，把wp_terms表中slug字段写成中文格式。

SEO建议：

*   分类目录不使用拼音分隔符，每次添加新的分类目录时手工修改，即pinyinfengefu这样的形式，以便和标签有所区别。
*   标签前缀加tag，以便和文章页面有所区别。标签和文章及页面均使用pin-yin-ge-shi这样的形式。
*   一旦设定了拼音格式，请不要轻易改动。

官方演示/Demo: 

[**Wordpress拼音SEO插件官方站点演示**](http://www.xuewp.com/pinyin-seo/ "Wordpress拼音SEO插件")  如果您有任何问题或建议也可以留言，谢谢支持。

作者的其他插件：[**Wordpress中文验证码**](http://www.xuewp.com/chinese-captcha/ "Wordpress中文验证码，汉字的，中国的")   [**韩文SEO/Korean Romanization**](http://www.xuewp.com/korean-romanization/ "把韩文转成拉丁字母永久链接，更利于SEO") 

== Installation ==
1. Search 'pinyin seo' through the 'Add new plugins' page in Wordpress
1. 在 Wordpress 的'添加新插件' 页里搜索 'pinyin seo'
2. Select 'install plugin', and select 'active plugin' after downloaded
2. 选择 '安装插件'，然后再选择 '启用插件'
Or 
或者
1. Download and uncompress 'pinyin-seo' package to the '/wp-content/plugins/' directory
1. 下载并解压 'pinyin-seo' 压缩包到 '/wp-content/plugins/' 目录下
2. Activate the plugin through the 'Plugins' menu in Wordpress
2. 在 Wordpress 的 '插件' 菜单项里启用

== Frequently Asked Questions ==
常见问题：

1. 使用本插件前，请先将您的wordpress的固定链接设置成文章名 ， /%postname%/  ， 或者是自定义如 ， 分类/文章名 ， /%category%/%postname%/ ，或者结尾加htm或html ， /%postname%.htm  ， /%category%/%postname%.html  类似这样的格式，一定要要有postname，否则本插件不会生效。
2. 如果您之前是使用的是中文标签，那么必须选择分类目录和标签不使用拼音，否则中文url会出现404错误。
3. 操作重写永久链接的，请尽量本地测试，而且操作前请一定先备份数据库，有备无患。

== Screenshots ==
1. 效果页面
2. 多音字效果
3. pinyin seo插件设置页面

== Changelog ==

= 1.0 =
* First release.
* 第一版
* Including 20966 chinese characters including CJK unicode range U+4E00..U+9FA5。Support either Simplified or Traditional Chinese charaters.
* 可以转换包括中日韩统一表意文字U+4E00..U+9FA5范围内所有汉字的共20966个。繁简通用。

= 1.1 =
* Add function to enable pinyin-seo in category and tag slugs or not.
* 增加了是否对分类目录和标签的slug启用拼音的控制功能。
* Set no time limit when rewriting the permalinks.
* 解决了进行重置拼音链接时PHP的30秒自动超时问题。

= 1.2 =
* 修正了分类目录和标签的slug不使用拼音，使用中文时永久链接无法访问的问题，凡之前使用中文标签的，必须选择分类目录和标签不使用拼音，否则中文url会出现404错误。

= 2.0 =
* 增加了多音字功能，以及用户自定义添加含多音字的双字词组。

== Upgrade Notice ==

= 1.0 =
* 想设置标签不使用拼音的，必须升级。
* 想把超过500条post记录重写成拼音永久链接的用户必须升级。

= 1.1 =
* 想设置标签不使用拼音的，必须升级。

= 1.2 =
* 想使用多音字功能的，必须升级。