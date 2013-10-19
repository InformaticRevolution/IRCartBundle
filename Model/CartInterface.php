<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Cart Interface.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartInterface 
{
    /**
     * Returns the id.
     * 
     * @return mixed
     */
    public function getId();    
    
    /**
     * Returns all the items.
     * 
     * @return Collection
     */
    public function getItems();

    /**
     * Adds an item.
     * 
     * @param CartItemInterface $item
     */
    public function addItem(CartItemInterface $item);
    
    /**
     * Removes an item.
     * 
     * @param CartItemInterface $item
     */
    public function removeItem(CartItemInterface $item);
    
    /**
     * Checks whether cart has given item.
     * 
     * @param CartItemInterface $item
     * 
     * @return Boolean
     */
    public function hasItem(CartItemInterface $item);
    
    /**
     * Clears all the items.
     */
    public function clearItems();   
    
    /**
     * Returns the total.
     *
     * @return float
     */
    public function getTotal();

    /**
     * Sets the total.
     *
     * @param float $total
     */
    public function setTotal($total); 
    
    /**
     * Checks whether the cart is empty or not.
     *
     * @return Boolean
     */
    public function isEmpty();    
}
