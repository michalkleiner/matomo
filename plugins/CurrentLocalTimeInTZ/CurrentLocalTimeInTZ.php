<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\CurrentLocalTimeInTZ;

class CurrentLocalTimeInTZ extends \Piwik\Plugin
{
    /**
     * @see \Piwik\Plugin::registerEvents
     */
    public function registerEvents()
    {
        return [
            'Translate.getClientSideTranslationKeys' => 'getClientSideTranslationKeys',
        ];
    }


    public function getClientSideTranslationKeys(&$translations)
    {
        $translations[] = 'CurrentLocalTimeInTZ_CurrentLocalTime';
        $translations[] = 'CurrentLocalTimeInTZ_CurrentLocalTimeInWebsiteTZ';
    }
}
