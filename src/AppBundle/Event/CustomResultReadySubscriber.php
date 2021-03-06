<?php

namespace AppBundle\Event;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class CustomResultReadySubscriber extends ResultReadySubscriber
{
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(
        Router $router
    ) {
        $this->router = $router;
    }

    /**
     * @param ResultEvent $event
     */
    public function onResultReady(ResultEvent $event)
    {
        $result = $event->getResult();
        $url = $this->router->generate(
            $result->getSurvey()->getResultEvaluationRouteName(),
            ['result' => $result->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $event->setUrl($url);
    }
}
