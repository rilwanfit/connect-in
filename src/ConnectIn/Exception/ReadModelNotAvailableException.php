<?php
declare(strict_types=1);

namespace ConnectIn\Exception;

use RuntimeException;

class ReadModelNotAvailableException extends RuntimeException
{
    protected $message = 'Read model is not available';
}
