<?php

$GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(
    '{publish_legend}',
    '{facebook_pixel_legend},fb_pixel_id,fb_pixel_status;{publish_legend}',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['root']
);

$GLOBALS['TL_DCA']['tl_page']['fields']['fb_pixel_id'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_id'],
    'inputType' => 'text',
    'eval'      => array('size' => 20, 'tl_class' => 'w50'),
    'sql'       => "varchar(20) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['fb_pixel_status'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_status'],
    'inputType' => 'checkbox',
    'eval'      => array('tl_class' => 'w50'),
    'sql'       => "char(1) NOT NULL default ''",
);