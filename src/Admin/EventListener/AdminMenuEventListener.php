<?php

declare(strict_types=1);

namespace Subitolabs\SyliusCountdownPlugin\Admin\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'sylius.menu.admin.main')]
class AdminMenuEventListener
{
    public function __invoke(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        if (null !== $content = $menu->getChild('configuration')) {
            $content->addChild('app-menu', ['route' => 'subitolabs_countdown_plugin_admin_schedule_index'])
                ->setLabel('Countdown')
                ->setLabelAttribute('icon', 'sitemap')
            ;
        }
    }
}
