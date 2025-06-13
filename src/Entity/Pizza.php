<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pizza'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['pizza'])]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    #[Groups(['pizza'])]
    private ?string $image = null;

    #[ORM\Column]
    #[Groups(['pizza'])]
    private ?float $price = null;

    /**
     * @var Collection<int, PizzaOrder>
     */
    #[ORM\OneToMany(targetEntity: PizzaOrder::class, mappedBy: 'pizza')]
    private Collection $pizzaOrders;

    /**
     * @var Collection<int, PizzaIngredients>
     */
    #[ORM\ManyToMany(targetEntity: PizzaIngredients::class, inversedBy: 'pizzas')]
    #[ORM\JoinTable(name: 'pizza_pizza_ingredients')]
    #[Groups(['pizza'])]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->pizzaOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return Collection<int, PizzaIngredients>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(PizzaIngredients $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->addPizza($this);
        }

        return $this;
    }

    public function removeIngredient(PizzaIngredients $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removePizza($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PizzaOrder>
     */
    public function getPizzaOrders(): Collection
    {
        return $this->pizzaOrders;
    }

    public function addPizzaOrder(PizzaOrder $pizzaOrder): static
    {
        if (!$this->pizzaOrders->contains($pizzaOrder)) {
            $this->pizzaOrders->add($pizzaOrder);
            $pizzaOrder->setPizza($this);
        }

        return $this;
    }

    public function removePizzaOrder(PizzaOrder $pizzaOrder): static
    {
        if ($this->pizzaOrders->removeElement($pizzaOrder)) {
            if ($pizzaOrder->getPizza() === $this) {
                $pizzaOrder->setPizza(null);
            }
        }

        return $this;
    }
}
