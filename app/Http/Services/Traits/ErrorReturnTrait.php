<?php

namespace App\Http\Services\Traits;

trait ErrorReturnTrait
{
    /**
     * @param string $error - текст ошибки
     * @return string[] - валидный для фронта ответ
     */
    public function returnError(string $error): array
    {
        return [
            'status'  => 'error',
            'message' => $error
        ];
    }
}
