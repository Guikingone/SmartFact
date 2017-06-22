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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('smart_fact_user');

        $rootNode
            ->children()
                ->arrayNode('entity_relation')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('entity')
                                ->info('The name of your entity (ex: Article::class) ')
                                ->defaultNull()
                            ->end()
                            ->scalarNode('has_interface')
                                ->info('If your entity implement an interface (ex: ArticleInterface::class).')
                                ->defaultValue('no')
                            ->end()
                            ->scalarNode('api')
                                ->info('if your entity is build for API (aka has Groups annotations).')
                                ->defaultValue('no')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
