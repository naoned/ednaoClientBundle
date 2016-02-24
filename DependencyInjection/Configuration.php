<?php

namespace Naoned\EdnaoClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('naoned_ednao_client');
        $rootNode->children()->scalarNode('url')->end();
        $rootNode->children()->scalarNode('url_fallback')->end();
        $rootNode->children()->scalarNode('product')->end();
        $rootNode->children()->scalarNode('socle')->end();

        return $treeBuilder;
    }
}
