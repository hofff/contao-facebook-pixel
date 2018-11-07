<?php

// label for extenion list in settings and modules
$GLOBALS['TL_LANG']['FMD']['hofff_facebook-pixel-optout'] = array('Facebook Pixel OptOut', 'Facebook Pixel OptOut');
$GLOBALS['TL_LANG']['CTE']['hofff_facebook-pixel-optout'] = array('Facebook Pixel OptOut', 'Facebook Pixel OptOut');

$GLOBALS['TL_LANG']['tl_page']['facebook_pixel_legend'] = $GLOBALS['TL_LANG']['tl_content']['facebook_pixel_legend'] =
    $GLOBALS['TL_LANG']['tl_module']['facebook_pixel_legend'] = 'Facebook Pixel - Einstellungen';

$GLOBALS['TL_LANG']['tl_page']['fb_pixel_id'] = array('Facebook Pixel ID', 'Bitte hier die Facebook Pixel ID eingeben.');
$GLOBALS['TL_LANG']['tl_page']['fb_pixel_status'] = array('Aktiv?', 'Wenn aktiv, wird der Facebook Pixel auf allen Unterseiten eingebunden.');

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_active_text'] = $GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_active_text'] =
    array('Text für OptOut Cookie setzen', 'Text für OptOut Cookie setzen');

$GLOBALS['TL_DCA']['tl_content']['fields']['fb_pixel_opt_out_inactive_text'] = $GLOBALS['TL_LANG']['tl_page']['fb_pixel_opt_out_inactive_text'] =
    array('Text für OptOut Cookie löschen', 'Text für OptOut Cookie löschen');

// error messages
$GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'] = 'Facebook Pixel - Please set link text in insert tag, for example see readme file.';
$GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'] = 'Facebook Pixel - Please set link text in insert tag, for example see readme file.';
$GLOBALS['TL_LANG']['MSC']['fbPixelNoIdIsSet'] = 'Facebook Pixel - No ID is set in website root!';