<?php

if (isset($_POST['acs_save_posts']) && $_POST['acs_save_posts'] == 'true')
{
    $post_order = $_POST['acs']['post_order'];
    update_post_meta($post_id, 'post_order', serialize($post_order));
}
