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

/**
 * Cart Item Interface.
 * 
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
interface CartItemInterface 
{
    /**
     * Returns the id.
     * 
     * @return mixed
     */
    public function getId();   
    
    /**
     * Returns the cart.
     * 
     * @return CartInterface
     */
    public function getCart();
    
    /**
     * Sets the cart.
     * 
     * @param CartInterface|null $cart
     */
    public function setCart(CartInterface $cart = null);
    
    /**
     * Returns the quantity.
     *
     * @return integer
     */
    public function getQuantity();

    /**
     * Sets the quantity.
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity);    
    
    /**
     * Returns the unit price.
     *
     * @return float
     */
    public function getUnitPrice();

    /**
     * Sets the unit price.
     *
     * @param float $unitPrice
     */
    public function setUnitPrice($unitPrice);  
    
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
}
