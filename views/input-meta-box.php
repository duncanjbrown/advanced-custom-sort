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
			<?php foreach( $candidates as $candidate ) : ?>
            <div class="acs_option<?php echo $selected && in_array( $candidate->ID, $selected ) ? 'used' : null ?>" type="<?php echo $candidate->post_type; ?>" rel="<?php echo $candidate->ID; ?>">
                <span class="cb"></span>
                <span class="acs_title"><?php echo $candidate->post_title; ?></span>
            </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>

<ul id="acs_sortable">
	<?php if( $selected ) : 
	    foreach ($selected as $s ) : ?>
		    <li><span class="acs_remove"></span><input type="hidden" name="acs[<?php echo ACS_POST_META; ?>][]" value="<?php echo $s; ?>" /><?php echo get_the_title( $s ); ?></li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
