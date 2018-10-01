<?php
declare(strict_types=1);

namespace ConnectIn;

interface ValueObject
{
    public function equals(ValueObject $object) : bool;
}
