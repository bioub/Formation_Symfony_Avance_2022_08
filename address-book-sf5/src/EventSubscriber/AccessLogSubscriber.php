<?php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AccessLogSubscriber implements EventSubscriberInterface
{
    /** @var LoggerInterface */
    protected $requestLogger;

    /**
     * @param LoggerInterface $requestLogger
     */
    public function __construct(LoggerInterface $requestLogger)
    {
        $this->requestLogger = $requestLogger;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $this->requestLogger->info('FROM AccessLogSubscriber ' . $request->getMethod() . ' - ' . $request->getRequestUri());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
