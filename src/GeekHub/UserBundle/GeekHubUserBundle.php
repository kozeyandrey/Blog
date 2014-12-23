<?php

namespace GeekHub\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GeekHubUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
