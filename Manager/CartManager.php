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
 * Abstract Cart Manager.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
abstract class CartManager implements CartManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function createCart() 
    {
        $class = $this->getClass();

        return new $class;        
    }
}
