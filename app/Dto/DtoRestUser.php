<?php

namespace App\Dto;

class DtoRestUser
{
    public function __construct(
       public ?int $id = null,
       public ?string $name = null,
       public ?string $lastName = null,
       public ?string $secondName = null
    ) {
    }
}
