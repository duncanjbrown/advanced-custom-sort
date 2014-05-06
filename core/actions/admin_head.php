<?php

/*--------------------------------------------------------------------------------------
*
*	Add post boxes
*
*	@author Matt Gibbs
*	@since 1.0.0
* 
*-------------------------------------------------------------------------------------*/

if (in_array($GLOBALS['pagenow'], array('post.php', 'post-new.php')))
{
    if ('acs' == $GLOBALS['post_type'])
    {
        echo '<script type="text/javascript" src="' . $this->dir . '/js/tipTip/jquery.tipTip.js" ></script>';
        echo '<script type="text/javascript" src="' . $this->dir . '/js/functions.input.js" ></script>';
        echo '<link rel="stylesheet" type="text/css" href="' . $this->dir . '/css/style.input.css" />';
        echo '<link rel="stylesheet" type="text/css" href="' . $this->dir . '/js/tipTip/tipTip.css" />';

        add_meta_box('acs_input', 'Group Posts', array($this, '_input_meta_box'), 'acs', 'normal', 'high');
        add_meta_box('acs_options', 'Advanced Options', array($this, '_options_meta_box'), 'acs', 'normal', 'high');
    }
}
