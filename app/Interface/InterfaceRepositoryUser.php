<?php

namespace App\Interface;

use App\Dto\DtoRestUser;
use Bitrix24\SDK\Services\Main\Result\UserProfileItemResult;

interface InterfaceRepositoryUser
{
    public function find(string $query): array;

    /** @return DtoRestUser[] */
    public function getByListId(array $userListId): array;

    public function isCurrentUserAdmin(): bool;

    public function getCurrentUser(): UserProfileItemResult|bool;
}
