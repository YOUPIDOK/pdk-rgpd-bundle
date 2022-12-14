<?php

namespace Pdk\RgpdBundle\Subscriber\Sitemap;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\GoogleMultilangUrlDecorator;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class SitemapSubscriber implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;
    private ParameterBagInterface $parameterBag;
    private RouterInterface $router;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ParameterBagInterface $parameterBag
     * @param RouterInterface $router
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        ParameterBagInterface $parameterBag,
        RouterInterface $router,
    ) {
        $this->urlGenerator      = $urlGenerator;
        $this->parameterBag      = $parameterBag;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::class => 'populate',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populate(SitemapPopulateEvent $event): void
    {
        $urls = $event->getUrlContainer();

        $context = $this->router->getContext();
        $context->setScheme('https');

        $routes = ['gcu', 'gcs', 'privacy_policy'];

        foreach ($routes as $route) {
            if ($this->parameterBag->get('pdk_rgpd.' . $route . '.activate')) {
                $this->router->setContext($context);

                $uri = $this->router->generate('rgpd__' . $route, [], UrlGeneratorInterface::ABSOLUTE_URL);
                $url = new UrlConcrete($uri);

                $urls->addUrl($url, 'rgpd');
            }
        }
    }
}
