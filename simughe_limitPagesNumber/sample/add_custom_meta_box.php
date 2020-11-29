<?php
/******************************interface admin************************************/
add_action("add_meta_boxes",array($self, 'add_custom_meta_box'));
 function custom_meta_box_markup()
{
    
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Custom Meta Box", array($this, 'custom_meta_box_markup'), "post", "side", "high", null);
}
?>