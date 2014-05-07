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
                <select name="acs[options][<?php echo ACS_POST_TYPES_META; ?>][]" multiple="multiple">
				<?php foreach ( $candidate_post_types as $post_type) : ?>
	                <option value="<?php echo $post_type; ?>"<?php selected( in_array( $post_type, $allowed_post_types ) ); ?>><?php echo $post_type; ?></option>
				<?php endforeach; ?>
                </select>
            </td>
        </tr>
    </tbody>
</table>
