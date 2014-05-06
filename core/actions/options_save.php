<?php

if (isset($_POST['acs_save_options']) && $_POST['acs_save_options'] == 'true')
{
    $options = $_POST['acs']['options'];

    update_post_meta($post_id, 'post_types', serialize((array) $options['post_types']));
}
