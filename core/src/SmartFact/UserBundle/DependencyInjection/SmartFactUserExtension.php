<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SmartFact\UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class SmartFactUserExtension
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class SmartFactUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $classes = [];
        $interfaces = [];
        foreach ($config['entity_relation'] as $entity) {
            $name = $entity['entity'];
            $class = new \ReflectionClass($name);
            if ($entity['has_interface'] === 'yes') {
                $interface = $class->getInterfaces();
            }
            if ($entity['api'] === 'yes') {

            }

        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
