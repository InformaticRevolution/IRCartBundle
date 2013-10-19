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

use IR\Bundle\CartBundle\Model\CartItemInterface;

/**
 * Cart Item Manager Interface.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartItemManagerInterface 
{
    /**
     * Creates an empty cart item instance.
     * 
     * @return CartItemInterface
     */
    public function createCartItem();

    /**
     * Finds a cart item by the given criteria.
     *
     * @param array $criteria
     *
     * @return CartItemInterface|null
     */
    public function findCartItemBy(array $criteria); 
    
    /**
     * Returns the cart item's fully qualified class name.
     *
     * @return string
     */
    public function getClass();    
}
