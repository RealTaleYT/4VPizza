<?php
// src/Service/OrderService.php
namespace App\Service;

use App\DTO\OrderDTO;
use App\DTO\PizzaOrderDTO;
use App\DTO\PaymentDTO;
use App\Entity\Order;
use App\Entity\PizzaOrder;
use App\Repository\OrderRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderService
{
    private EntityManagerInterface $em;
    private PizzaRepository $pizzaRepository;
    private OrderRepository $orderRepository;

    public function __construct(
        EntityManagerInterface $em,
        PizzaRepository $pizzaRepository,
        OrderRepository $orderRepository
    ) {
        $this->em = $em;
        $this->pizzaRepository = $pizzaRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data): OrderDTO
    {
        // Validar campos obligatorios
        if (
            empty($data['pizzas_order']) ||
            empty($data['delivery_time']) ||
            empty($data['delivery_address']) ||
            empty($data['payment']['payment_type']) ||
            empty($data['payment']['number'])
        ) {
            throw new BadRequestHttpException('All fields are required');
        }

        $paymentType = $data['payment']['payment_type'];
        $number = $data['payment']['number'];
        if ($paymentType === 'credit-card') {
            if (!preg_match('/^\d{4}-\d{4}-\d{4}-\d{4}$/', $number)) {
                throw new BadRequestHttpException('Invalid credit card format');
            }
        } elseif ($paymentType === 'bizum') {
            if (!preg_match('/^\d{9}$/', $number)) {
                throw new BadRequestHttpException('Invalid Bizum phone number');
            }
        } else {
            throw new BadRequestHttpException('Invalid payment type');
        }

        $order = new Order();
        $order->setDeliveryTime(new \DateTime($data['delivery_time']));
        $order->setDeliveryAddress($data['delivery_address']);
        $order->setPaymentType($paymentType);
        $order->setPaymentNumber($number);

        $this->em->persist($order);

        $pizzaOrdersDTO = [];

        foreach ($data['pizzas_order'] as $pizzaOrderData) {
            $pizza = $this->pizzaRepository->find($pizzaOrderData['pizza_id']);
            if (!$pizza) {
                throw new BadRequestHttpException('Pizza not found: ' . $pizzaOrderData['pizza_id']);
            }

            $pizzaOrder = new PizzaOrder();
            $pizzaOrder->setIdOrder($order);
            $pizzaOrder->setPizza($pizza);
            $pizzaOrder->setQuantity($pizzaOrderData['quantity']);
            $this->em->persist($pizzaOrder);

            $pizzaOrderDTO = new PizzaOrderDTO();
            $pizzaOrderDTO->setQuantity($pizzaOrderData['quantity']);
            $pizzaOrderDTO->setPizzaType($pizza);

            $pizzaOrdersDTO[] = $pizzaOrderDTO;
        }

        $this->em->flush();

        $paymentDTO = new PaymentDTO();
        $paymentDTO->setPaymentType($paymentType);
        $paymentDTO->setNumber($number);

        $orderDTO = new OrderDTO();
        $orderDTO->setDeliveryTime($data['delivery_time']);
        $orderDTO->setDeliveryAddress($data['delivery_address']);
        $orderDTO->setPayment($paymentDTO);
        $orderDTO->setPizzasOrder($pizzaOrdersDTO);

        return $orderDTO;
    }
}
