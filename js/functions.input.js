(function($) {
    'use strict'

    window.ACS = window.ACS || {};

    $(document).ready(function() {

        var renderList = function() {
            jQuery("#acs_sortable li").removeClass("even");
            jQuery("#acs_sortable li:even").addClass("even");
        }

        // sortable
        jQuery("#acs_sortable").sortable({
            axis: "y",
            create: renderList,
            stop: renderList
        });

        // load
        jQuery(".acs_option").click(function() {
            jQuery(this).find(".cb").toggleClass("on");
        });

        // ghost text
        jQuery("#acs_filter_input").keydown(function() {
            jQuery(".acs_ghost_text").html("");
        });

        // select box
        jQuery("#acs_select_box").click(function() {
            jQuery(this).toggleClass("active");
            jQuery("#acs_select_popup").toggle();
        });

        // add selected posts
        jQuery("#add-selected-posts").click(function() {
            jQuery(".acs_option span.cb.on").each(function() {
                var parent = jQuery(this).parent();
                var title = parent.find("span.acs_title").html();
                var post_id = parent.attr("rel");
                jQuery("#acs_sortable").append('<li><span class="acs_remove"></span><input type="hidden" name="'+ACS.fieldName+'[]" value="'+post_id+'" />'+title+'</li');
                jQuery(this).removeClass("on");
                parent.addClass("used");
                renderList();
            });
            jQuery("#acs_select_box").click();
        });

        // remove post
        jQuery(".acs_remove").live("click", function() {
            var parent = jQuery(this).parent();
            var post_id = parent.find("input").val();
            jQuery(".acs_option[rel="+post_id+"]").removeClass("used");
            parent.remove();
            renderList();
        });

        // filter select box options
        jQuery("#acs_filter_input").keyup(function() {
            var input = jQuery(this).val();

        });
    });



})(jQuery);

