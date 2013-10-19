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
 * Abstract Cart Item implementation.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
abstract class CartItem implements CartItemInterface
{
    /**
     * @var mixed
     */
    protected $id;
    
    /**
     * @var CartInterface
     */
    protected $cart;
    
    /**
     * @var integer
     */
    protected $quantity;
    
    /**
     * @var float
     */
    protected $unitPrice;
    
    /**
     * @var float
     */
    protected $total;
    

    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->quantity = 1;
        $this->unitPrice = 0;
        $this->total = 0;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }    
    
    /**
     * {@inheritdoc}
     */
    public function getCart()
    {
        return $this->cart;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart = null)
    {
        $this->cart = $cart;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }
}
