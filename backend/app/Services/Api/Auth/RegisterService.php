<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Exception;

final class RegisterService
{

    /**
     *
     *
     * @param  array  $credentials
     * @return User
     * @throws Exception
     */
    public function register(array $credentials): User
    {
        try {
            // with this approach we are making sure that credentials array includes name, email, password keys
            [
                'name'     => $name,
                'email'    => $email,
                'password' => $password
            ] = $credentials;
        } catch (Exception $exception) {
            throw new Exception('Something went wrong!');
        }

        // we have a global exception handler, so we don't need to worry about here.
        return User::create(compact('name', 'email', 'password'));
    }

}
