<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Provider;

use IR\Bundle\CartBundle\Model\CartInterface;

/**
 * Cart Provider Interface.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartProviderInterface 
{
    /**
     * Returns the current cart.
     * 
     * @return CartInterface
     */
    public function getCart();
    
    /**
     * Sets the current cart.
     * 
     * @param CartInterface $cart
     */
    public function setCart(CartInterface $cart);
}
