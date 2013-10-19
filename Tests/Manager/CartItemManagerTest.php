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

use IR\Bundle\CartBundle\Manager\CartItemManager;

/**
 * Cart Item Manager Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemManagerTest extends \PHPUnit_Framework_TestCase
{
    const CART_ITEM_CLASS = 'IR\Bundle\CartBundle\Tests\TestCartItem';
 
    /**
     * @var CartItemManager
     */
    protected $cartItemManager;    
    
    
    public function setUp()
    {
        $this->cartItemManager = $this->getMockForAbstractClass('IR\Bundle\CartBundle\Manager\CartItemManager');
        
        $this->cartItemManager->expects($this->any())
            ->method('getClass')
            ->will($this->returnValue(static::CART_ITEM_CLASS));        
    }
    
    public function testCreateCartItem()
    {        
        $cartItem = $this->cartItemManager->createCartItem();
        
        $this->assertInstanceOf(static::CART_ITEM_CLASS, $cartItem);
    }
}