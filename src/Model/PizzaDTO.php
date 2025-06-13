<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class PizzaDTO
{
    #[Groups(['order'])]
    private int $id;

    #[Groups(['order'])]
    private string $title;

    #[Groups(['order'])]
    private string $image;

    #[Groups(['order'])]
    private float $price;

    #[Groups(['order'])]
    private bool $okCeliacs;

    /**
     * @var PizzaIngredientsDTO[]
     */
    #[Groups(['order'])]
    private array $ingredients = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function isOkCeliacs(): bool
    {
        return $this->okCeliacs;
    }

    public function setOkCeliacs(bool $okCeliacs): void
    {
        $this->okCeliacs = $okCeliacs;
    }

    /**
     * @return PizzaIngredientsDTO[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param PizzaIngredientsDTO[] $ingredients
     */
    public function setIngredients(array $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    public function addIngredient(PizzaIngredientsDTO $ingredient): void
    {
        $this->ingredients[] = $ingredient;
    }
}
