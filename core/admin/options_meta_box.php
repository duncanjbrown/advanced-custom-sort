<?php

global $post;

$options = (object) array(
    'post_types' => unserialize(get_post_meta($post->ID, 'post_types', true)),
    'max_posts' => get_post_meta($post->ID, 'max_posts', true)
);
?>

<input type="hidden" name="acs_save_options" value="true" />
<input type="hidden" name="ei_noncename" id="ei_noncename" value="<?php echo wp_create_nonce('ei-n'); ?>" />

<table class="acs_input widefat">
    <tbody>
        <tr>
            <td class="label">
                <label>Allowed Post Types</label>
                <p class="description">
                    Leave blank to show all (public) post types in the dropdown box.
                </p>
            </td>
            <td>
                <select name="acs[options][post_types][]" multiple="multiple">
<?php
$post_types = get_post_types(array('exclude_from_search' => false));
foreach ($post_types as $post_type) {
    $selected = (in_array($post_type, (array) $options->post_types)) ? ' selected="selected"' : '';
?>
                    <option value="<?php echo $post_type; ?>"<?php echo $selected; ?>><?php echo $post_type; ?></option>
<?php
}
?>
                </select>
            </td>
        </tr>
        <!--
        <tr>
            <td class="label">
                <label>Maximum Posts</label>
                <p class="description">
                    Leave blank for unlimited.
                </p>
            </td>
            <td>
                <input type="text" name="acs[options][max_posts]" value="<?php echo $options->max_posts; ?>" />
            </td>
        </tr>
        -->
    </tbody>
</table>
