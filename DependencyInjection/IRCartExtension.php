<?php

/*
 * This file is part of the IRCustomerBundle package.
 *
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;   
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Cart Extension.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class IRCartExtension extends Extension
{    
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config')); 

        foreach (array('cart', 'cart_item') as $basename) {
            $loader->load(sprintf('driver/%s/%s.xml', $config['db_driver'], $basename));
        }           
        
        foreach (array('listeners', 'provider', 'storage') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }        
        
        $container->setParameter('ir_cart.model.cart.class', $config['cart_class']);
        $container->setParameter('ir_cart.model.cart_item.class', $config['cart_item_class']);
        $container->setParameter('ir_cart.template.engine', $config['template']['engine']);
        $container->setParameter('ir_cart.backend_type_' . $config['db_driver'], true);
        
        $container->setAlias('ir_cart.manager.cart', $config['cart_manager']);
        $container->setAlias('ir_cart.manager.cart_item', $config['cart_item_manager']);
        $container->setAlias('ir_cart.storage.cart', $config['service']['cart_storage']);
        $container->setAlias('ir_cart.provider.cart', $config['service']['cart_provider']);
        
        if (!empty($config['cart'])) {
            $this->loadCart($config['cart'], $container, $loader);
        }  
        
        if (!empty($config['cart_item'])) {
            $this->loadCartItem($config['cart_item'], $container, $loader);
        }          
    }  
    
    private function loadCart(array $config, ContainerBuilder $container, XmlFileLoader $loader)
    {        
        $loader->load('cart.xml');
        
        $container->setParameter('ir_cart.form.name.cart', $config['form']['name']);
        $container->setParameter('ir_cart.form.type.cart', $config['form']['type']);   
        $container->setParameter('ir_cart.form.validation_groups.cart', $config['form']['validation_groups']);
    } 
    
    private function loadCartItem(array $config, ContainerBuilder $container, XmlFileLoader $loader)
    {        
        $loader->load('cart_item.xml');
        
        $container->setParameter('ir_cart.form.name.cart_item', $config['form']['name']);
        $container->setParameter('ir_cart.form.type.cart_item', $config['form']['type']);   
        $container->setParameter('ir_cart.form.validation_groups.cart_item', $config['form']['validation_groups']);
    }     
}
