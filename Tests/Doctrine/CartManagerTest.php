<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\Doctrine;

use IR\Bundle\CartBundle\Model\Cart;
use IR\Bundle\CartBundle\Doctrine\CartManager;

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

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManager;
    
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $repository;
    
    
    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }  
                
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
                
        $this->objectManager->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::CART_CLASS))
            ->will($this->returnValue($this->repository));        

        $this->objectManager->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::CART_CLASS))
            ->will($this->returnValue($class));        
        
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::CART_CLASS));        
        
        $this->cartManager = new CartManager($this->objectManager, static::CART_CLASS);
    }    
    
    public function testUpdateCart()
    {
        $cart = $this->getCart();
        
        $this->objectManager->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($cart));
        
        $this->objectManager->expects($this->once())
            ->method('flush');

        $this->cartManager->updateCart($cart);
    }   
    
    public function testDeleteCart()
    {
        $cart = $this->getCart();
        
        $this->objectManager->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($cart));
        
        $this->objectManager->expects($this->once())
            ->method('flush');

        $this->cartManager->deleteCart($cart);
    }     
    
    public function testFindCartBy()
    {
        $criteria = array("foo" => "bar");
        
        $this->repository->expects($this->once())
            ->method('findOneBy')
            ->with($this->equalTo($criteria))
            ->will($this->returnValue(array()));

        $this->cartManager->findCartBy($criteria);
    }    
    
    public function testGetClass()
    {
        $this->assertEquals(static::CART_CLASS, $this->cartManager->getClass());
    }

    /**
     * @return Cart
     */
    protected function getCart()
    {
        $cartClass = static::CART_CLASS;

        return new $cartClass();
    }    
}