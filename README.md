Validation suite for Yii PHP Framework 2
---

Installation
---

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require thtmorais/yii2-validators "*"
```

or add

```
"thtmorais/yii2-validators": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by:

### XandValidator

```php
<?php

namespace app\models;

use thtmorais\validators\XandValidator;

/**
* Class Model
 */
class Model extends \yii\base\Model
{
    /**
    * @var string
    */
    public $google_client_id;
    
    /**
    * @var string
    */
    public $google_client_secret;
    
    /**
    * @var string
    */
    public $gitlab_client_id;
    
    /**
    * @var string
    */
    public $gitlab_client_secret;
    
    /**
    * @var string
    */
    public $gitlab_domain;;

    /**
    * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['google_client_id', 'google_client_secret'], XandValidator::class, 'fields' => ['google_client_id', 'google_client_secret']],
            [['gitlab_client_id', 'gitlab_client_secret', 'gitlab_domain'], XandValidator::class, 'fields' => ['gitlab_client_id', 'gitlab_client_secret', 'gitlab_domain']],
        ];
    }
}
```
