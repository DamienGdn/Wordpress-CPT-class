<?php
global $variable;
global $post_id;
?>
<div class="input-admin">
    <div class="col-sm-2">
        <b><?=$variable["label"]?></b>    
    </div>
    <div class="col-sm-8">
        <input 
            type="<?=$variable["type"]?>"
            name="<?=$variable["name"]?>"
            <?=(isset($variable["required"]))? 'required="required"': "" ?>
            value="<?=  get_post_meta($post_id,$variable["name"],true)?>"
            class="text-core"
        />
    </div>
    <div class="clearfix"></div>
</div>

