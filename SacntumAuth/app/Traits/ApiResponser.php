<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
    use ApiResponseMessages;

    protected function showOne(
        $status,
        $status_message,
        Model $model,
        $code = 200
    ) {

        return $this->successResponseWithData($status, $status_message, $model,
            $code);
    }

    protected function showAll(
        $status,
        $status_message,
        Collection $collection,
        $code = 200
    ) {
        if ($collection->isEmpty()) {
            return $this->successResponseWithData($status, $status_message,
                $collection, $code);
        }
        return $this->successResponseWithData($status, $status_message,
            $collection, $code);
    }

    protected function successResponse(
        $status,
        $status_message,
        $code = 200
    ) {
        return $this->successResponseWithoutData($status, $status_message,
            $code);
    }

    protected function showError(
        $status,
        $status_message,
        $code = 404
    ) {
        return $this->errorResponseWithoutData($status, $status_message, $code);
    }

    protected function showErrorWithData(
        $status,
        $status_message,
        $errors,
        $code = 422
    ) {
        return $this->errorResponseWithData($status, $status_message, $errors,
            $code);
    }
}
