<?php

namespace App\Repository;


use App\Dto\DtoRestUser;
use App\Interface\InterfaceRepositoryUser;
use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Exceptions\TransportException;
use Bitrix24\SDK\Services\Main\Result\UserProfileItemResult;
use Bitrix24\SDK\Services\Main\Service\Main;

class RepositoryRestUser extends RepositoryRestAbstract  implements InterfaceRepositoryUser
{
    public function __construct(protected ?\Bitrix24\SDK\Core\Core $core, protected ?Main $main)
    {
    }

    public function find(string $query): array
    {
        try {
            $r = $this->core->call("user.search", [
                "FILTER" => [
                    "FIND" => $query,
                ],
            ]);

            foreach ($r->getResponseData()->getResult() ?? [] as $userArray) {
                $rows[] = $this->map($userArray);
            }

            return $rows ?? [];
        } catch (BaseException|TransportException $e) {
            return [];
        }
    }

    protected function map(array $userArray)
    {
        return new DtoRestUser(
            id: $userArray['ID'],
            name: $userArray['NAME'] ?? null,
            lastName: $userArray['LAST_NAME'] ?? null,
            secondName: $userArray['SECOND_NAME'] ?? null
        );
    }

    public function getByListId(array $userListId): array
    {
        try {
            $r = $this->core->call("user.get", [
                "ID" => $userListId,
            ]);

            foreach ($r->getResponseData()->getResult() ?? [] as $userArray) {
                $rows[] = $this->map($userArray);
            }

            return $rows ?? [];

        } catch (BaseException|TransportException $e) {
            return [];
        }
    }

    public function getCurrentUser(): UserProfileItemResult|bool
    {
        try {
            return $this->main->getCurrentUserProfile()->getUserProfile();
        } catch (BaseException|TransportException $e) {
            return false;
        }
    }

    public function isCurrentUserAdmin(): bool
    {
        try {
            if(!$dtoUser = $this->getCurrentUser()) {
                return false;
            }

            return $dtoUser->ADMIN;

        } catch (BaseException|TransportException $e) {
            return false;
        }
    }
}
