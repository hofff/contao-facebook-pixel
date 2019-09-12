<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\Contao;

use Contao\BackendTemplate;
use Contao\Database;
use Contao\Input;

trait FacebookPixelTrait
{
    /**
     * Return if there are no files
     *
     * @return string
     */
    public function generate(): string
    {
        if (TL_MODE === 'BE') {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Facebook Pixel OptOut ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;
            $objTemplate->link     = $this->name;
            $objTemplate->href     = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $this->fb_pixel_id = Database::getInstance()
            ->prepare("SELECT * FROM tl_page WHERE id=?")
            ->limit(1)
            ->execute($GLOBALS['objPage']->rootId)
            ->fb_pixel_id;

        // Return if there is no page id
        if (!$this->fb_pixel_id) {
            return '<div>' . $GLOBALS['TL_LANG']['MSC']['fbPixelNoIdIsSet'] . '</div>';
        }

        return parent::generate();
    }

    /**
     * Compile the content element
     */
    protected function compile(): void
    {
        $this->Template->optOutActiveText = $this->fb_pixel_opt_out_active_text
            ?: $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'];

        $this->Template->optOutInActiveText = $this->fb_pixel_opt_out_inactive_text
            ?: $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'];

        $this->Template->optOutStatus = (bool) Input::cookie('FB_PIXEL_OPTOUT');
    }
}
