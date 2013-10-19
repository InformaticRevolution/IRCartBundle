<?php

/*
 * This file is part of the IRCartBundle package.
 *
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use IR\Bundle\CartBundle\Model\CartItemInterface;

/**
 * Cart Item Event.
 * 
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemEvent extends Event
{    
    /**
     * @var CartItemInterface
     */              
    protected $item; 
    
    /**
     * @var Request
     */
    protected $request;


    /**
     * Constructor.
     * 
     * @param CartItemInterface $item
     */            
    public function __construct(CartItemInterface $item, Request $request)
    {
        $this->item = $item;
        $this->request = $request;
    }

    /**
     * Returns the cart item.
     * 
     * @return CartItemInterface
     */
    public function getCartItem()
    {
        return $this->item;
    } 
    
    /**
     * Returns the request.
     * 
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }    
}