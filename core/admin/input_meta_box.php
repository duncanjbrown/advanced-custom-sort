<?php

global $post, $wpdb;

$options = (object) array(
    'post_types' => unserialize(get_post_meta($post->ID, 'post_types', true)),
    'max_posts' => get_post_meta($post->ID, 'max_posts', true)
);

if (!empty($options->post_types))
{
    $post_types = $options->post_types;
}
else
{
    $post_types = get_post_types(array('exclude_from_search' => false));
}

$current_posts = get_post_meta($post->ID, 'post_order', true);
$current_posts = (array) unserialize($current_posts);
$posts_formatted = array();

$posts = $wpdb->get_results("SELECT ID, post_title, post_type FROM $wpdb->posts WHERE post_status = 'publish' AND post_type IN ('" . implode("','", $post_types) . "') ORDER BY post_title");
?>

<input type="hidden" name="acs_save_posts" value="true" />
<input type="hidden" name="ei_noncename" id="ei_noncename" value="<?php echo wp_create_nonce('ei-n'); ?>" />

<div id="acs_select">
    <div id="acs_select_box">
        <div id="acs_select_value"><?php _e('Click to Select Posts'); ?></div>
    </div>
    <div id="acs_select_popup">
        <div id="acs_filter">
            <label class="acs_ghost_text" for="acs_filter_input">Start typing to filter...</label>
            <input type="text" id="acs_filter_input" value="" autocomplete="off" />
            <div class="acs_filter_help">
                <div class="acs_help_text hidden">
                    <ul>
                        <li style="font-size:15px; font-weight:bold">Sample queries</li>
                        <li>"foobar" (find posts containing "foobar")</li>
                        <li>"type:page" (find pages)</li>
                        <li>"type:page foobar" (find pages containing "foobar")</li>
                        <li>"type:page,post foobar" (find posts or pages with "foobar")</li>
                        <li></li>
                    </ul>
                </div>
            </div>
            <a id="add-selected-posts" class="button-primary" href="javascript:;"><?php _e('Add Selected Posts'); ?></a>
        </div>
        <div id="acs_select_options">
<?php
foreach ($posts as $the_post) {

    // Add class to pre-selected posts
    $extra_css = '';
    if (false !== ($key = array_search($the_post->ID, $current_posts))) {
        $posts_formatted[$key] = array('ID' => $the_post->ID, 'title' => $the_post->post_title);
        $extra_css = ' used';
    }
?>
            <div class="acs_option<?php echo $extra_css; ?>" type="<?php echo $the_post->post_type; ?>" rel="<?php echo $the_post->ID; ?>">
                <span class="cb"></span>
                <span class="acs_title"><?php echo $the_post->post_title; ?></span>
            </div>
<?php
}
?>
        </div>
    </div>
</div>

<ul id="acs_sortable">
<?php
ksort($posts_formatted);
if (0 < count($posts_formatted)) {
    foreach ($posts_formatted as $the_post) {
?>
    <li><span class="acs_remove"></span><input type="hidden" name="acs[post_order][]" value="<?php echo $the_post['ID']; ?>" /><?php echo $the_post['title']; ?></li>
<?php
    }
}
?>
</ul>
