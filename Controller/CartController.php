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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;

use IR\Bundle\CartBundle\IRCartEvents;
use IR\Bundle\CartBundle\Event\CartEvent;

/**
 * Controller managing the cart.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartController extends ContainerAware
{
    /**
     * Show the checkout page.
     */
    public function checkoutAction(Request $request)
    {
        $cart = $this->container->get('ir_cart.provider.cart')->getCart();
        
        $form = $this->container->get('ir_cart.form.cart');
        $form->setData($cart);
        $form->handleRequest($request); 
                
        if ($form->isValid()) {
            $this->container->get('ir_cart.manager.cart')->updateCart($cart);
            
            /* @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->container->get('event_dispatcher');                      
            $dispatcher->dispatch(IRCartEvents::CART_EDIT_COMPLETED, new CartEvent($cart));            
            
            return new RedirectResponse($this->container->get('router')->generate('ir_cart_checkout'));
        }
        
        return $this->container->get('templating')->renderResponse('IRCartBundle:Cart:checkout.html.'.$this->getEngine(), array(
            'cart' => $cart,
            'form' => $form->createView(),
        ));        
    }
    
    /**
     * Clear the current cart.
     */
    public function clearAction()
    {
        $cart = $this->container->get('ir_cart.provider.cart')->getCart();
        $cart->clearItems();
        
        $this->container->get('ir_cart.manager.cart')->updateCart($cart);
        
        /* @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');                      
        $dispatcher->dispatch(IRCartEvents::CART_CLEAR_COMPLETED, new CartEvent($cart));         
        
        return new RedirectResponse($this->container->get('router')->generate('ir_cart_checkout'));
    }
            
    /**
     * Returns the template engine.
     * 
     * @return string
     */    
    protected function getEngine()
    {
        return $this->container->getParameter('ir_cart.template.engine');
    }       
}
