<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\RunOnce;

use Contao\Database;

(function (Database $database) {
    if ($database->fieldExists('type', 'tl_content')) {
        $database->prepare('UPDATE tl_content %s WHERE type=?')
            ->set(['type' => 'hofff_facebook_pixel_optout'])
            ->execute('hofff_facebook-pixel-optout');
    }

    if ($database->fieldExists('type', 'tl_module')) {
        $database->prepare('UPDATE tl_module %s WHERE type=?')
            ->set(['type' => 'hofff_facebook_pixel_optout'])
            ->execute('hofff_facebook-pixel-optout');
    }
})(Database::getInstance());
