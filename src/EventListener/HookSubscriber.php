<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\EventListener;

use Contao\FrontendTemplate;
use Contao\Input;
use Doctrine\DBAL\Connection;

/**
 * Class FacebookPixel
 *
 * Front end content element "hofff_facebook-pixel".
 *
 * @copyright  Hofff.com 2017
 * @author     Mathias Arzberger <mathias@hofff.com>
 * @package    Hofff_facebook-pixel
 */
final class HookSubscriber
{
    /**
     * Database connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * HookSubscriber constructor.
     *
     * @param Connection $connection Datase connection.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Add the facebook pixel when parsing a frontend template.
     *
     * @param string $content
     *
     * @return string
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function onParseFrontendTemplate(string $content): string
    {
        static $processed = false;

        if ($processed) {
            return $content;
        }

        $processed   = true;
        $pixelConfig = $this->getPixelConfig();

        if ($pixelConfig['fb_pixel_id'] !== null && $pixelConfig['fb_pixel_status'] === '1') {
            // Ignore admins and/or members
            if (Input::cookie('FB_PIXEL_OPTOUT')) {
                return $content;
            }

            // parse template file
            $objTemplate     = new FrontendTemplate('hofff_facebook_pixel');
            $objTemplate->id = $pixelConfig['fb_pixel_id'];

            $GLOBALS['TL_HEAD'][] = $objTemplate->parse();
        }

        return $content;
    }

    /**
     * function to add facebook pixel privacy link with an insert tag using switch to add other functions later.
     *
     * @param string $tag
     *
     * @return bool|string
     */
    public function onReplaceInsertTag(string $tag)
    {
        $parts = explode('::', $tag);

        if ($parts[0] !== 'fbPixel' || $parts[1] !== 'privacyLink') {
            return false;
        }

        $template = new FrontendTemplate('ce_hofff_facebook_pixel_optout');
        $template->setData(
            [
                'optOutActiveText'   => $parts[2] ?: $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'],
                'optOutInActiveText' => $parts[3] ?: $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'],
                'optOutStatus'       => (bool) Input::cookie('FB_PIXEL_OPTOUT')
            ]
        );

        return $template->parse();
    }

    /**
     * Get the pixel config from the root page.
     *
     * @return array
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    private function getPixelConfig(): array
    {
        $query     = 'SELECT fb_pixel_id, fb_pixel_status FROM tl_page WHERE id=:pageId';
        $statement = $this->connection->prepare($query);
        $statement->bindValue('pageId', $GLOBALS['objPage']->rootId);

        if (!$statement->execute() || $statement->rowCount() === 0) {
            return [
                'fb_pixel_id' => null,
                'fb_pixel_status' => null
            ];
        }

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
