<?php
// src/Controller/OrderController.php
namespace App\Controller;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    #[Route('/order', methods: ['POST'])]
    public function createOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json([
                'code' => 400,
                'description' => 'Invalid JSON input'
            ], 400);
        }

        try {
            $orderOutputDTO = $this->orderService->createOrder($data);
            // Aquí añades el grupo para evitar ciclos y controlar qué se serializa
            return $this->json($orderOutputDTO, 200, [], ['groups' => 'pizza']);
        } catch (\InvalidArgumentException $ex) {
            return $this->json([
                'code' => 400,
                'description' => $ex->getMessage()
            ], 400);
        } catch (\Exception $ex) {
            return $this->json([
                'code' => 500,
                'description' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString(),
            ], 500);
        }
    }

}
