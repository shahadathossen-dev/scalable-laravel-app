<?php

namespace Modules\Auth\DTO\Api\V1;

class RegisterUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
