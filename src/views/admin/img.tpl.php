<?php
//wp_enqueue_media();
global $post_id;
global $variable;
?>
<div class="input-admin">
    
    <div class="col-sm-2">
        <b><?=$variable["label"]?></b>
    </div>
    <div class="col-sm-8">
            <input type="text" name="<?=$variable["name"]?>" class="img_input"  value="<?=get_post_meta($post_id,$variable["name"], true)?>" />
            <button  class="add_img button button-secondary"><?=(get_post_meta($post_id,$variable["name"], true) == "")? "Add image" : "Modify image"?></button>
            <?=(get_post_meta($post_id,$variable["name"], true) != "")? "<button  class='del_img button button-secondary'>Delete image</button>": ""?>

        </div>
        <div class="col-sm-offset-2 col-sm-10">
            <img class="img_view <?=$variable["class"]?>" <?=(get_post_meta($post_id,$variable["name"], true) == "")?"style='display:none'":""?> src="<?=get_post_meta($post_id,$variable["name"], true)?>"/>
        </div>
    <div class="clearfix"></div>
</div>
