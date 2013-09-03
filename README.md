ConstValidator
===============

Validating parameters defined by constants.

Simple example
----------------
Because simple example is better than a thousand words.

User entity (without PHPDoc, constructor, getters, etc.):

```php
<?php

use ConstValidator\Validator as Constant;

class UserEntity {

    private $role;

    public function setRole($role)
    {
        if(!Constant::validate("UserEntity::ROLE_*", $role)){
            throw new Exception("Invalid role");
        }
        $this->role = $role;
    }

    const ROLE_MEMBER    = 'member';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_ADMIN     = 'admin';
}
