<?php /* $tax_slug, $tax_name, $terms, $selected */ ?>
<select name='<?php echo $tax_slug; ?>' id='<?php echo $tax_slug; ?>' class='postform'>
	<option value=''>Show All <?php echo $tax_name; ?></option>
	<?php foreach ( $terms as $term ) : ?>
		<option value='<?php echo $term->slug; ?>' <?php selected( $selected, $term->slug ); ?>><?php echo $term->name; ?> (<?php echo $term->count; ?>)</option>
	<?php endforeach; ?>
</select>
