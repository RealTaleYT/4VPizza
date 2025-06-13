<?php

namespace App\DTO;

use DateTimeInterface;

class PaymentDTO
{
    private string $paymentType;

    private string $number;

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }
}

class OrderDTO
{
    /**
     * @var PizzaOrderDTO[]
     */
    private array $pizzasOrder = [];

    private string $deliveryTime;

    private string $deliveryAddress;

    private PaymentDTO $payment;

    /**
     * @return PizzaOrderDTO[]
     */
    public function getPizzasOrder(): array
    {
        return $this->pizzasOrder;
    }

    /**
     * @param PizzaOrderDTO[] $pizzasOrder
     * @return self
     */
    public function setPizzasOrder(array $pizzasOrder): self
    {
        $this->pizzasOrder = $pizzasOrder;
        return $this;
    }

    public function getDeliveryTime(): string
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(string $deliveryTime): self
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    public function getDeliveryAddress(): string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    public function getPayment(): PaymentDTO
    {
        return $this->payment;
    }

    public function setPayment(PaymentDTO $payment): self
    {
        $this->payment = $payment;
        return $this;
    }
}
