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
class CartItemControllerTest extends WebTestCase
{    
    public function testAddAction()
    {
        $this->client->request('GET', '/add');

        $this->assertResponseStatusCode(302);
        
        $crawler = $this->client->followRedirect();
        
        $this->assertResponseStatusCode(200);
        $this->assertCurrentUri('/checkout'); 
        $this->assertCount(4, $crawler->filter('tbody tr')); 
    }  
    
    public function testRemoveAction()
    {
        $this->client->request('GET', '/1/remove');

        $this->assertResponseStatusCode(302);
        
        //$crawler = $this->client->followRedirect();
        
        //$this->assertResponseStatusCode(200);
        //$this->assertCurrentUri('/checkout'); 
        //$this->assertCount(2, $crawler->filter('tbody tr'));        
    }      
}
