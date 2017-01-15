<?php 
/* 
 * post focus
 * ====================================================
*/
function hui_focusslide(){
    $indicators = '';
    $inner = '';
    $sort = _hui('focusslide_sort') ? _hui('focusslide_sort') : '1 2 3 4 5';
    $sort = array_unique(explode(' ', trim($sort)));
    $i = 0;
    foreach ($sort as $key => $value) {
        if( _hui('focusslide_src_'.$value) && _hui('focusslide_href_'.$value) && _hui('focusslide_title_'.$value) ){
            $indicators .= '<li data-target="#slider" data-slide-to="'.$i.'"'.(!$i?' class="active"':'').'></li>';
            $inner .= '<div class="item'.(!$i?' active':'').'"><a'.( _hui('focusslide_blank_'.$value) ? ' target="_blank"' : '' ).' href="'._hui('focusslide_href_'.$value).'"><img src="'._hui('focusslide_src_'.$value).'"><span class="carousel-caption">'._hui('focusslide_title_'.$value).'</span><span class="carousel-bg"></span></a></div>';
            $i++;
        }
    }
    echo '<div id="slider" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">'.$indicators.'</ol><div class="carousel-inner">'.$inner.'</div><a class="left carousel-control" href="#slider" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a><a class="right carousel-control" href="#slider" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a></div>';
}