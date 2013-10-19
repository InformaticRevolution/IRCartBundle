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
     * Constructor.
     * 
     * @param CartItemInterface $item
     */            
    public function __construct(CartItemInterface $item)
    {
        $this->item = $item;
    }

    /**
     * Returns the item.
     * 
     * @return CartItemInterface
     */
    public function getCartItem()
    {
        return $this->item;
    }  
}