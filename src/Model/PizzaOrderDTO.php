<?php
// src/DTO/PizzaOrderDTO.php
namespace App\DTO;

use App\Entity\Pizza;

class PizzaOrderDTO
{
    private int $quantity;

    private Pizza $pizzaType; // referencia directa a la entidad Pizza o a un DTO PizzaDTO si prefieres

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPizzaType(): Pizza
    {
        return $this->pizzaType;
    }

    public function setPizzaType(Pizza $pizzaType): self
    {
        $this->pizzaType = $pizzaType;
        return $this;
    }
}
