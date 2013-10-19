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
use IR\Bundle\CartBundle\Model\CartInterface;

/**
 * Cart Event.
 * 
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartEvent extends Event
{    
    /**
     * @var CartInterface
     */              
    protected $cart; 
    
    
    /**
     * Constructor.
     * 
     * @param CartInterface $cart
     */            
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Returns the cart.
     * 
     * @return CartInterface
     */
    public function getCart()
    {
        return $this->cart;
    }  
}