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

use IR\Bundle\CartBundle\Model\CartItem;

/**
 * Cart Item Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSimpleTestData
     */
    public function testSimpleSettersGetters($property, $value, $default)
    {
        $getter = 'get'.$property;
        $setter = 'set'.$property;
        
        $item = $this->getCartItem();
        
        $this->assertEquals($default, $item->$getter());
        $item->$setter($value);
        $this->assertEquals($value, $item->$getter());
    }
    
    public function getSimpleTestData()
    {
        return array(
            array('quantity', 3, 1),
            array('unitPrice', 14.99, 0),
            array('total', 25.99, 0),
        );
    } 
    
    /**
     * @return CartItem
     */
    protected function getCartItem()
    {
        return $this->getMockForAbstractClass('IR\Bundle\CartBundle\Model\CartItem');
    }     
}
