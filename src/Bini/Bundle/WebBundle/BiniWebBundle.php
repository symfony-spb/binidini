<?php

namespace Bini\Bundle\WebBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BiniWebBundle extends Bundle
{
    public function getParent()
    {
        return 'SyliusWebBundle';
    }
}
