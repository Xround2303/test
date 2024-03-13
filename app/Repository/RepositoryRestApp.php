<?php

namespace App\Repository;

use Bitrix24\SDK\Core\Exceptions\BaseException;
use Bitrix24\SDK\Core\Exceptions\TransportException;
use Bitrix24\SDK\Services\Main\Result\ApplicationInfoItemResult;
use Bitrix24\SDK\Services\Main\Service\Main;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RepositoryRestApp extends RepositoryRestAbstract implements \App\Interface\InterfaceRepositoryRestApp
{
    public function __construct(protected Main $application)
    {
    }


    public function getInfo(): ApplicationInfoItemResult|false
    {
        try {
            if(!$json = $this->application->getApplicationInfo()->getCoreResponse()->getHttpResponse()->getContent()) {
                return false;
            }

            if(!$response = json_decode($json, true)) {
                return false;
            }

            if(empty($response['result'])) {
                return false;
            }

            return new ApplicationInfoItemResult($response['result']);

        } catch (ExceptionInterface|BaseException $e) {
            return false;
        }
    }

    public function getApplication(): Main
    {
        return $this->application;
    }

    public function setApplication(Main $application): RepositoryRestApp
    {
        $this->application = $application;
        return $this;
    }


}
