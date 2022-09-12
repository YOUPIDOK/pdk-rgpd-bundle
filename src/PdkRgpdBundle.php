<?php

namespace Pdk\RgpdBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class PdkRgpdBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');

        $defaultConfig = [
            'gcu' => [
                'activate' => false,
                'template' => '@PdkRgpd/pages/gcu.html.twig'
            ],
            'gcs' => [
                'activate' => false,
                'template' => '@PdkRgpd/pages/gcs.html.twig'
            ],
            'privacy_policy' => [
                'activate' => false,
                'template' => '@PdkRgpd/pages/privacy_policy.html.twig'
            ],
            'base_template' => 'base.html.twig'
        ];

        $config = array_merge($defaultConfig, $config);

        $container->parameters()->set('pdk_rgpd.gcu.activate', $config['gcu']['activate']);
        $container->parameters()->set('pdk_rgpd.gcu.template', $config['gcu']['template']);

        $container->parameters()->set('pdk_rgpd.gcs.activate', $config['gcs']['activate']);
        $container->parameters()->set('pdk_rgpd.gcs.template', $config['gcs']['template']);

        $container->parameters()->set('pdk_rgpd.privacy_policy.activate', $config['privacy_policy']['activate']);
        $container->parameters()->set('pdk_rgpd.privacy_policy.template', $config['privacy_policy']['template']);

        $container->parameters()->set('pdk_rgpd.base_template', $config['base_template']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('gcu')
                    ->children()
                        ->booleanNode('activate')->defaultFalse()->end()
                        ->scalarNode('template')->defaultValue('@PdkRgpd/pages/gcu.html.twig')->end()
                    ->end()
                ->end()
            ->end()
            ->children()
                ->arrayNode('gcs')
                    ->children()
                        ->booleanNode('activate')->defaultFalse()->end()
                        ->scalarNode('template')->defaultValue('@PdkRgpd/pages/gcs.html.twig')->end()
                    ->end()
                ->end()
            ->end()
            ->children()
                ->arrayNode('privacy_policy')
                    ->children()
                        ->booleanNode('activate')->defaultFalse()->end()
                        ->scalarNode('template')->defaultValue('@PdkRgpd/pages/privacy_policy.html.twig')->end()
                    ->end()
                ->end()
            ->end()
            ->children()
                ->scalarNode('base_template')->defaultValue('base.html.twig')->end()
            ->end()
        ;
    }
}