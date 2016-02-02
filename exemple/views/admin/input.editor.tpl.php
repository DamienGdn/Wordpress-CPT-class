<?php
global $variable;
global $post_id;
?>
<div class="input-admin">
    <div class="col-sm-2">
        <b><?=$variable["label"]?></b>    
    </div>
    <div class="col-sm-8">
        <?php
            wp_editor(htmlspecialchars(get_post_meta($post_id,$variable["name"],true)), $variable["name"]);
        ?>
    </div>
    <div class="clearfix"></div>
</div>

