<?php

namespace PS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PSUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
