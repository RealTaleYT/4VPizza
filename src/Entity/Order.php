<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $deliveryTime = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentType = null;

    #[ORM\Column(length: 9)]
    private ?string $paymentNumber = null;

    /**
     * @var Collection<int, PizzaOrder>
     */
    #[ORM\OneToMany(targetEntity: PizzaOrder::class, mappedBy: 'idOrder')]
    private Collection $PizzaOrder;

    public function __construct()
    {
        $this->PizzaOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryTime(): ?\DateTime
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(\DateTime $deliveryTime): static
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): static
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getPaymentNumber(): ?string
    {
        return $this->paymentNumber;
    }

    public function setPaymentNumber(string $paymentNumber): static
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    /**
     * @return Collection<int, PizzaOrder>
     */
    public function getPizzaOrder(): Collection
    {
        return $this->PizzaOrder;
    }

    public function addPizzaOrder(PizzaOrder $pizzaOrder): static
    {
        if (!$this->PizzaOrder->contains($pizzaOrder)) {
            $this->PizzaOrder->add($pizzaOrder);
            $pizzaOrder->setIdOrder($this);
        }

        return $this;
    }

    public function removePizzaOrder(PizzaOrder $pizzaOrder): static
    {
        if ($this->PizzaOrder->removeElement($pizzaOrder)) {
            // set the owning side to null (unless already changed)
            if ($pizzaOrder->getIdOrder() === $this) {
                $pizzaOrder->setIdOrder(null);
            }
        }

        return $this;
    }
}
