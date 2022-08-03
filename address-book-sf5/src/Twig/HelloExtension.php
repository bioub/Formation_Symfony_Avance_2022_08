<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class HelloExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('limit', [$this, 'limitFilter']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hello', [$this, 'hello']),
            new TwigFunction('helloHtml', [$this, 'helloHtml'], ['is_safe' => ['html']]),
        ];
    }

    public function hello($value = '')
    {
        return 'Hello ' . $value;
    }

    public function helloHtml($value = '')
    {
        return 'Hello <b>' . $value . '</b>';
    }

    public function limitFilter(string $value, int $length = 5)
    {
        return substr($value, 0, $length);
    }
}
