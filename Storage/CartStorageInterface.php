<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Storage;

use IR\Bundle\CartBundle\Model\CartInterface;

/**
 * Cart Storage Interface.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartStorageInterface 
{
    /**
     * Returns the cart.
     * 
     * @return CartInterface|null
     */
    public function getCart();
    
    /**
     * Sets the cart.
     * 
     * @param CartInterface $cart
     */
    public function setCart($cart);
}
