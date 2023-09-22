<?php

namespace App\Services;

use App\Interfaces\Services\AccountServiceInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AccountService implements AccountServiceInterface
{

    /**
     * @inheritDoc
     */
    public function forgotPassword(array $email): string
    {
        $status = Password::sendResetLink($email);

        abort_if(
            $status !== Password::RESET_LINK_SENT,
            400,
            __($status)
        );

        return $status;
    }

    /**
     * @inheritDoc
     */
    public function resetPassword(array $data): string
    {
        $status = Password::reset(
            $data,
            static function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        abort_if(
            $status !== Password::PASSWORD_RESET,
            400,
            __($status)
        );

        return $status;
    }
}
