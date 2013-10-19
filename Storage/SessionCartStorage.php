<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Storage;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use IR\Bundle\CartBundle\Model\CartInterface;

/**
 * Session Cart Storage.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class SessionCartStorage implements CartStorageInterface
{    
    /**
     * @var SessionInterface
     */
    protected $session;
    
    /**
     * @var string
     */
    protected $key;    
    
    
    /**
     * Constructor.
     * 
     * @param SessionInterface $session
     * @param string           $key
     */
    public function __construct(SessionInterface $session, $key) 
    {
        $this->session = $session;
        $this->key = $key;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCart() 
    {
        return $this->session->get($this->key);
    }

    /**
     * {@inheritdoc}
     */    
    public function setCart(CartInterface $cart) 
    {
        $this->session->set($this->key, $cart);
    }    
}
