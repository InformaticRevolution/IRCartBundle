<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Manager;

/**
 * Abstract Cart Item Manager.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
abstract class CartItemManager implements CartItemManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createCartItem() 
    {
        $class = $this->getClass();

        return new $class;        
    }
}
