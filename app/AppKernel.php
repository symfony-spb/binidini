<?php

use Sylius\Bundle\CoreBundle\Kernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Bini\Bundle\WebBundle\BiniWebBundle(),
        );

        return array_merge($bundles, parent::registerBundles());
    }
}
