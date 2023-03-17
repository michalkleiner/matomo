<?php

namespace Piwik\Plugins\CurrentLocalTimeInTZ\Widgets;

use Piwik\Common;
use Piwik\Site;
use Piwik\Widget\Widget;
use Piwik\Widget\WidgetConfig;

class CurrentLocalTimeInTZ extends Widget
{
    public static function configure(WidgetConfig $config)
    {
        $config->setCategoryId('Info');
        $config->setName('CurrentLocalTimeInTZ_CurrentLocalTime');
    }


    /**
     * @throws \Piwik\Exception\UnexpectedWebsiteFoundException
     */
    public function render()
    {
        $idSite = Common::getRequestVar('idSite', '');

        if (intval($idSite) !== 0) {
            $site     = new Site($idSite);
            $timezone = $site->getTimezone();
        } else {
            $timezone = 'UTC';
        }

        return $this->renderTemplate('currentLocalTimeInTZ', [
            'timezone' => $timezone,
            'locale'   => 'en-NZ', // TODO: get dynamically
        ]);
    }
}
