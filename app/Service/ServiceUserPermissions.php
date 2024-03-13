<?php

namespace App\Service;

use App\Enum\EnumUserPermission;
use App\Interface\InterfaceRepositoryUser;
use Bitrix24\SDK\Services\Main\Result\UserProfileItemResult;

class ServiceUserPermissions
{
    public function __construct(protected InterfaceRepositoryUser $repositoryUser)
    {
    }

    public function getCodeByCurrentUser() : string
    {
        return $this->getCodeGroupPermissionByUser($this->repositoryUser->getCurrentUser());
    }

    public function getCodeGroupPermissionByUser(UserProfileItemResult $dtoUser): string
    {
        if ($dtoUser->ADMIN) {
            return EnumUserPermission::ADMIN->value;
        }

        return EnumUserPermission::USER->value;
    }
}
