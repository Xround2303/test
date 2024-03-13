<?php

namespace App\Http\Controllers;


use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Sw24\Bitrix24Auth\Dto\DtoAuth;
use Sw24\Sw24RestSdk\Client;
use Sw24\Sw24RestSdk\Exception\ExceptionNotValidateResponse;
use Sw24\Sw24RestSdk\Exception\ExceptionRequestFailed;


class ControllerAppInstall extends Controller
{
    public function __construct(
        protected Client $sw24ApiClient,
        protected DtoAuth $dtoAuth,
    )
    {
    }

    /**
     * @throws GuzzleException
     * @throws ExceptionNotValidateResponse
     * @throws ExceptionRequestFailed
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->sw24ApiClient->callInstallApplication(
            $this->dtoAuth->domain,
            env("MODULE_CODE"),
            $this->dtoAuth->memberId,
            $this->dtoAuth->accessToken,
            $this->dtoAuth->refreshToken
        );

        return $this->response(true);
    }
}
