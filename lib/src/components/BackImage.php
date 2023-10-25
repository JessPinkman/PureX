<?php

declare(strict_types=1);

namespace PureX\Components;

use Closure;
use Pure\Component;
use Pure\Pure;
use Stringable;

defined('ABSPATH') || exit;

class BackImage extends Component
{
    public Component $overlay;

    public function __construct(string $url, ?string $overlay_class = null)
    {
        parent::__construct('div');
        $this
            ->class('h-full w-full bg-cover bg-fixed bg-no-repeat bg-center relative')
            ->style("background-image: url($url)");

        $this->overlay = Pure::div()
            ->class('w-full h-full flex justify-center items-center')
            ->class($overlay_class);

        parent::___($this->overlay);
    }

    function __invoke(Stringable|string|array|Closure|null ...$children): static
    {
        $this->overlay->___(...$children);
        return $this;
    }
}
