=== Plugin Name ===
Contributors: rpayne7264
Tags: mediawiki, wiki, wiki embed
Requires at least: 3.0
Tested up to: 4.6.1
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

RDP Wiki Embed lets you embed content from MediaWiki sites.

== Description ==

RDP Wiki Embed will pull content from any MediaWiki website (such as wikipedia.org) and embed it in pages and posts. It strips and reformats the content, allowing you to supply some arguments to dictate how this works.

RDP Wiki Embed can also look for all links to wiki sites listed in the Security section and force the content on the current page to be replaced with the content found at the wiki site when the link is clicked. Visitors will be able to read wiki content without leaving your site.

Works automatically with [RDP PediaPress Embed] (https://wordpress.org/plugins/rdp-pediapress-embed/)

= Sponsor =

This plug-in brought to you through the generous funding of [Laboratory Informatics Institute, Inc.](http://www.limsinstitute.org/)


== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'RDP Wiki Embed'
3. Click the Install Now link.
3. Activate RDP Wiki Embed once it is installed.


= From WordPress.org =

1. Download RDP Wiki Embed zip file.
2. Upload the 'rdp-wiki-embed' directory from the zip file to your '/wp-content/plug-ins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate RDP Wiki Embed from your Plugins page.


= After Activation - Go to 'Settings' > 'RDP Wiki' and: =

1. Set configurations as desired.
2. Click 'Save Changes' button.



== Usage ==

Use the shortcode [rdp-wiki-embed] for embedding MediaWiki content. The following arguments are accepted:

* url: (required) the web address of the wiki article that you want to embed on this page
* toc_show: 0 (zero) to hide table of contents (TOC) or 1 to show
* edit_show: 0 (zero) to hide edit links or 1 to show 
* infobox_show: 0 (zero) to hide info boxes or 1 to show 
* unreferenced_show: 0 (zero) to hide "unreferenced" warning boxes  or 1 to show 
* wiki_update: number of minutes content of the wiki page will be stored on your site, before it is refreshed 
* wiki_links: result of clicking a link to wiki content - default, overwrite 
* wiki_links_open_new: 0 (zero) to open wiki links in same window or 1 to open in new window 
* global_content_replace: 1 to apply behavior to all wiki links on the site or 0 (zero)  
* global_content_replace_template: page template to use for replaced content
* source_show: 0 (zero) to hide attribution or 1 to show 
* pre_source: text for source label



= Examples =

Basic uasge:

[rdp-wiki-embed url='http://en.wikipedia.org']


Display table-of-contents and info boxes, but hide edit links and 'unreferenced' warning boxes:

[rdp-wiki-embed url='http://en.wikipedia.org' toc_show='1' edit_show='0' infobox_show='1' unreferenced_show='0']


= About Overwrite and Global Content Replace =

Global content replace requires Overwrite mode to be enabled. When content is being replaced in Overwrite mode, the Default Shortcode Settings on the plug-in's settings page will be applied to content that is fetched from wiki sites.


== Screenshots ==

1. Settings page
2. Media button to launch shortcode embed helper form
3. Shortcode embed helper form


== Change Log ==

= 1.1.2 =
* Security update

= 1.1.1 =
* Updated CSS to show formulas

= 1.1.0 =
* Fix no-cache option setting
* Add option setting to show wiki admin links
* Add option setting to show wiki footer


= 1.0.0 =
* Initial RC

== Upgrade Notice ==

== Other Notes ==


== Hook Reference: ==

= rdp_we_scripts_enqueued =

* Param: none
* Fires after enqueuing plug-in-specific scripts and styles
