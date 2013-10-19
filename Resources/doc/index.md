Getting Started With IRCartBundle
=================================

## Prerequisites

This version of the bundle requires Symfony 2.3+.

## Installation

1. Download IRCartBundle using composer
2. Enable the Bundle
3. Create your classes
4. Configure the IRCartBundle
5. Import IRCartBundle routing
6. Update your database schema

### Step 1: Download IRCartBundle using composer

Add IRCartBundle in your composer.json:

``` js
{
    "require": {
        "informaticrevolution/cart-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update informaticrevolution/cart-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IR\Bundle\CartBundle\IRCartBundle(),
    );
}
```

### Step 3: Create your classes

**a) Create your CartItem class**

##### Annotations
``` php
<?php
// src/Acme/CartBundle/Entity/CartItem.php

namespace Acme\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IR\Bundle\CartBundle\Model\CartItem as BaseCartItem;

/**
 * @ORM\Entity
 * @ORM\Table(name="acme_cart_item")
 */
class CartItem extends BaseCartItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
}
```

##### Yaml or Xml

``` php
<?php
// src/Acme/CartBundle/Entity/CartItem.php

namespace Acme\CartBundle\Entity;

use IR\Bundle\CartBundle\Model\CartItem as BaseCartItem;

/**
 * CartItem.
 */
class CartItem extends BaseCartItem
{
}
```

In YAML:

``` yaml
# src/Acme/CartBundle/Resources/config/doctrine/CartItem.orm.yml
Acme\CartBundle\Entity\CartItem:
    type:  entity
    table: acme_cart_item
    id:
        id:
            type: integer
            generator:
                strategy: AUTO
```

In XML:

``` xml
<!-- src/Acme/CartBundle/Resources/config/doctrine/CartItem.orm.xml -->
<?xml version="1.0" encoding="UTF-8"?>
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                                      http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\CartBundle\Entity\CartItem" table="acme_cart_item">
        <id name="id" type="integer" column="id">
            <generator strategy="AUTO" />
        </id> 
    </entity>
    
</doctrine-mapping>
```

**b) Create your Cart class**


**Warning:**

> If you override the __construct() method in your Cart class, be sure
> to call parent::__construct(), as the base Cart class depends on
> this to initialize some fields.

##### Annotations

``` php
<?php
// src/Acme/CartBundle/Entity/Cart.php

namespace Acme\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IR\Bundle\CartBundle\Model\Cart as BaseCart;

/**
 * @ORM\Entity
 * @ORM\Table(name="acme_cart")
 */
class Cart extends BaseCart
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"all"}, orphanRemoval=true)
     */
    protected $items;


    /**
     * Constructor.
     */  
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```

##### Yaml or Xml

``` php
<?php
// src/Acme/CartBundle/Entity/Cart.php

namespace Acme\CartBundle\Entity;

use IR\Bundle\CartBundle\Model\Cart as BaseCart;

/**
 * Cart.
 */
class Cart extends BaseCart
{
    /**
     * Constructor.
     */  
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```

In YAML:

``` yaml
# src/Acme/CartBundle/Resources/config/doctrine/Cart.orm.yml
Acme\CartBundle\Entity\Cart:
    type:  entity
    table: acme_cart
    id:
        id:
            type: integer
            generator:
                strategy: AUTO

    oneToMany:
        items:
            targetEntity: CartItem
            mappedBy: cart
            cascade: [ all ]
            orphanRemoval: true
```

In XML:

``` xml
<!-- src/Acme/CartBundle/Resources/config/doctrine/Cart.orm.xml -->
<?xml version="1.0" encoding="UTF-8"?>
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
                  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                  xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping
                                      http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\CartBundle\Entity\Cart" table="acme_cart">
        <id name="id" type="integer" column="id">
            <generator strategy="AUTO" />
        </id> 

        <one-to-many field="values" target-entity="CartItem" mapped-by="cart" orphan-removal="true">
            <cascade>
                <cascade-all />
            </cascade>            
        </one-to-many>
    </entity>
    
</doctrine-mapping>
```

### Step 4: Configure the IRCartBundle

**a) Add the bundle minimum configuration to your `config.yml` file**

``` yaml
# app/config/config.yml
ir_cart:
    db_driver: orm # orm is the only available driver for the moment 
    cart_class: Acme\CartBundle\Entity\Cart
```

**b) Add the CartInterface path to the RTEL**

``` yaml
# app/config/config.yml
doctrine:
    # ....
    orm:
        # ....
        resolve_target_entities:
            IR\Bundle\CartBundle\Model\CartInterface: Acme\CartBundle\Entity\Cart
```

### Step 5: Import IRCartBundle routing files

Add the following configuration to your `routing.yml` file:

``` yaml
# app/config/routing.yml
ir_cart:
    resource: "@IRCartBundle/Resources/config/routing.xml"
```

### Step 6: Update your database schema

Run the following command:

``` bash
$ php app/console doctrine:schema:update --force
```