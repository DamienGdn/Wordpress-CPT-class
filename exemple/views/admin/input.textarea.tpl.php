<?php
global $variable;
global $post_id;

?>
<div class="input-admin">
    <div class="col-sm-2">
        <b><?=$variable["label"]?></b>    
    </div>
    <div class="col-sm-8">
        <textarea
            name="<?=$variable["name"]?>"
            <?=(isset($variable["required"]))? 'required="required"': "" ?>
            <?php echo (isset($variable["parameter"]))? $variable["parameter"] : "" ?>
        ><?=  htmlspecialchars(get_post_meta($post_id,$variable["name"],true))?></textarea>
    </div>
    <div class="clearfix"></div>
</div>

