jQuery(function ($) {
    $("#gave").mouseover(function(){
        $("#wechatCode").css('display','block');
    }).mouseout(function(){
        $("#wechatCode").css('display','none');
    })
})