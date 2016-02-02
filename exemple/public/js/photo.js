jQuery.noConflict();

(function($){
    $(document).ready(function(){
        //Add photo 
    $(".input-admin .add_img").click(function(e){
          e.preventDefault();
          
          $(this).html("Modify photo");
          
          //launch media library
           var $this = $(this);
           var uploader = wp.media({
             title: "Add image ",
              button: {
                  text: "Choose an image"
              },
              multiple: false
           })
           .on("select",function(){
               var selection = uploader.state().get("selection");
               var attachement = selection.first().toJSON();
               
               $this.parent().find("input.img_input").val(attachement.url);
               $this.parent().parent().find(".img_view").attr("src",attachement.url);
               $this.parent().parent().find(".img_view").show();
               $this.after(" <button  class='del_img button button-secondary'>Delete Photo</button>");
                              
           })
           .open();
          
       });

        $(document).on("click",".del_img", function(e){
            e.preventDefault();

            $(this).closest(".input-admin").find("input").val("");
            $(this).closest(".input-admin").find(".img_view").attr("src","");
            $(this).closest(".input-admin").find(".img_view").hide();
            $(this).closest(".input-admin").find(".add_img").html("Add photo");
            $(this).remove();

        });
       
    });
})(jQuery);


