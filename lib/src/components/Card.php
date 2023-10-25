<?php

declare(strict_types=1);

namespace PureX\Components;

use Closure;
use Pure\Component;
use Pure\Pure;
use Stringable;

defined('ABSPATH') || exit;

class Card extends Component
{
    private Component $content;
    public function __construct(string $title, array $image, array $action)
    {
        parent::__construct('div');
        $this->content = Pure::p()->class('text-gray-700 text-base');
        $this->class('w-auto rounded overflow-hidden shadow-lg hover:scale-105 transition-transform duration-200 bg-white');
        parent::___(
            Pure::img()->class('w-full h-40 object-cover')->src($image['url'])->alt($image['alt']),
            Pure::div()->class('px-6 py-4')(
                Pure::div()->class('font-bold text-xl mb-2')($title),
                $this->content
            ),
            Pure::div()->class('px-6 pt-4 pb-2 text-center')(
                Pure::a()->href($action['url'])(
                    Pure::button()
                        ->type('button')
                        ->class("bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition-colors")(
                        $action['label']
                    )
                )
            )
        );
    }

    public function __invoke(Stringable|Closure|array|string|null ...$children): static
    {
        $this->content->___(...$children);
        return $this;
    }
}
