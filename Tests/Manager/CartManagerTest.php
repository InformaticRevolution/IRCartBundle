<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\Manager;

use IR\Bundle\CartBundle\Manager\CartManager;

/**
 * Cart Manager Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartManagerTest extends \PHPUnit_Framework_TestCase
{
    const CART_CLASS = 'IR\Bundle\CartBundle\Tests\TestCart';
 
    /**
     * @var CartManager
     */
    protected $cartManager;    
    
    
    public function setUp()
    {
        $this->cartManager = $this->getMockForAbstractClass('IR\Bundle\CartBundle\Manager\CartManager');
        
        $this->cartManager->expects($this->any())
            ->method('getClass')
            ->will($this->returnValue(static::CART_CLASS));        
    }
    
    public function testCreateCart()
    {        
        $cart = $this->cartManager->createCart();
        
        $this->assertInstanceOf(static::CART_CLASS, $cart);
    }
}