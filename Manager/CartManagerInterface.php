<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Manager;

use IR\Bundle\CartBundle\Model\CartInterface;

/**
 * Cart Manager Interface.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartManagerInterface 
{
    /**
     * Creates an empty cart instance.
     * 
     * @return CartInterface
     */
    public function createCart();
    
    /**
     * Updates a cart.
     * 
     * @param CartInterface $cart
     */
    public function updateCart(CartInterface $cart);
    
    /**
     * Deletes a cart.
     * 
     * @param CartInterface $cart
     */
    public function deleteCart(CartInterface $cart);
    
    /**
     * Finds a cart by the given criteria.
     *
     * @param array $criteria
     *
     * @return CartInterface|null
     */
    public function findCartBy(array $criteria); 
    
    /**
     * Returns the cart's fully qualified class name.
     *
     * @return string
     */
    public function getClass();    
}
