<?php

namespace App\Interfaces\Services;

interface AccountServiceInterface
{
    /**
     * @param array $email
     *
     * @return string
     */
    public function forgotPassword(array $email): string;

    /**
     * @param array $data
     *
     * @return string
     */
    public function resetPassword(array $data): string;
}
