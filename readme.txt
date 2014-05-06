=== Advanced Custom Sort ===
Contributors: logikal16
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=E75CAQ74KG3ZU
Tags: sort, sortable, queue, nodequeue, order, orderby, post order
Requires at least: 3.2
Tested up to: 3.4.2
Stable tag: trunk

Advanced Custom Sort (ACS) is like Nodequeue for WordPress. It allows you to create custom-ordered post lists.

== Description ==

= Use Cases =
* Custom slideshow: allow clients to select which slides to display, and in which order
* Teasers: showcase some hand-picked posts/pages/etc
* Menus: create visually appealing menus and landing pages (using post custom fields)

= Features =
* Intuitive, drag-n-drop interface
* Built-in smart search within the edit screen
* No additional DB tables created
* Create unlimited groups

= Screencast =
http://screencast.com/t/hu96vXh0pk

= Usage =
* Click on Settings > Adv Custom Sort
* Click "Add New", and name it (e.g. "My Group")
* Select posts from the dropdown box, then click "Add Selected Posts"
* The chosen posts will appear below. Sort them if needed, then save the post
* Within your template, above the loop, add $acs->query_posts (see the Screenshots tab)

= Website =
http://uproot.us/advanced-custom-sort/


== Installation ==

1. Upload 'advanced-custom-sort' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on Settings -> Adv Custom Sort


== Screenshots ==
1. The post selector, with built-in smart search

2. Add `$acs->query_posts()` to your template to enable the custom sort


== Changelog ==

= 1.2.2 =
* Ignore sticky posts by default (props @sc0ttkclark)

= 1.2.1 =
* CSS updates ahead of WP 3.4
* More minor cleanup

= 1.2.0 =
* Minor cleanup
