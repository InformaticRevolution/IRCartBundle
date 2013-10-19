<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

use IR\Bundle\CartBundle\Model\CartInterface;
use IR\Bundle\CartBundle\Manager\CartManager as BaseManager;

/**
 * Doctrine Cart Manager.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartManager extends BaseManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;
    
    /**
     * @var ObjectRepository
     */
    protected $repository;
    
    /**
     * @var string
     */           
    protected $class;    
    
    
    /**
     * Constructor.
     * 
    * @param ObjectManager $om
    * @param string        $class
     */
    public function __construct(ObjectManager $om, $class) 
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);
        
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * Updates a cart.
     *
     * @param CartInterface $cart
     * @param Boolean       $andFlush Whether to flush the changes (default true)
     */   
    public function updateCart(CartInterface $cart, $andFlush = true) 
    {
        $this->objectManager->persist($cart);
   
        if ($andFlush) {
            $this->objectManager->flush();
        }             
    }    

    /**
     * {@inheritdoc}
     */    
    public function deleteCart(CartInterface $cart) 
    {
        $this->objectManager->remove($cart);
        $this->objectManager->flush();          
    }

    /**
     * {@inheritdoc}
     */    
    public function findCartBy(array $criteria) 
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */    
    public function getClass() 
    {
        return $this->class;
    }    
}
