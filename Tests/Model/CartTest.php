<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\Model;

use IR\Bundle\CartBundle\Model\Cart;
use IR\Bundle\CartBundle\Model\CartItem;

/**
 * Cart Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testAddItem()
    {
        $cart = $this->getCart();
        $item = $this->getCartItem();
        
        $this->assertNotContains($item, $cart->getItems());
        $this->assertNull($item->getCart());
        
        $cart->addItem($item);
        
        $this->assertContains($item, $cart->getItems());
        $this->assertSame($cart, $item->getCart());        
    }  
    
    public function testRemoveItem()
    {
        $cart = $this->getCart();
        $item = $this->getCartItem();
        $cart->addItem($item);
        
        $this->assertContains($item, $cart->getItems());
        $this->assertSame($cart, $item->getCart());
        
        $cart->removeItem($item);
        
        $this->assertNotContains($item, $cart->getItems());
        $this->assertNull($item->getCart());
    }    
    
    public function testHasItem()
    {
        $cart = $this->getCart();
        $item = $this->getCartItem();
        
        $this->assertFalse($cart->hasItem($item));
        $cart->addItem($item);
        $this->assertTrue($cart->hasItem($item));
    }        
    
    public function testClearItems()
    {
        $cart = $this->getCart();
        $cart->addItem($this->getCartItem());
        $cart->addItem($this->getCartItem());
        
        $this->assertCount(2, $cart->getItems());
        $cart->clearItems();
        $this->assertCount(0, $cart->getItems());
    }
            
    public function testTotal()
    {
        $cart = $this->getCart();
        
        $this->assertEquals(0, $cart->getTotal());
        $cart->setTotal(25.99);
        $this->assertEquals(25.99, $cart->getTotal());
    }
            
    public function testIsEmpty()
    {
        $cart = $this->getCart();
        $item = $this->getCartItem();
        
        $this->assertTrue($cart->isEmpty());
        $cart->addItem($item);
        $this->assertFalse($cart->isEmpty());
    }
            
    /**
     * @return Cart
     */
    protected function getCart()
    {
        return $this->getMockForAbstractClass('IR\Bundle\CartBundle\Model\Cart');
    }   
    
    /**
     * @return CartItem
     */
    protected function getCartItem()
    {
        return $this->getMockForAbstractClass('IR\Bundle\CartBundle\Model\CartItem');
    }      
}
