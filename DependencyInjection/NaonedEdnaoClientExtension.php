<?php

namespace Naoned\EdnaoClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
// use Symfony\Bundle\MonologBundle\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NaonedEdnaoClientExtension extends Extension
{
    /**
     * Used in twig views
     * setted as a global var named 'bundle'
     * useful to include or extend other views
     *
     * @return string
     */
    private function getBundleName()
    {
        return 'NaonedEdnaoClientBundle';
    }

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (!$container->hasParameter('naoned_ednao_client.version'))  {
            throw new \Exception("Version is not defined with «naoned_ednao_client.version» parameter key.", 1);
        }

        $url = '';
        if ($container->hasParameter('naoned_ednao_client.url')) {
            $paramUrl = $container->hasParameter('naoned_ednao_client.url');
            if (!filter_var($paramUrl, FILTER_VALIDATE_URL) === false) {
                $url = $paramUrl;
            }
        }
        if (!$url) {
            $url = $config['url_fallback'];
        }
        $container->setParameter('naoned_ednao_client.url', $url);
        $container->setParameter('naoned_ednao_client.product', $config['product']);
        $container->setParameter('naoned_ednao_client.socle', $config['socle']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
