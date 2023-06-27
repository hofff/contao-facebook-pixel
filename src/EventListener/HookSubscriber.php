<?php

declare(strict_types=1);

namespace Hofff\Contao\FacebookPixel\EventListener;

use Contao\FrontendTemplate;
use Contao\Input;
use Doctrine\DBAL\Connection;
use Hofff\Contao\Consent\Bridge\ConsentId\ConsentIdParser;
use Hofff\Contao\Consent\Bridge\ConsentToolManager;
use Hofff\Contao\Consent\Bridge\Exception\InvalidArgumentException as InvalidConsentIdException;

use function explode;

final class HookSubscriber
{
    public function __construct(
        private readonly Connection $connection,
        private readonly ConsentToolManager $consentToolManager,
        private readonly ConsentIdParser $consentIdParser,
    ) {
    }

    /**
     * Add the facebook pixel when parsing a frontend template.
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function onParseFrontendTemplate(string $content): string
    {
        static $processed = false;

        if ($processed || ! isset ($GLOBALS['objPage'])) {
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
            $objTemplate = new FrontendTemplate('hofff_facebook_pixel');
            /** @psalm-suppress InvalidPropertyAssignmentValue */
            $objTemplate->id = $pixelConfig['fb_pixel_id'];

            $parsed = $objTemplate->parse();
            $parsed = $this->applyConsentTool($parsed, $pixelConfig['fb_pixel_consentId']);

            /** @psalm-suppress MixedArrayAssignment */
            $GLOBALS['TL_HEAD'][] = $parsed;
        }

        return $content;
    }

    /**
     * function to add facebook pixel privacy link with an insert tag using switch to add other functions later.
     *
     * @psalm-suppress MixedArrayAccess
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function onReplaceInsertTag(string $tag): string|false
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
                'optOutStatus'       => (bool) Input::cookie('FB_PIXEL_OPTOUT'),
            ],
        );

        return $template->parse();
    }

    /**
     * Get the pixel config from the root page.
     *
     * @return array<string,string|null>
     *
     * @psalm-suppress MixedReturnTypeCoercion
     * @psalm-suppress InvalidFalsableReturnType
     * @psalm-suppress FalsableReturnStatement
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    private function getPixelConfig(): array
    {
        $query     = 'SELECT fb_pixel_id, fb_pixel_status, fb_pixel_consentId FROM tl_page WHERE id=:pageId';
        $statement = $this->connection->prepare($query);

        /** @psalm-suppress MixedPropertyFetch */
        $result = $statement->executeQuery(['pageId' => $GLOBALS['objPage']->rootId]);
        if ($result->rowCount() === 0) {
            return [
                'fb_pixel_id'        => null,
                'fb_pixel_status'    => null,
                'fb_pixel_consentId' => null,
            ];
        }

        return $result->fetchAssociative();
    }

    private function applyConsentTool(string $buffer, string|null $rawConsentId): string
    {
        if ($rawConsentId === null) {
            return $buffer;
        }

        $consentTool = $this->consentToolManager->activeConsentTool();
        if ($consentTool === null) {
            return $buffer;
        }

        try {
            $consentId = $this->consentIdParser->parse($rawConsentId);
            $buffer    = $consentTool->renderRaw($buffer, $consentId);
        } catch (InvalidConsentIdException) {
            // Invalid consent id given, ignore it
        }

        return $buffer;
    }
}
