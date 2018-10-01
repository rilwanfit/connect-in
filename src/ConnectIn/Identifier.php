<?php
declare(strict_types=1);

namespace ConnectIn;

interface Identifier
{
    public function __toString(): string;
}
