<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralException extends Exception
{
    /**
     * Report the exception
     *
     * @return void
     */
    public function report()
    {

    }


    /**
     * Render the exception as a HTTP response
     *
     * @param $request
     * @return JsonResponse
     */
    public function render($request)
    {
        return new JsonResponse([
            'errors'=> [
                'message' => $this->getMessage()
            ]
        ], $this->code);
    }
}
