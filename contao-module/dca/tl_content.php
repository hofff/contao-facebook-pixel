<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['hofff_facebook-pixel-optout']
	= '{type_legend},type'
    . ';{facebook_pixel_legend},fb_pixel_set_opt_out_cookie_text,fb_pixel_opt_delete_out_cookie_text,fb_pixel_no_cookie_text'
	. ';{expert_legend:hide},guests,cssID,space'
	. ';{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_active_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_active_text'],
    'inputType' => 'text',
    'eval'      => array('size' => 20, 'tl_class' => 'w50'),
    'sql'       => "varchar(255) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_inactive_text'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_inactive_text'],
    'inputType' => 'text',
    'eval'      => array('size' => 20, 'tl_class' => 'w50'),
    'sql'       => "varchar(255) NOT NULL default ''",
);