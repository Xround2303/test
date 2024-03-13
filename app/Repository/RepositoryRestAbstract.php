<?php

namespace App\Repository;

use Bitrix24\SDK\Core\Core;

class RepositoryRestAbstract
{
    protected ?Core $core = null;

    public function getCore(): ?Core
    {
        return $this->core;
    }

    public function setCore(?Core $core): self
    {
        $this->core = $core;
        return $this;
    }


}
