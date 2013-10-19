<?php

/*
 * This file is part of the IRCartBundle package.
 *
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\TranslatorInterface;
use IR\Bundle\CartBundle\IRCartEvents;

/**
 * Flash Listener.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class FlashListener implements EventSubscriberInterface
{
    private static $successMessages = array(
        IRCartEvents::CART_EDIT_COMPLETED => 'cart.flash.updated',
        IRCartEvents::CART_CLEAR_COMPLETED => 'cart.flash.cleared',
        IRCartEvents::CART_ITEM_ADD_COMPLETED => 'cart.flash.added',        
        IRCartEvents::CART_ITEM_REMOVE_COMPLETED => 'cart.flash.removed',
    );

    /**
     * @var SessionInterface
     */    
    protected $session;
    
    /**
     * @var TranslatorInterface
     */    
    protected $translator;

    
   /**
    * Constructor.
    *
    * @param SessionInterface    $session
    * @param TranslatorInterface $translator
    */            
    public function __construct(SessionInterface $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */        
    public static function getSubscribedEvents()
    {
        return array(
            IRCartEvents::CART_EDIT_COMPLETED => 'addSuccessFlash',
            IRCartEvents::CART_CLEAR_COMPLETED => 'addSuccessFlash',
            IRCartEvents::CART_ITEM_ADD_COMPLETED => 'addSuccessFlash',             
            IRCartEvents::CART_ITEM_REMOVE_COMPLETED => 'addSuccessFlash',
        );
    }

    /**
     * Adds a success flash message.
     * 
     * @param Event $event
     * 
     * @return void
     */            
    public function addSuccessFlash(Event $event)
    {
        if (!isset(self::$successMessages[$event->getName()])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('success', $this->trans(self::$successMessages[$event->getName()]));
    }

    /**
     * Translates a message.
     * 
     * @param string $message
     * @param array  $params
     * 
     * @return string
     */       
    private function trans($message, array $params = array())
    {
        return $this->translator->trans($message, $params, 'ir_cart');
    }
}