<?php

/*
 * This file is part of the IRCartBundle package.
 *
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 * 
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ir_cart');

        $supportedDrivers = array('orm');
        
        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                    ->cannotBeOverwritten()
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('cart_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('cart_item_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('cart_manager')->defaultValue('ir_cart.manager.cart.default')->end()
                ->scalarNode('cart_item_manager')->defaultValue('ir_cart.manager.cart_item.default')->end()
            ->end()
        ;         

        $this->addCartSection($rootNode); 
        $this->addCartItemSection($rootNode); 
        $this->addServiceSection($rootNode);
        $this->addTemplateSection($rootNode);
        
        return $treeBuilder;
    }     
    
    private function addCartSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('cart')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('ir_cart')->end()
                                ->scalarNode('name')->defaultValue('ir_cart_form')->end()
                                ->arrayNode('validation_groups')
                                    ->prototype('scalar')->end()
                                    ->defaultValue(array('Cart', 'Default'))
                                ->end()                 
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    } 
    
    private function addCartItemSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('cart_item')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('type')->defaultValue('ir_cart_item')->end()
                                ->scalarNode('name')->defaultValue('ir_cart_item_form')->end()
                                ->arrayNode('validation_groups')
                                    ->prototype('scalar')->end()
                                    ->defaultValue(array('CartItem', 'Default'))
                                ->end()                 
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }     
    
    private function addServiceSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('cart_storage')->defaultValue('ir_cart.storage.cart.session')->end()
                            ->scalarNode('cart_provider')->defaultValue('ir_cart.provider.cart.default')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }    
    
    private function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }     
}
