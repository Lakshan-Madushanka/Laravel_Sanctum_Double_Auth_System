<?php
namespace App\Traits;

trait ApiResponseMessages
{
    protected function successResponseWithData(
        $status,
        $status_message = 'Query was Success',
        $data,
        $code = 200
    ) {
        return response()->json([
            'status' => $status, 'status_message' => $status_message,
            'data'   => $data
        ],
            $code
        );
    }

    protected function successResponseWithoutData(
        $status,
        $status_message = 'Query was Success',
        $code = 200
    ) {
        return response()->json([
            'status' => $status, 'status_message' => $status_message
        ],
            $code
        );
    }

    protected function errorResponseWithData(
        $status = 'error',
        $status_message = 'error occured',
        $errors = ['No data'],
        $code = 404
    ) {
        return response()->json([
            'status' => $status, 'status_message' => $status_message,
            'errors' => $errors
        ],
            $code
        );
    }

    protected function errorResponseWithoutData(
        $status = 'error',
        $status_message = 'error occured',
        $code = 404
    ) {
        return response()->json([
            'status' => $status, 'status_message' => $status_message
        ],
            $code
        );
    }
}
