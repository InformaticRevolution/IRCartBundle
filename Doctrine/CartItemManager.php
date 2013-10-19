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
use IR\Bundle\CartBundle\Manager\CartItemManager as BaseManager;

/**
 * Doctrine Cart Item Manager.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemManager extends BaseManager
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
     * {@inheritdoc}
     */    
    public function findCartItemBy(array $criteria) 
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
