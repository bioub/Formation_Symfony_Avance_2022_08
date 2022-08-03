<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AlertExtension extends AbstractExtension
{
    /** @var RequestStack */
    protected $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    public function getFunctions(): array
    {
        return [
            new TwigFunction('alert', [$this, 'alert'], ['is_safe' => ['html']]),
            new TwigFunction('flashAlert', [$this, 'flashAlert'], ['is_safe' => ['html']]),
        ];
    }

    public function alert($msg, $type)
    {
        // Syntaxe Heredoc PHP (change le délimiteur " par celui de choix -> ici HTML)
        return <<<HTML
<div class="alert alert-$type alert-dismissible fade show">
    $msg
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
HTML;
    }

    public function flashAlert($type)
    {
        $session = $this->requestStack->getSession();

        /** @var FlashBagInterface $flashBag */
        $flashBag = $session->getBag('flashes');

        $messages = $flashBag->get($type);

        $html = '';

        foreach ($messages as $msg) {
            $html .= $this->alert($msg, $type);
        }

        return $html;

        // Avec array_map (programmation fonctionnelle)
        // $arrayHtml = array_map(function($msg) use ($type) { return $this->alert($msg, $type); }, $messages);
        // return join("", $arrayHtml);
    }
}
