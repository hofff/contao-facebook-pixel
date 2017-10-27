<?php

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['hofff_facebook-pixel-optout'] = 'Hofff\\Contao\\Frontend\\FacebookPixelPlugin';

/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD'], 2, array
(
    'miscellaneous' => array
    (
        'hofff_facebook-pixel-optout'   => 'Hofff\\Contao\\Frontend\\FacebookPixelPlugin'
    )
));

/**
 * Hooks
 */
// register parse template hook
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = array('Hofff\\Contao\\Frontend\\FacebookPixel', 'addFacebookPixel');
// register custom inserttags
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('Hofff\\Contao\\Frontend\\FacebookPixel', 'fbPixelInsertTag');