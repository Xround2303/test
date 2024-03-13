<?php

namespace App\Interface;

use Bitrix24\SDK\Services\Main\Result\ApplicationInfoItemResult;

interface InterfaceRepositoryRestApp
{
    public function getInfo(): ApplicationInfoItemResult|false;
}
