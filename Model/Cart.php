<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Model;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Abstract Cart implementation.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class Cart implements CartInterface
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * @var float
     */
    protected $total;    
    

    /**
     * Constructor.
     */
    public function __construct() 
    {
        $this->items = new ArrayCollection();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }    
    
    /**
     * {@inheritdoc}
     */
    public function getItems() 
    {
        return $this->items;
    }    

    /**
     * {@inheritdoc}
     */    
    public function addItem(CartItemInterface $item) 
    {
        if ($this->hasItem($item)) {
            return;
        }
        /*
        foreach ($this->items as $currentItem) {
            if ($currentItem === $item) {
                $currentItem->setQuantity($currentItem->getQuantity() + $item->getQuantity());
                
                return;
            }
        }*/
        
        $item->setCart($this);
        $this->items->add($item);        
    }

    /**
     * {@inheritdoc}
     */    
    public function removeItem(CartItemInterface $item) 
    {
        if ($this->items->removeElement($item)) {
            $item->setCart(null);
        }
    }    
    
    /**
     * {@inheritdoc}
     */    
    public function hasItem(CartItemInterface $item) 
    {
        return $this->items->contains($item);
    }    

    /**
     * {@inheritdoc}
     */
    public function clearItems()
    {
        $this->items->clear();
    }    
    
    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->items->isEmpty();
    }
}
