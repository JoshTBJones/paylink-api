<?php

namespace App\Helpers;

use Log;

class ErrorResponseHelper
{
    public static function handle (\Exception $exception)
    {
        if (method_exists($exception, 'getCode'))
        {
            $statusCode = $exception->getCode();
        }
        else
        {
            $statusCode = 500;
        }

        $dbt=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
        $caller = isset($dbt[1]) ? $dbt[1] : null;

        $error_type = explode("\\", $caller["class"]);
        $error_type = str_ireplace("Controller", "", end($error_type));

        $response = [];

        switch ($statusCode)
        {
            case 401:
                $response['message'] = 'Unauthorized';
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                break;
        }

        $error = [
            "message"  => $exception->getMessage(),
            "type"     => $error_type,
            "code"     => $statusCode
        ];

        Log::error($error);

        return response()->json($error, $statusCode);
    }
}