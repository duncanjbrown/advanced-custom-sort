<input type="hidden" name="acs_save_posts" value="true" />
<input type="hidden" name="ei_noncename" id="ei_noncename" value="<?php echo wp_create_nonce('ei-n'); ?>" />

<div id="acs_select">
    <div id="acs_select_box">
        <div id="acs_select_value"><?php _e('Click to Select Posts'); ?></div>
    </div>
    <div id="acs_select_popup">
        <div id="acs_filter">
            <label class="acs_ghost_text" for="acs_filter_input">Start typing to search...</label>
            <input type="text" id="acs_filter_input" value="" autocomplete="off" />
            <a id="add-selected-posts" class="button-primary" href="#"><?php _e('Add Selected Posts'); ?></a>
        </div>
        <div id="acs_select_options">
        </div>
    </div>
</div>

<ul id="acs_sortable">
	<?php if( $selected ) :
	    foreach ($selected as $s ) : ?>
		    <li><span class="acs_remove"></span><input type="hidden" name="<?php echo ACS_POST_META; ?>[]" value="<?php echo $s; ?>" /><?php echo get_the_title( $s ); ?></li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
