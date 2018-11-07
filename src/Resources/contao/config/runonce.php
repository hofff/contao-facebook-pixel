<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\RunOnce;

use Contao\Database;

(function (Database $database) {
    $database->prepare('UPDATE tl_content %s WHERE type=?')
        ->set(['type' => 'hofff_facebook_pixel_optout'])
        ->execute('hofff_facebook-pixel-optout');

    $database->prepare('UPDATE tl_module %s WHERE type=?')
        ->set(['type' => 'hofff_facebook_pixel_optout'])
        ->execute('hofff_facebook-pixel-optout');
})(Database::getInstance());
