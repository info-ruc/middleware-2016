<div class="post_form">
  <div class="post_form_in">
  
     <div class="post_form_left">
     
       <?php
	     $from_page=get_option('mytheme_from_page');
		   ob_start(); wp_nav_menu(array( 'walker' => new header_menu(),'container' => false,'menu' => $from_page,'items_wrap' => '<div id="post_form_menu" class="post_form_ul ">%3$s</div>' ) ); ?>  
     </div>
  
  
  <div class="pic_big_bottom_in_search">
              <form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
          <input type="text" id="s" name="s" value="" autocomplete="off"/>
              <input type="submit" value="搜索" id="searchsubmit" />
             </form>
             
             
                 <div class="search_key_mod">
                            <div class="key_search_word"> 
                            <b>推荐搜索：</b> 
                              <?php 
	        	         $search_key= split("\n",get_option('mytheme_big_search_key')); 
			 for($i=0;$i<count($search_key);$i++) {
				 echo'<a href="'.get_bloginfo('url').'/?s='.$search_key[$i].'">'.$search_key[$i].'</a>';
				 
				 }  
	 
	 ?>
                            
                            
                            
                           </div>
                           <ul class="search_list_index">
                           
                              
            <?php  
				$big_search_cat= get_option('mytheme_big_search_cat');
		
			    $query = new WP_Query( array( 'cat' => $big_search_cat , 'showposts' => 5 ));   ?>
              <?php while ( $query->have_posts() ) :$query->the_post();
		    $id =get_the_ID(); 
			$tit= get_the_title();
	        $content= get_the_content();
			$price = get_post_meta($id, 'shop_price', true);
            $original_price=get_post_meta($id,"original_price", true);
			
			
		  ?>  
                           
                              <li>
                              <a class="search_list_index_img"target="_blank"href="<?php the_permalink() ?>"><?php  if (has_post_thumbnail()) { the_post_thumbnail("news",array('alt'	=>$tit, 'title'=> $tit ));} ?></a>
                              <strong><a href="#"><?php  echo mb_strimwidth(strip_tags(apply_filters('the_title', $tit)),  0,25,"...",'utf-8'); ?></a></strong>
                            <p> <?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,50,"...",'utf-8'); ?></p>
                              </li>
                              
                           <?php endwhile; ?>   
                           
                           </ul>
                           
                 
                 </div>
             </div>
  
  
  
  
  
  </div>      
    
</div>	