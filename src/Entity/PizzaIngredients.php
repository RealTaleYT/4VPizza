<?php

namespace App\Entity;

use App\Repository\PizzaIngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PizzaIngredientsRepository::class)]
class PizzaIngredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['pizza'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['pizza'])]
    private ?bool $okCeliacs = false;

    /**
     * @var Collection<int, Pizza>
     */
    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'ingredients')]
    // ¡NO incluir esta propiedad en ningún grupo para evitar el ciclo infinito!
    private Collection $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function isOkCeliacs(): ?bool
    {
        return $this->okCeliacs;
    }

    public function setOkCeliacs(bool $okCeliacs): static
    {
        $this->okCeliacs = $okCeliacs;
        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): static
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas->add($pizza);
            $pizza->addIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): static
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeIngredient($this);
        }

        return $this;
    }
}
