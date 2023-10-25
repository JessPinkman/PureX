<?php

declare(strict_types=1);

namespace PureX\Components;

use Pure\Component;
use Pure\Pure;

defined('ABSPATH') || exit;

class NavBar extends Component
{
    public Component $menu;
    public Component $link_container;
    public array $links = [];

    public function __construct(string $brand, string $logo, bool $fixed)
    {
        parent::__construct('nav');
        $this->id('navbar');
        if ($fixed) {
            $this->class('navbar-fixed');
        }

        $this->link_container = Pure::li();

        $this->menu = Pure::div()
            ->id('navbar-menu')(
            Pure::ul()->class([
                "flex flex-col md:flex-row md:space-x-8",
                "mt-4 p-4 md:mt-0 md:p-0",
                "font-medium"
            ])(
                $this->link_container
            )
        );

        $this->___(
            Pure::div()
                ->class('max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4')(
                Pure::a()
                    ->href('/')
                    ->class('flex item-center')(
                    Pure::img()
                        ->src($logo)
                        ->class('h-auto w-8 mr-3')
                        ->alt('real smart'),
                    Pure::span()
                        ->class('self-center text-2xl font-semibold whitespace-nowrap')(
                        $brand
                    )
                ),
                $this->getHamburger(!$fixed),
                $this->menu
            )
        );
    }

    private function getMenuItem($url, $label): Component
    {
        return Pure::li()(
            Pure::a()
                ->href($url)
                ->class("block rounded p-2 hover:bg-green-500 transition-colors")
                ->aria_current('page')(
                $label
            )
        );
    }

    public function addLinks(array $links): self
    {
        $this->link_container->___(
            ...array_map(fn ($item) => $this->getMenuItem($item['url'], $item['label']), $links)
        );

        return $this;
    }

    public function getHamburger(bool $isTransparent): Component
    {
        $generic = 'h-1 w-6 my-1 rounded-full transition-transform ease transform duration-300 z-10';
        if ($isTransparent) {
            $generic .= ' bg-green-700';
        }

        return Pure::button()
            ->id('menu-button')
            ->type('button')
            ->class('flex-col h-auto w-auto justify-center items-center group inline-flex md:hidden')(
            Pure::div()->class($generic)->id('menu-button-top'),
            Pure::div()->class($generic)->id('menu-button-mid'),
            Pure::div()->class($generic)->id('menu-button-bottom'),
        );
    }
}
