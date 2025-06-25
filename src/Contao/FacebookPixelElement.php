<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\Contao;

use Contao\ContentElement;
use Contao\FrontendTemplate;

/**
 * @property string           $fb_pixel_opt_out_active_text
 * @property string           $fb_pixel_opt_out_inactive_text
 * @property FrontendTemplate $Template
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress ClassMustBeFinal
 */
class FacebookPixelElement extends ContentElement
{
    use FacebookPixelTrait;

    /**
     * Template
     *
     * @var string
     */
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
    protected $strTemplate = 'ce_hofff_facebook_pixel_optout';
}
