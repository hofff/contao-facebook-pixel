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


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Hofff\Contao\Frontend;


/**
 * Class ContentRecursiveDownloadFolder
 *
 * Front end content element "hofff_facebook-pixel".
 * @copyright  Hofff.com 2017
 * @author     Mathias Arzberger <mathias@hofff.com>
 * @package    Hofff_facebook-pixel
 */
class FacebookPixelPlugin extends \Contao\ContentElement
{

	/**
	 * Files object
	 * @var \FilesModel
	 */
	protected $objFolder;

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_facebook_pixel_optout';


	/**
	 * Return if there are no files
	 * @return string
	 */
	public function generate()
	{

        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Facebook Pixel OptOut ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
            return $objTemplate->parse();
        }

        global $objPage;
        $this->fb_pixel_id = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->limit(1)->execute($objPage->rootId)->fb_pixel_id;

        // Return if there is no page id
        if (!$this->fb_pixel_id) {
            return '<div>' . $GLOBALS['TL_LANG']['MSC']['fbPixelNoIdIsSet'] . '</div>';
        }

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
        $this->Template->optOutActiveText = $this->fb_pixel_opt_out_active_text ? $this->fb_pixel_opt_out_active_text : $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutActiveText'];;
        $this->Template->optOutInActiveText = $this->fb_pixel_opt_out_inactive_text ? $this->fb_pixel_opt_out_inactive_text : $GLOBALS['TL_LANG']['MSC']['fbPixelOptOutInActiveText'];;;

        if ($this->Input->Cookie('FB_PIXEL_OPTOUT'))
        {
            $this->Template->optOutStatus = true;
        }
	}
}