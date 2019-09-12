<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\Contao;

use Contao\Module;

/**
 * Class ContentRecursiveDownloadFolder
 *
 * Front end content element "hofff_facebook-pixel".
 *
 * @copyright  Hofff.com 2017
 * @author     Mathias Arzberger <mathias@hofff.com>
 * @package    Hofff_facebook-pixel
 */
class FacebookPixelModule extends Module
{
    use FacebookPixelTrait;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'mod_hofff_facebook_pixel_optout';
}
