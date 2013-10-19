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

use IR\Bundle\CartBundle\Doctrine\CartItemManager;

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
            ->with($this->equalTo(static::CART_ITEM_CLASS))
            ->will($this->returnValue($this->repository));        

        $this->objectManager->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::CART_ITEM_CLASS))
            ->will($this->returnValue($class));        
        
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::CART_ITEM_CLASS));        
        
        $this->cartItemManager = new CartItemManager($this->objectManager, static::CART_ITEM_CLASS);
    }    

    public function testFindCartItemBy()
    {
        $criteria = array("foo" => "bar");
        
        $this->repository->expects($this->once())
            ->method('findOneBy')
            ->with($this->equalTo($criteria))
            ->will($this->returnValue(array()));

        $this->cartItemManager->findCartItemBy($criteria);
    }    
    
    public function testGetClass()
    {
        $this->assertEquals(static::CART_ITEM_CLASS, $this->cartItemManager->getClass());
    } 
}