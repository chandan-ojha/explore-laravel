<?php

namespace App\Actions\User;

use App\Models\User;
use App\DataTransferObject\UserDTO;

class UserCreateAction
{
    public function execute(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->name;
        $user->email = $userDTO->email;
        $user->password = $userDTO->password;
        $user->save();

        return $user;
    }

}
