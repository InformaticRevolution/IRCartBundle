<?php

/*
 * This file is part of the IRCartBundle package.
 *
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle;

/**
 * Contains all events thrown in the IRCartBundle.
 * 
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
final class IRCartEvents
{
    /**
     * The CART_EDIT_COMPLETED event occurs after saving the cart in the cart edit process.
     *
     * The event listener method receives a IR\Bundle\CartBundle\Event\CartEvent instance.
     */
    const CART_EDIT_COMPLETED = 'ir_cart.cart.edit.completed';     
    
    /**
     * The CART_CLEAR_COMPLETED event occurs after clearing the cart.
     *
     * The event listener method receives a IR\Bundle\CartBundle\Event\CartEvent instance.
     */
    const CART_CLEAR_COMPLETED = 'ir_cart.cart.clear.completed';    
    
    /**
     * The CART_ITEM_ADD_INITIALIZE event occurs when the cart item add process is initialized.
     *
     * This event allows you to modify the default values of the cart item.
     * The event listener method receives a IR\Bundle\CartBundle\Event\CartItemEvent instance.
     */
    const CART_ITEM_ADD_INITIALIZE = 'ir_cart.cart_item.add.initialize';    
    
    /**
     * The CART_ITEM_ADD_COMPLETED event occurs after saving the cart in the cart item creation process.
     *
     * The event listener method receives a IR\Bundle\CartBundle\Event\CartItemEvent instance.
     */
    const CART_ITEM_ADD_COMPLETED = 'ir_cart.cart_item.add.completed'; 
    
    /**
     * The CART_ITEM_REMOVE_COMPLETED event occurs after saving the cart in the cart item remove process.
     *
     * The event listener method receives a IR\Bundle\CartBundle\Event\CartItemEvent instance.
     */
    const CART_ITEM_REMOVE_COMPLETED = 'ir_cart.cart_item.remove.completed';     
}