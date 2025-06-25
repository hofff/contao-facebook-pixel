<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\Contao;

use Contao\BackendTemplate;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\Database;
use Contao\Input;
use Symfony\Component\HttpFoundation\RequestStack;

use function assert;

trait FacebookPixelTrait
{
    protected string $fb_pixel_id = '';

    /**
     * @psalm-suppress MixedPropertyFetch
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generate(): string
    {
        $requestStack = self::getContainer()->get('request_stack');
        assert($requestStack instanceof RequestStack);
        $request      = $requestStack->getCurrentRequest();
        $scopeMatcher = self::getContainer()->get('contao.routing.scope_matcher');
        assert($scopeMatcher instanceof ScopeMatcher);

        if ($request && $scopeMatcher->isBackendRequest($request)) {
            $objTemplate           = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Facebook Pixel OptOut ###';
            $objTemplate->title    = $this->headline;
            $objTemplate->id       = $this->id;

            /**
             * @psalm-suppress UndefinedThisPropertyFetch
             * @psalm-suppress RedundantConditionGivenDocblockType
             * @psalm-suppress DocblockTypeContradiction
             */
            $objTemplate->link = $this->name ?? null;

            return $objTemplate->parse();
        }

        /** @psalm-suppress TooManyArguments */
        $this->fb_pixel_id = (string) Database::getInstance()
            ->prepare('SELECT fb_pixel_id FROM tl_page WHERE id=?')
            ->limit(1)
            ->execute($GLOBALS['objPage']->rootId)
            ->fb_pixel_id;

        // Return if there is no page id
        if (! $this->fb_pixel_id) {
            /** @psalm-suppress MixedArrayAccess */
            return '<div>' . (string) $GLOBALS['TL_LANG']['MSC']['fbPixelNoIdIsSet'] . '</div>';
        }

        return parent::generate();
    }

    /**
     * @psalm-suppress MixedArrayAccess
     * @SuppressWarnings(PHPMD.Superglobals)
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
