#Advanced Custom Sort

This plugin (http://wordpress.org/plugins/advanced-custom-sort/) provides useful post-sorting and queuing functionality like Drupal's nodequeues.

It's no longer updated, though. So this fork exists to add new features such as

- Groupable lists, so you can categorise them
- A simpler API

and to clean up styling issues that arrived with WP 3.9.

If you want features, just open an issue.

#### Creating lists

The plugin will create a post type called 'acs', appearing under the 'Lists' menu in the Dashboard.

In there, create a list with 'New List'. Enter a title, then select posts using the search box below.

![Screenshot](/../screenshots/screenshots/Screen%20Shot%202015-05-12%20at%2010.55.50.png?raw=true)

#### Using lists

To get hold of a list, you need the title of the list.

    $list = acs_get_list( 'Top ten' );
    $query = $list->get_wp_query();

    while( $query->have_posts() ) : etc etc

If you prefer you can just get the IDs

	$list = acs_get_list( 'Top ten' );
	$post_ids = $list->get_posts();

	foreach( $post_ids as $id ) {
		echo get_post_meta( $id, 'price', true ); // for example
	}

#### REST API support

This plugin supports WP REST API v2. It will add an 'acs' endpoint and link to members
along the relation `http://acs.list/member`.

##### Notes

* This plugin doesn't respect or care about post types. You can have a list that mixes and matches whatever you want.
