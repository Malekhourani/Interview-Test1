<?php

namespace App\Exceptions;

use Exception;

class OnlyResourceOwnerAndAdminCanEditOrDeleteItException extends Exception
{
    public function __construct($key)
    {
        parent::__construct("only $key owner can delete or edit it");
    }
}
