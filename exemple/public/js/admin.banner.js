jQuery.noConflict();
(function($){
    $(document).ready(function(){
        $(".checkbox input[type='radio']").click(function(){


            if(confirm("Are you sure? You will lose the input data") ){

                $(this).closest(".banner").find(".image_banner, .construct").hide();
                $(this).closest(".banner").find("."+$(this).val()).show();

                switch($(this).val()){
                    case "image_banner":
                        $(this).closest(".banner").find(".delete_this").show();
                    break;
                    case "construct":
                        $(this).closest(".banner").find(".image_banner img").attr("src","").hide();
                        $(this).closest(".banner").find(".image_banner input").val("");
                        $(this).closest(".banner").find(".image_banner .add_image").html("Add Banner");
                        $(this).closest(".banner").find(".image_banner .del_banner").remove();
                        $(this).closest(".banner").find(".delete_this").show();
                    break;
                    default:
                            $(this).closest(".banner").find(".delete_this").hide();
                    break;
                }
            }else{

            }

        });

        $(".delete_this").click(function(e){
            e.preventDefault();
            var $banner = $(this).closest(".banner");
            $banner.find(".checkbox input").removeAttr("checked");
            $banner.find(".image_banner img").attr("src","").hide();
            $banner.find(".image_banner input").val("");
            $banner.find(".image_banner .add_image").html("Add Banner");
            $banner.find(".image_banner .del_banner").remove();
            if($banner.find(".preview_banner").is(":visible")){
                $banner.find(".view_preview").click();
            }
            if($banner.find(".config").is(":visible")){
                $banner.find(".configurate").click();
            }

        });

        $(".add_image").click(function(e){
            e.preventDefault();

            var $this = $(this);
            var $image_banner = $(this).closest(".image_banner");
            var $input = $image_banner.find("input.url_img")
            var $img = $image_banner.find("img");

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
                    $input.val(attachement.url);
                    $img.attr("src",attachement.url);
                    $img.show();
                    if($image_banner.find(".del_banner").length == 0){
                        $this.after(" <button class='del_banner button button-secondary'>Delete Banner</button>");
                    }
                    $this.html("Modify banner");
                })
                .open();
        });

        $(document).on("click", ".del_banner", function(e){
            e.preventDefault();
            var $img    = $(this).closest(".image_banner").find("img");
            var $input  = $(this).closest(".image_banner").find("input");
            var $button = $(this).closest(".image_banner").find(".add_image");
            $img.attr("src","")
            $img.hide();

            $input.val("");
            $button.html("Add Banner");
            $(this).remove();
        });

        $(".banner .color").spectrum({
            preferredFormat: "hex",
            showInput: true,
            allowEmpty:false,
            showPalette: true,
            showPaletteOnly: true,
            palette: [
                ['#4bb4e6', '#50be87', '#9164cd', '#ffb4e6', '#ffdc00', "#fff", "f60", "#000", "#ddd"]
            ]
        });
        $(".banner .font_color").spectrum({
            preferredFormat: "hex",
            showInput: true,
            allowEmpty:false,
            showPalette: true,
            showPaletteOnly: true,
            palette: [
                ['#000', '#fff']
            ]
        });
        $(document).on("change", ".construct .bgcolor", function(){
            var color = $(this).val();
            $(this).closest(".construct").find(".preview_banner").css("background-color", color);
        });

        $(document).on("change", ".construct .font_color", function(){
            var color = $(this).val();
            $(this).closest(".construct").find(".preview_banner").css("color", color+"!important");
        });
        $(document).on("keyup",".construct .title",function(){
            var title = $(this).val();
            $(this).closest(".construct").find(".preview_banner h3").html(title);
        });
        $(document).on("keyup",".construct .text",function(){
            var text = $(this).val();
            $(this).closest(".construct").find(".preview_banner p").html(nl2br(text));
        });

        $(document).on("keyup",".construct .text",function(){
            var text = $(this).val();
            $(this).closest(".construct").find(".preview_banner p").html(nl2br(text));
        });

        $(document).on("keyup",".construct .title_link",function(){
            var text = $(this).val();
            $(this).closest(".construct").find(".preview_banner a").html(nl2br(text));
        });

        $(document).on("keyup",".construct .url_link",function(){
            var text = $(this).val();
            $(this).closest(".construct").find(".preview_banner a").attr("href",text);
        });

        $(document).on("click",".color_link", function(e){

            var color = $(this).val();

            $(this).closest(".construct").find(".preview_banner a")
                .removeClass("white")
                .removeClass("black");
            $(this).closest(".construct").find(".preview_banner a").addClass(color);


        });

        $(document).on("click",".add_image_banner", function(e){
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

                    $this.closest(".construct").find("input.url_image").val(attachement.url);
                    $this.closest(".construct").find(".preview_banner img").attr("src", attachement.url);
                    $this.after(" <button class='del_img_banner button button-secondary'>Delete Photo</button>");

                })
                .open();

        });

        $(document).on("click", ".del_img_banner", function(e){
            e.preventDefault();

            $(this).closest(".construct").find("input.url_image").val("");
            $(this).closest(".construct").find(".preview_banner img").attr("src", "");
            $(this).remove();
        });

        $(".view_preview").click(function(e){
            e.preventDefault();

            if($(this).closest(".construct").find(".preview_banner").is(":hidden")){
                $(this).html("Close Banner Preview");
                $(this).closest(".construct").find(".preview_banner").show();
            }else{
                $(this).closest(".construct").find(".preview_banner").hide();
                $(this).html("View Banner Preview");
            }
        });

        $(".configurate").click(function(e){
            e.preventDefault();
            if($(this).closest(".construct").find(".config").is(":hidden")){
                $(this).html("Hide");
                $(this).closest(".construct").find(".config").show();
            }else{
                $(this).html("Configurate Banner");
                $(this).closest(".construct").find(".config").hide();

            }
        });



    });
})(jQuery);
