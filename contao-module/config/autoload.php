<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Hofff',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'ce_facebook_pixel_optout' => 'system/modules/hofff_facebook-pixel/templates/elements',
    'mod_facebook_pixel' => 'system/modules/hofff_facebook-pixel/templates/modules',
));

/**
 * Register the classes
 * /
ClassLoader::addClasses(array
(
    // Classes
    'Hofff\Contao\Frontend\FacebookPixel'   => 'system/modules/hofff_facebook-pixel/FacebookPixel.php',
    'Hofff\Contao\Frontend\FacebookPixelPlugin'   => 'system/modules/hofff_facebook-pixel/FacebookPixelPlugin.php',
)); */