<?php 
$tags_m= get_option('mytheme_tags_m'); 
if($tags_m==""){
	include_once( 'category.php' ); 
 }else{
	include_once( $tags_m.'.php' ); 
	}  ?>
 <script>
(function(a){a.fn.textSearch=function(f,c){var e={divFlag:true,divStr:" ",markClass:"",markColor:"red",nullReport:true,callback:function(){return false}};var d=a.extend({},e,c||{}),b;if(d.markClass){b="class='"+d.markClass+"'"}else{b="style='color:"+d.markColor+";'"}a("span[rel='mark']").each(function(){var g=document.createTextNode(a(this).text());a(this).replaceWith(a(g))});a.regTrim=function(i){var h=/[\^\.\\\|\(\)\*\+\-\$\[\]\?]/g;var g={};g["^"]="\\^";g["."]="\\.";g["\\"]="\\\\";g["|"]="\\|";g["("]="\\(";g[")"]="\\)";g["*"]="\\*";g["+"]="\\+";g["-"]="\\-";g["$"]="$";g["["]="\\[";g["]"]="\\]";g["?"]="\\?";i=i.replace(h,function(j){return g[j]});return i};a(this).each(function(){var j=a(this);f=a.trim(f);if(f===""){return false}else{var g=[];if(d.divFlag){g=f.split(d.divStr)}else{g.push(f)}}var k=j.html();k=k.replace(/<!--(?:.*)\-->/g,"");var i=/[^<>]+|<(\/?)([A-Za-z]+)([^<>]*)>/g;var h=k.match(i),m=0;a.each(h,function(n,o){if(!/<(?:.|\s)*?>/.test(o)){a.each(g,function(q,p){if(p===""){return}var r=new RegExp(a.regTrim(p),"g");if(r.test(o)){o=o.replace(r,"♂"+p+"♀");m=1}});o=o.replace(/♂/g,"<strong rel='mark' "+b+">").replace(/♀/g,"</strong>");h[n]=o}});var l=h.join("");a(this).html(l);if(m===0&&d.nullReport){return false}d.callback()})};a("#content").textSearch("<?php echo wp_specialchars($s);?>")})(jQuery);

    </script>