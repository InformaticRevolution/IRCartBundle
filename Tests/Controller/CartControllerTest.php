<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\Controller;

use IR\Bundle\CartBundle\Tests\Functional\WebTestCase;

/**
 * Cart Controller Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartControllerTest extends WebTestCase
{
    const FORM_INTENTION = 'cart';

    
    public function testCheckoutActionGetMethod()
    {
        $crawler = $this->client->request('GET', '/checkout');

        $this->assertResponseStatusCode(200);
        $this->assertCount(1, $crawler->filter('form')); 
    }
    
    public function testCheckoutActionPostMethod()
    {
        $this->client->request('POST', '/checkout', array(
            'ir_cart_form' => array (   
                'items' => array(
                    array('quantity' => 1),
                    array('quantity' => 2),
                    array('quantity' => 3),                
                ),
                '_token' => $this->generateCsrfToken(static::FORM_INTENTION),
            )
        )); 
        
        $this->assertResponseStatusCode(302);
        
        $crawler = $this->client->followRedirect();
        
        $this->assertResponseStatusCode(200);
        $this->assertCurrentUri('/checkout');        
        $this->assertEquals(array("1", "2", "3"), $crawler->filter('input[type="number"]')->extract('value'));
    }
    
    public function testClearAction()
    {
        $this->client->request('GET', '/clear');

        $this->assertResponseStatusCode(302);
        
        $crawler = $this->client->followRedirect();
        
        $this->assertResponseStatusCode(200);
        $this->assertCurrentUri('/checkout'); 
        $this->assertCount(0, $crawler->filter('tbody tr'));
    }      
}
