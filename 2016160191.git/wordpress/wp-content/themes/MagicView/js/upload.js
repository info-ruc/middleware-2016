jQuery(document).ready(function() {   

  

$(".new_pic span #pics_1").click(function() { 
      $(".new_pic").children("div").removeClass("opne");
	  $("#picss1").addClass("opne");
	  $(".new_pic span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  $(".new_pic span #pics_2").click(function() { 
      $(".new_pic").children("div").removeClass("opne");
	  $("#picss2").addClass("opne");
	  $(".new_pic span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  $(".new_pic span #pics_3").click(function() { 
      $(".new_pic").children("div").removeClass("opne");
	  $("#picss3").addClass("opne");
	  $(".new_pic span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  $(".new_pic span #pics_4").click(function() { 
      $(".new_pic").children("div").removeClass("opne");
	  $("#picss4").addClass("opne");
	  $(".new_pic span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  
  $("#pic_1").click(function() { 
      $("#wenzixiaot").children("div").removeClass("opne");
	  $("#moke1").addClass("opne");
	  $("#wenzixiaot span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  $(" #pic_2").click(function() { 
      $("#wenzixiaot").children("div").removeClass("opne");
	  $("#moke2").addClass("opne");
	  $("#wenzixiaot span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
  $("#pic_3").click(function() { 
      $("#wenzixiaot").children("div").removeClass("opne");
	  $("#moke3").addClass("opne");
	  $("#wenzixiaot span").children("a").removeClass("chouws");
       $(this).addClass("chouws")

  }); 
  
 

 });  


 jQuery(document).ready(function(){   
    var theme_upload_frame;   
    var value_id; 
	
    jQuery('.upload_button,.up #upbottom,.edit-menu-item-description').on('click',function(event){   
        value_id =jQuery(this).prev('input');      
        
        theme_upload_frame = wp.media({   
            title: '选择图片',   
            button: {   
                text: '选择',   
            }   , multiple: false   
     
			
        });   
           if(theme_upload_frame){
           theme_upload_frame.open();    
		   }
       
        theme_upload_frame.on('select',function(){   
            attachment = theme_upload_frame.state().get('selection').first().toJSON();   
            jQuery(value_id).val(attachment.url);
			jQuery(".supports-drag-drop").remove();     
        });   
           
        
    });  

    });   
