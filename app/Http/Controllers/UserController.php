<?php

namespace App\Http\Controllers;

use App\Actions\User\UserCreateAction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\DataTransferObject\UserDTO;

class UserController extends Controller
{
    public function __invoke(): View
    {
        return view('welcome');
    }

    public function createUser(Request $request, UserCreateAction $userCreateAction): User
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        //$userDTO = UserDTO::fromRequest($request);
        /*$userDTO = UserDTO::fromArray([
            'name' => 'Chandan Ojha',
            'email' => 'chandan@gmail.com',
            'password' => '123456'
        ]);*/

        return $userCreateAction->execute(UserDTO::fromRequest($request));
    }
}
