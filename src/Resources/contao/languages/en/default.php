<?php

// label for extenion list in settings and modules
$GLOBALS['TL_LANG']['FMD']['hofff_facebook_pixel_optout'] = array('Facebook Pixel Integration');
$GLOBALS['TL_LANG']['CTE']['hofff_facebook_pixel_optout'] = array('Facebook Pixel OptOut', 'Facebook Pixel OptOut');

$GLOBALS['TL_LANG']['tl_page']['facebook_pixel_legend'] = $GLOBALS['TL_LANG']['tl_content']['facebook_pixel_legend'] =
    $GLOBALS['TL_LANG']['tl_module']['facebook_pixel_legend'] = 'Facebook Pixel - Settings';

$GLOBALS['TL_LANG']['tl_page']['fb_pixel_id'] = array('Facebook Pixel ID', 'Please add Facebook Pixel ID here.');
$GLOBALS['TL_LANG']['tl_page']['fb_pixel_status'] = array('Active?', 'If active, Facebook Pixel will be loaded on all subpages.');

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_active_text'] = $GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_active_text'] =
    array('Text für OptOut Cookie setzen', 'Text für OptOut Cookie setzen');

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_inactive_text'] = $GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_inactive_text'] =
    array('Text für OptOut Cookie löschen', 'Text für OptOut Cookie löschen');

// error messages
$GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'] = 'Facebook Pixel - Please set link text in insert tag, for example see readme file.';
$GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'] = 'Facebook Pixel - Please set link text in insert tag, for example see readme file.';
$GLOBALS['TL_LANG']['MSC']['fbPixelNoIdIsSet'] = 'Facebook Pixel - No ID is set in website root!';
