<?php

use App\Http\Controllers\ControllerAppInstall;
use App\Http\Controllers\ControllerAppSettingList;
use App\Http\Controllers\ControllerAppUnInstall;
use App\Http\Middleware\MiddlewareUserAdmin;
use Illuminate\Support\Facades\Route;

Route::post('/app/uninstall/', ControllerAppUnInstall::class)->name("app.uninstall");
Route::post('/app/install/', ControllerAppInstall::class)->middleware(MiddlewareUserAdmin::class);
Route::get('/app/setting/list/', ControllerAppSettingList::class);
