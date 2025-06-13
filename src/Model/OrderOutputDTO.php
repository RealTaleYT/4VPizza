<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class OrderOutputPizzaDTO
{
    #[Groups(['order'])]
    private int $quantity;

    #[Groups(['order'])]
    private PizzaDTO $pizzaType;

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPizzaType(): PizzaDTO
    {
        return $this->pizzaType;
    }

    public function setPizzaType(PizzaDTO $pizzaType): self
    {
        $this->pizzaType = $pizzaType;
        return $this;
    }
}

class OrderOutputDTO
{
    #[Groups(['order'])]
    private int $id;

    /**
     * @var OrderOutputPizzaDTO[]
     */
    #[Groups(['order'])]
    private array $pizzasOrder = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return OrderOutputPizzaDTO[]
     */
    public function getPizzasOrder(): array
    {
        return $this->pizzasOrder;
    }

    /**
     * @param OrderOutputPizzaDTO[] $pizzasOrder
     * @return self
     */
    public function setPizzasOrder(array $pizzasOrder): self
    {
        $this->pizzasOrder = $pizzasOrder;
        return $this;
    }
}
