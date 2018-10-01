<?php
declare(strict_types=1);

namespace ConnectIn\Exception;

use RuntimeException;

class NoRegisteredUserException extends RuntimeException
{
    protected $message = 'There is no registered users found.';
}
