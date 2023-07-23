<?php

namespace App\Services\Api\Auth;

use App\Exceptions\WrongCredentialException;
use App\Models\User;
use Exception;
use Throwable;


final class LoginService
{

    /**
     *
     * @param  array  $credentials
     * @return User
     * @throws Exception|Throwable
     */
    public function login(array $credentials): User
    {
        try {
            // with this approach we are making sure that credentials array includes email and password keys
            [
                'email'    => $email,
                'password' => $password
            ] = $credentials;
        } catch (Exception $exception) {
            throw new Exception('Something went wrong!');
        }

        $user = User::whereEmail($email)->firstOr(fn () => throw new WrongCredentialException);

        throw_unless(\Hash::check($password, $user->password), WrongCredentialException::class);

        return $user;
    }

}
