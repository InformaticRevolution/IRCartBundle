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
use IR\Bundle\CartBundle\Manager\CartManagerInterface;
use IR\Bundle\CartBundle\Storage\CartStorageInterface;

/**
 * Default Cart Provider.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartProvider implements CartProviderInterface
{
    /**
     * @var CartStorageInterface
     */
    protected $storage;
    
    /**
     * @var CartManagerInterface
     */
    protected $cartManager;
    
    /**
     * @var CartInterface
     */
    protected $cart;


    /**
     * Constructor.
     * 
     * @param CartStorageInterface $storage
     * @param CartManagerInterface $cartManager
     */
    public function __construct(CartStorageInterface $storage, CartManagerInterface $cartManager) 
    {
        $this->storage = $storage;
        $this->cartManager = $cartManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart() 
    {   
        if (null !== $this->cart) {
            return $this->cart;
        }
                
        if ($cart = $this->storage->getCart()) {
            return $this->cart = $cart;
        }

        $this->cartManager->createCart();
        $this->storage->setCart($cart);
                
        return $this->cart = $cart;
    }    
    
    /**
     * {@inheritdoc}
     */
    public function setCart(CartInterface $cart)
    {
        $this->cart = $cart;
        $this->storage->setCart($cart);
    }
}
