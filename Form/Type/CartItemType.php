<?php

/*
 * This file is part of the IRCartBundle package.
 * 
 * (c) Julien Kirsch <informatic.revolution@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IR\Bundle\CartBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Cart Item Type.
 *
 * @author Julien Kirsch <informatic.revolution@gmail.com>
 */
class CartItemType extends AbstractType
{
    /**
     * @var string
     */         
    protected $class;

    
    /**
     * Constructor.
     * 
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
            ->add('quantity', 'integer', array(
                'attr' => array('min' => 1),
                'label' => 'form.cart_item.quantity',
                'translation_domain' => 'ir_cart',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */       
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention' => 'cart_item',
        ));        
    }       
    
    /**
     * {@inheritdoc}
     */
    public function getName() 
    {
        return 'ir_cart_item';
    }    
}
