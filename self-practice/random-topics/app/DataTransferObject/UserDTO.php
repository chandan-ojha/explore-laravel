<?php

namespace App\DataTransferObject;

use Illuminate\Http\Request;

class UserDTO
{
    public function __construct(
        public readonly string      $name,
        public readonly string|null $email,
        public readonly string      $password
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );
    }

    public static function fromArray(array $request): self
    {
        return new self(
            $request['name'],
            $request['email'],
            $request['password']
        );
    }

}
