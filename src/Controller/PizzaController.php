<?php
namespace App\Controller;

use App\Service\PizzaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    private PizzaService $pizzaService;

    public function __construct(PizzaService $pizzaService)
    {
        $this->pizzaService = $pizzaService;
    }

    #[Route('/pizza', methods: ['GET'])]
    public function search(Request $request): JsonResponse
    {
        $name = $request->query->get('name', '');
        $ingredients = $request->query->get('ingredients', '');

        try {
            $result = $this->pizzaService->getPizzas($name, $ingredients);
            return $this->json($result);
        } catch (\Exception $e) {
            return $this->json([
                'code' => 400,
                'description' => $e->getMessage()
            ], 400);
        }
    }
}
