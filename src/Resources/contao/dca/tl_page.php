<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DataContainer\PaletteNotFoundException;
use Hofff\Contao\Consent\Bridge\EventListener\Dca\ConsentIdOptions;

(static function (): void {
    $manipulator = PaletteManipulator::create()
        ->addLegend('facebook_pixel_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField(
            ['fb_pixel_id', 'fb_pixel_status', 'fb_pixel_consentId'],
            'facebook_pixel_legend',
            PaletteManipulator::POSITION_APPEND,
        );

    foreach (['root', 'rootfallback'] as $palette) {
        try {
            $manipulator->applyToPalette($palette, 'tl_page');
        } catch (PaletteNotFoundException) {
        }
    }
})();

$GLOBALS['TL_DCA']['tl_page']['fields']['fb_pixel_id'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_id'],
    'inputType' => 'text',
    'eval'      => ['size' => 20, 'tl_class' => 'w50'],
    'sql'       => "varchar(20) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['fb_pixel_status'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_status'],
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 m12'],
    'sql'       => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['fb_pixel_consentId'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_page']['fb_pixel_consentId'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [ConsentIdOptions::class, '__invoke'],
    'eval'             => [
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
        'chosen'             => true,
        'multiple'           => false,
        'nullIfEmpty'        => true,
    ],
    'sql'              => ['type' => 'string', 'default' => null, 'notnull' => false],
];
