<?php

namespace App\Providers;

use Bitrix24\SDK\Core\Batch;
use Bitrix24\SDK\Core\Core;
use Bitrix24\SDK\Services\Main\Service\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Sw24\Bitrix24Auth\BuilderBitrix24Client;
use Sw24\Bitrix24Auth\BuilderDtoAuth;
use Sw24\Bitrix24Auth\Dto\DtoAuth;


class RestServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(DtoAuth::class, function ($app) {
            if(env("APP_ENV") === "local") {
                return $app->get(BuilderDtoAuth::class)->fromAuthJson();
            }

            return $app->get(BuilderDtoAuth::class)::fromGeneralRequest(app(Request::class)->toArray());
        });

        $this->app->bind(BuilderDtoAuth::class, function ($app) {
            return new BuilderDtoAuth(app()->basePath() . "/.auth.json");
        });

        $this->app->bind(BuilderBitrix24Client::class, function ($app) {
            return new BuilderBitrix24Client(
                $app->get(BuilderDtoAuth::class),
                Cache::repository(Cache::getStore()),
                Log::channel("rest"),
                env("MODULE_CODE")
            );
        });

        $this->app->bind(Core::class, function ($app) {

            /** @var DtoAuth $dtoAuth */
            $dtoAuth = $app->get(DtoAuth::class);

            if(empty($dtoAuth->accessToken) OR empty($dtoAuth->refreshToken)) {
                return null;
            }

            $builder = $app->get(BuilderBitrix24Client::class);

            if(env("APP_ENV") === "local") {
                return $builder->buildCoreLocal();
            }

            return $builder->buildCore($app->get(DtoAuth::class));
        });

        /*$this->app->bind(\Bitrix24\SDK\Core\Batch::class, function ($app) {
            return new Batch(
                $app->get(Core::class),
                Log::channel("rest")
            );
        });*/

        $this->app->bind(Main::class, function ($app) {

            /** @var DtoAuth $dtoAuth */
            $dtoAuth = $app->get(DtoAuth::class);

            if(empty($dtoAuth->accessToken) OR empty($dtoAuth->refreshToken)) {
                return null;
            }

            return new Main(
                $app->get(Core::class),
                Log::channel("rest")
            );
        });

        $this->app->bind("app.link", function ($app) {
            $dtoRestAuth = app()->get(DtoAuth::class);
            return sprintf("https://%s/marketplace/app/%s/",
                $dtoRestAuth->domain,
                env("MODULE_CODE")
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
