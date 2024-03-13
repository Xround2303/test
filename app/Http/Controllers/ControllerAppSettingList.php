<?php

namespace App\Http\Controllers;

use App\Interface\InterfaceRepositoryRestApp;
use App\Interface\InterfaceRepositoryUser;
use App\Service\ServiceUserPermissions;
use Illuminate\Http\Request;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

class ControllerAppSettingList extends Controller
{
    public function __construct(
        protected ServiceUserPermissions $serviceUserPermissions,
        protected InterfaceRepositoryRestApp $repositoryRestApp,
        protected InterfaceRepositoryUser $repositoryUser,
        protected DtoAuth $dtoAuth
    )
    {
    }
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $application = $this->repositoryRestApp->getInfo();
        $dtoUser = $this->repositoryUser->getCurrentUser();

        return $this->response([
            "is_app_installed" => $application?->INSTALLED ?? false,
            "user_permission_group" => $dtoUser ? $this->serviceUserPermissions->getCodeGroupPermissionByUser($dtoUser) : null,
            "app_id" => $application?->ID ?? null,
            "domain" => $this->dtoAuth->domain,
            "module_code" => env("MODULE_CODE"),
            "user_id" => $dtoUser ? $dtoUser->ID : null
        ]);
    }
}
