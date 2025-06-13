<?php
namespace App\DTO;

class ErrorDTO
{
    private int $code;
    private string $description;

    public function __construct(int $code, string $description)
    {
        $this->code = $code;
        $this->description = $description;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'description' => $this->description,
        ];
    }
}
