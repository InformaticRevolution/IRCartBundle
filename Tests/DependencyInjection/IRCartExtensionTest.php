<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Tests\DependencyInjection;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use IR\Bundle\CartBundle\DependencyInjection\IRCartExtension;

/**
 * Cart Extension Test.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class IRCartExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** 
     * @var ContainerBuilder
     */
    protected $configuration;
    
    
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testCartLoadThrowsExceptionUnlessDatabaseDriverSet()
    {
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['db_driver']);
        $loader->load(array($config), new ContainerBuilder());
    }  
    
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testCartLoadThrowsExceptionUnlessDatabaseDriverIsValid()
    {
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        $config['db_driver'] = 'foo';
        $loader->load(array($config), new ContainerBuilder());
    }       
    
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testCartLoadThrowsExceptionUnlessCartModelClassSet()
    {
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['cart_class']);
        $loader->load(array($config), new ContainerBuilder());
    }  
    
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testCartLoadThrowsExceptionUnlessCartItemModelClassSet()
    {
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        unset($config['cart_item_class']);
        $loader->load(array($config), new ContainerBuilder());
    }      
    
    public function testDisableCart()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        $config['cart'] = false;
        $loader->load(array($config), $this->configuration);
        $this->assertNotHasDefinition('ir_cart.form.cart');
    }  
    
    public function testDisableCartItem()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        $config['cart_item'] = false;
        $loader->load(array($config), $this->configuration);
        $this->assertNotHasDefinition('ir_cart.form.cart_item');
    }      
    
    public function testCartLoadModelClassWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertParameter('Acme\CartBundle\Entity\Cart', 'ir_cart.model.cart.class');
        $this->assertParameter('Acme\CartBundle\Entity\CartItem', 'ir_cart.model.cart_item.class');
    }       
    
    public function testCartLoadModelClass()
    {
        $this->createFullConfiguration();

        $this->assertParameter('Acme\CartBundle\Entity\Cart', 'ir_cart.model.cart.class');
        $this->assertParameter('Acme\CartBundle\Entity\CartItem', 'ir_cart.model.cart_item.class');
    }      
    
    public function testCartLoadManagerClassWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertAlias('ir_cart.manager.cart.default', 'ir_cart.manager.cart');
        $this->assertAlias('ir_cart.manager.cart_item.default', 'ir_cart.manager.cart_item');
    }       
    
    public function testCartLoadManagerClass()
    {
        $this->createFullConfiguration();

        $this->assertAlias('acme_cart.manager.cart', 'ir_cart.manager.cart');
        $this->assertAlias('acme_cart.manager.cart_item', 'ir_cart.manager.cart_item');
    }      
    
    public function testCartLoadFormClassWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertParameter('ir_cart', 'ir_cart.form.type.cart');
        $this->assertParameter('ir_cart_item', 'ir_cart.form.type.cart_item');
    }      
    
    public function testCartLoadFormClass()
    {
        $this->createFullConfiguration();

        $this->assertParameter('acme_cart', 'ir_cart.form.type.cart');
        $this->assertParameter('acme_cart_item', 'ir_cart.form.type.cart_item');
    }      
    
    public function testCartLoadServiceWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertAlias('ir_cart.storage.cart.session', 'ir_cart.storage.cart');
        $this->assertAlias('ir_cart.provider.cart.default', 'ir_cart.provider.cart');
    }    
    
    public function testCartLoadFormNameWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertParameter('ir_cart_form', 'ir_cart.form.name.cart');
        $this->assertParameter('ir_cart_item_form', 'ir_cart.form.name.cart_item');
    }       
    
    public function testCartLoadFormName()
    {
        $this->createFullConfiguration();

        $this->assertParameter('acme_cart_form', 'ir_cart.form.name.cart');
        $this->assertParameter('acme_cart_item_form', 'ir_cart.form.name.cart_item');
    }        
    
    public function testCartLoadFormServiceWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertHasDefinition('ir_cart.form.cart');
        $this->assertHasDefinition('ir_cart.form.cart_item');
    }     
    
    public function testCartLoadFormService()
    {
        $this->createFullConfiguration();

        $this->assertHasDefinition('ir_cart.form.cart');
        $this->assertHasDefinition('ir_cart.form.cart_item');
    }     
    
    public function testCartLoadUtilServiceWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertAlias('ir_cart.storage.cart.session', 'ir_cart.storage.cart');
        $this->assertAlias('ir_cart.provider.cart.default', 'ir_cart.provider.cart');
    }    
    
    public function testCartLoadUtilService()
    {
        $this->createFullConfiguration();

        $this->assertAlias('acme_cart.storage.cart', 'ir_cart.storage.cart');
        $this->assertAlias('acme_cart.provider.cart', 'ir_cart.provider.cart');
    }    

    public function testCartLoadTemplateConfigWithDefaults()
    {
        $this->createEmptyConfiguration();

        $this->assertParameter('twig', 'ir_cart.template.engine');
    }      
    
    public function testCartLoadTemplateConfig()
    {
        $this->createFullConfiguration();

        $this->assertParameter('php', 'ir_cart.template.engine');
    }           
    
    protected function createEmptyConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new IRCartExtension();
        $config = $this->getEmptyConfig();
        $loader->load(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }       
    
    protected function createFullConfiguration()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new IRCartExtension();
        $config = $this->getFullConfig();
        $loader->load(array($config), $this->configuration);
        $this->assertTrue($this->configuration instanceof ContainerBuilder);
    }       
    
    /**
     * @return array
     */
    protected function getEmptyConfig()
    {
        $parser = new Parser();

        return $parser->parse(file_get_contents(__DIR__.'/Fixtures/minimal_config.yml'));
    }
    
    /**
     * @return array
     */    
    protected function getFullConfig()
    {
        $parser = new Parser();

        return $parser->parse(file_get_contents(__DIR__.'/Fixtures/full_config.yml'));
    }    
    
    /**
     * @param string $value
     * @param string $key
     */
    private function assertAlias($value, $key)
    {
        $this->assertEquals($value, (string) $this->configuration->getAlias($key), sprintf('%s alias is correct', $key));
    }          
    
    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->configuration->getParameter($key), sprintf('%s parameter is incorrect', $key));
    }      
    
    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }        
    
    /**
     * @param string $id
     */
    private function assertNotHasDefinition($id)
    {
        $this->assertFalse(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }    
}
