<?php

namespace App\Exceptions;

use App\Http\Controllers\ControllerBase;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function report(Throwable $e)
    {
        //
    }

    public function render($request, Throwable $e)
    {
        $data = [
            "status" => $e->getCode() !== 200 ? "error" : "success",
            "data" => $e->getMessage()
        ];

        return response()->json($data, $e->getCode() === 0 ? 400 : $e->getCode());
    }
}
