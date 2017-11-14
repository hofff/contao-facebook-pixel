<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Hofff_facebook-pixel
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Hofff\Contao\Frontend;

/**
 * Class FacebookPixel
 *
 * Front end content element "hofff_facebook-pixel".
 * @copyright  Hofff.com 2017
 * @author     Mathias Arzberger <mathias@hofff.com>
 * @package    Hofff_facebook-pixel
 */
class FacebookPixel extends \Frontend
{

    protected $strTemplate = 'mod_facebook_pixel';

    // hook for parseFrontendTemplate
    public function addFacebookPixel($strContent, $strTemplate)
    {
        // GA already included
        if ($GLOBALS['facebook_pixel_included']) {
            return $strContent;
        }

        $GLOBALS['facebook_pixel_included'] = 'true';
        global $objPage;
        $root_details =
            $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->limit(1)->execute($objPage->rootId);

        if ($root_details->numRows AND $root_details->fb_pixel_id != '' AND $root_details->fb_pixel_status == 1) {
            // Ignore admins and/or members
            if ($this->Input->Cookie('FB_PIXEL_OPTOUT'))
            {
                return $strContent;
            }

            // parse template file
            $objTemplate        = new \FrontendTemplate($this->strTemplate);
            $objTemplate->id    = $root_details->fb_pixel_id;

            $GLOBALS['TL_HEAD'][] = $objTemplate->parse();
        }

        return $strContent;
    }

    // function to add facebook pixel privacy link with an insert tag
    // using switch to add other functions later
    public function fbPixelInsertTag($strTag)
    {
        $arrTag = explode('::', $strTag);

        if (!$arrTag[0] == 'fbPixel') {
            return false;
        }

        switch ($arrTag[1]) {
            // Insert privacy optout link
            case 'privacyLink':
                // parse template file
                $objTemplate = new \FrontendTemplate('ce_facebook_pixel_optout');

                $objTemplate->optOutActiveText = $arrTag[2] ? $arrTag[2] : $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'];
                $objTemplate->optOutInActiveText = $arrTag[3] ? $arrTag[3] : $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'];

                if ($this->Input->Cookie('FB_PIXEL_OPTOUT'))
                {
                    $objTemplate->optOutStatus = true;
                }

                return $objTemplate->parse();
                break;
        }

        return false;
    }
}