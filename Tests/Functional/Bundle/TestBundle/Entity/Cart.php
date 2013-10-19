<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\Functional\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IR\Bundle\CartBundle\Model\Cart as BaseCart;

/**
 * @ORM\Entity
 * @ORM\Table(name="cart")
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class Cart extends BaseCart
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;   
    
    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"all"}, orphanRemoval=true)
     */
    protected $items;    
}
