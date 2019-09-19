<?php

namespace Tnt\Styleguide\Console;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Styleguide extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('styleguide')
            ->addSubCommand(Install::class)
            ;
    }
}