<?php

namespace CV\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CVUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
