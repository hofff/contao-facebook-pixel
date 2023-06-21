<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Hofff\Contao\FacebookPixel\HofffContaoFacebookPixelBundle;

final class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(HofffContaoFacebookPixelBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['hofff_facebook-pixel']),
        ];
    }
}
