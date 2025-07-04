<?php

declare(strict_types=1);

use Contao\ArrayUtil;
use Hofff\Contao\FacebookPixel\Contao\FacebookPixelElement;
use Hofff\Contao\FacebookPixel\EventListener\HookSubscriber;

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['hofff_facebook_pixel_optout'] = FacebookPixelElement::class;

/*
 * Front end modules
 */
ArrayUtil::arrayInsert(
    $GLOBALS['FE_MOD'],
    2,
    [
        'miscellaneous' => [
            'hofff_facebook_pixel_optout' => FacebookPixelElement::class,
        ],
    ],
);

/*
 * Hooks
 */
$GLOBALS['TL_HOOKS']['parseFrontendTemplate'][] = [HookSubscriber::class, 'onParseFrontendTemplate'];
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]     = [HookSubscriber::class, 'onReplaceInsertTag'];
