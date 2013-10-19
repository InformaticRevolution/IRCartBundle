<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;

use IR\Bundle\CartBundle\IRCartEvents;
use IR\Bundle\CartBundle\Event\CartItemEvent;

/**
 * Controller managing the cart items.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemController extends ContainerAware
{
    /**
     * Add an item to the current cart.
     */
    public function addAction()
    {
        /* @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');  
        
        $item = $this->container->get('ir_cart.manager.cart_item')->createCartItem();
        
        $dispatcher->dispatch(IRCartEvents::CART_ITEM_ADD_INITIALIZE, new CartItemEvent($item));
        
        $cart = $this->container->get('ir_cart.provider.cart')->getCart(); 
        
        $cart->addItem($item);
        $this->container->get('ir_cart.manager.cart')->updateCart($cart);
        $this->cartProvider->setCart($cart);
        
        $dispatcher->dispatch(IRCartEvents::CART_ITEM_ADD_COMPLETED, new CartItemEvent($item));           
        
        return new RedirectResponse($this->container->get('router')->generate('ir_cart_checkout'));
    }  
    
    /**
     * Remove an item from the current cart.
     */
    public function removeAction($id)
    {
        $item = $this->container->get('ir_cart.manager.cart_item')->findCartItemBy(array('id' => $id));
        $cart = $this->container->get('ir_cart.provider.cart')->getCart(); 
        
        if (null === $item || !$cart->hasItem($item)) {
            return new RedirectResponse($this->container->get('router')->generate('ir_cart_checkout'));
        }
        
        $cart->removeItem($item);
        $this->container->get('ir_cart.manager.cart')->updateCart($cart);
        
        /* @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');                      
        $dispatcher->dispatch(IRCartEvents::CART_ITEM_REMOVE_COMPLETED, new CartItemEvent($item));        
        
        return new RedirectResponse($this->container->get('router')->generate('ir_cart_checkout'));
    }  
}
