<?php

namespace App\Dto;

class expenseDto
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $description,
        public ?float $amount,
        public ?string $date,
        public ?int $category_id,
        public ?int $user_id,
    )
    {
    }

}